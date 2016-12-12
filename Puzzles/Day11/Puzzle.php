<?php

namespace Puzzles\Day11;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 11
 * Common class for day 11
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $counter;

    private $visualize;

    protected $floors;
    protected $numElements;
    protected $elevator = [];
    protected $currentElevatorFloor;

    public function __construct()
    {
        $this->currentElevatorFloor = 1;
        $this->counter = 0;
        $this->visualize = true;

        $this->loadInput();
        $this->processInput();

    }

    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
    }

    public function processInput()
    {
        # initial floor set up
        foreach ($this->input as $line) {
            $floor = explode(' ', trim($line));
            $floorNumber = array_shift($floor);
            $this->floors[$floorNumber] = $floor;
            $this->numElements += count($floor);
        }

        if ($this->visualize) {
            $this->printFloors();
        }

        $counter = 0;
        while (count($this->floors[4]) < (count($this->floors, COUNT_RECURSIVE) - count(array_keys($this->floors))))
        {
            while($this->findUpMovableElements($this->currentElevatorFloor)) {
                if ($this->visualize) {
                    $this->printFloors();
                }
                $counter++;
            }

            #Move one item (or two ?) downstairs until first non empty floor
            while($this->findDownMovableElements($this->currentElevatorFloor)) {
                if ($this->visualize) {
                    $this->printFloors();
                }
                $counter++;
            }

        }

        if ($this->visualize) {
            $this->printFloors();
        }
        $this->counter = $counter;
    }

    /**
     * Get all combination of elements to move up (or down)
     * TODO sort result to prefer generators to be picked first
     * @param $floor
     * @return array
     */
    private function getAllCombinations($floor)
    {
        $combinations = [];
        for ($i = 0; $i < count($floor) - 1; $i++) {
            for ($j = $i + 1; $j <= count($floor) - 1; $j++) {
                $combinations[] = [
                    $floor[$i],
                    $floor[$j]
                ];
            }
        }

        return $combinations;
    }

    /**
     * @param $floorNum
     * @return bool
     */
    private function findUpMovableElements($floorNum)
    {
        # Check if the floor has elements
        if (!count($this->floors[$floorNum]) || $floorNum == 4) {
            return false;
        }

        # We did not find anything to match above floor
        # Let's check if we can move pair up
        if (!count($this->elevator)) {
            /**
             * Check every double element
             */
            $thisFloorCombinations = $this->getAllCombinations($this->floors[$floorNum]);

            foreach ($thisFloorCombinations as $doubles) {
                # Test next floor
                $testNextFloor = array_merge($this->floors[$floorNum + 1], $doubles);
                $testThisFloor = array_diff($this->floors[$floorNum], $doubles);

                if ($this->isFloorSafe($testNextFloor) &&
                    $this->isFloorSafe($testThisFloor)
                ) {
                    $this->elevator[] = $doubles;
                    break;
                }
            }

            /**
             * Check every single element
             */
        }

        if (count($this->elevator)) {
            # Current floor is difference between actual state and the elevator
            $this->floors[$floorNum] = $testThisFloor;

            # Move the elevator up with elements
            $this->floors[$floorNum + 1] = $testNextFloor;
            $this->currentElevatorFloor++;
            $this->elevator = [];
        } else {
            return false;
        }

        return true;
    }

    /**
     * @param $floorNum
     * @return bool
     */
    private function findDownMovableElements($floorNum)
    {
        # Check if the floor has elements
        if ($floorNum == 1 || !count($this->floors[$floorNum - 1])) {
            return false;
        }

        # Check if you can move elements
        if (!count($this->elevator)) {
            foreach ($this->floors[$floorNum] as $thisFloorElement) {
                # If it is safe to move element, move it
                # Remove from this floor, is it safe
                $tmpFloor = array_flip($this->floors[$floorNum]);
                unset($tmpFloor[$thisFloorElement]);
                $tmpFloor = array_flip($tmpFloor);
                $tmpBelowFloor = $this->floors[$floorNum - 1];
                $tmpBelowFloor[] = $thisFloorElement;

                if ($this->isFloorSafe($tmpFloor) && $this->isFloorSafe($tmpBelowFloor) && count($this->elevator) <= 1) {
                    $this->elevator = [$thisFloorElement];
                    break;
                }
            }
        }

        # Current floor is difference between actual state and the elevator
        $this->floors[$floorNum] = array_diff($this->floors[$floorNum], $this->elevator);

        # Move the elevator up with elements
        $this->floors[$floorNum - 1] = array_merge($this->floors[$floorNum - 1], $this->elevator);

        $this->currentElevatorFloor--;
        $this->elevator = [];

        return true;
    }

    private function getMatchingEntity($element)
    {
        if (substr($element, -1) == 'M') {
            return substr($element, 0, 2) . 'G';
        } else {
            return substr($element, 0, 2) . 'M';
        }
    }

    /**
     * @param $floor
     * @return bool
     */
    public function hasMatchingElements($floor)
    {
        foreach ($floor as $element) {
            if (in_array($this->getMatchingEntity($element), $floor))  {
                return $element;
            }
        }

        return false;
    }

    /**
     * @param $floor
     * @return bool
     */
    private function isFloorSafe($floor)
    {
        /**
         * The floor is safe when it is empty
         */
        if (count($floor) == 0) {
            return true;
        }

        /**
         * The floor is safe when it has only one type of elements
         */
        $types = [];
        foreach ($floor as $element) {
            $elemType = substr($element, -1);
            if (!in_array($elemType, $types)) {
                $types[] = $elemType;
            }
        }
        if (count($types) == 1) {
            return true;
        }

        /**
         * All elements are pairs
         */
        $notMatched = [];
        foreach ($floor as $element) {
            # take every element and check if there is a pair
            $matchingElement = $this->getMatchingEntity($element);
            if (in_array($matchingElement, $floor)) {
                # It has a matching element, let's leave it
            } else {
                $notMatched[] = $element;
            }
        }

        $safeOnly = true;
        foreach ($notMatched as $element) {
            if (substr($element, -1) == 'M') {
                $safeOnly = false;
                break;
            }
        }

        return $safeOnly;
    }

    private function printFloors()
    {
        # Get all elements
        $elements = [];
        foreach ($this->floors as $floor) {
            $elements = array_merge($elements, $floor);
        }
        sort($elements);

        for ($i = count($this->floors); $i >= 1; $i--) {
            sort($this->floors[$i]);

            $floorString = $i . ' ';

            for ($j = 0; $j < count($elements); $j++) {
                # Get element from all elements
                $currentElement = $elements[$j];
                if (in_array($currentElement, $this->floors[$i])) {
                    $floorString .= $currentElement . ' ';
                } else {
                    $floorString .= '--- ';
                }
            }

            if ($i == $this->currentElevatorFloor) {
                $floorString .= ' [E]';
            }
            $floorString .= PHP_EOL;
            echo $floorString;
        }
        $separator = str_repeat('___', count($elements)) . str_repeat('_', (count($elements) + 1));
        echo $separator . PHP_EOL . PHP_EOL;
    }

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
