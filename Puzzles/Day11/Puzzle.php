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
     * @param $floorNum
     * @return bool
     */
    private function findUpMovableElements($floorNum)
    {
        # Check if the floor has elements
        if (!count($this->floors[$floorNum]) || $floorNum == 4) {
            return false;
        }

        # Check if this floor has matching elements and move them up
        if ($element = $this->hasMatchingElements($this->floors[$floorNum])) {
            $matchingElement = $this->getMatchingEntity($element);

            # Remove this pair from the floor and test it if safe
            $tmpFloor = array_flip($this->floors[$floorNum]);
            unset($tmpFloor[$element]);
            unset($tmpFloor[$matchingElement]);
            $tmpFloor = array_flip($tmpFloor);

            if ($this->isFloorSafe($tmpFloor) && count($this->elevator) < 2) {
                $this->elevator[] = $element;
                $this->elevator[] = $matchingElement;
            }
        }

        # We did not find anything to match above floor
        # Let's check if we can move pair up
        if (!count($this->elevator)) {
            # Get the elements from the floor above
            $aboveElements = $this->floors[$floorNum + 1];
            foreach ($aboveElements as $aboveElement) {
                $matchingElement = $this->getMatchingEntity($aboveElement);
                if (in_array($matchingElement, $this->floors[$floorNum])) {
                    # If we remove this element from this floor, is it still safe ?

                    $tmpFloor = array_flip($this->floors[$floorNum]);
                    unset($tmpFloor[$matchingElement]);
                    $tmpFloor = array_flip($tmpFloor);

                    if ($this->isFloorSafe($tmpFloor) && count($this->elevator) < 2) {
                        $this->elevator[] = $matchingElement;
                    }
                }
            }
        }

        # Current floor is difference between actual state and the elevator
        $this->floors[$floorNum] = array_diff($this->floors[$floorNum], $this->elevator);

        # Move the elevator up with elements
        $this->floors[$floorNum + 1] = array_merge($this->floors[$floorNum + 1], $this->elevator);
        $this->currentElevatorFloor++;
        $this->elevator = [];

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
     * TODO The floor is safe when:
     * 1. It is empty
     * 2. Has microchips only
     * 3. Has all elements paired and / or the rest are generators
     */

    /**
     * @param $floor
     * @return bool
     */
    private function isFloorSafe($floor)
    {
        # Empty floor = safe
        if (count($floor) == 0) {
            return true;
        }

        # Microchips only = safe
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

        # If there are more microchips than generators
        $microchips = 0;
        $generators = 0;
        foreach ($floor as $element) {
            if (substr($element, 0, -1) == 'M') {
                $microchips++;
            } elseif (substr($element, 0, -1) == 'G') {
                $generators++;
            }
        }

        $pairs = [];
        # If it has at least one G/M pair
        foreach ($floor as $element) {
            $elemType = substr($element, 0, 2);
            if (in_array($elemType, $pairs)) {
                return true;
            } else {
                $pairs[] = $elemType;
            }
        }

        return false;
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
