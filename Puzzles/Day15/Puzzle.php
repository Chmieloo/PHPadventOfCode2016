<?php

namespace Puzzles\Day15;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 14
 * Common class for day 14
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $input;
    protected $machine;

    public function __construct()
    {
        $this->loadInput();
        $this->initialize();
        $this->processInput();
    }

    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
    }

    private function initialize()
    {
    }

    public function processInput()
    {
        $pattern = '/Disc #(\d+) has (\d+) positions; at time=0, it is at position (\d+)./';

        foreach ($this->input as $line) {
            preg_match($pattern, $line, $matches);
            $diskRow = $matches[1];
            $diskMaxPositions = $matches[2];
            $currentDiskPosition = $matches[3];

            $this->machine[$diskRow] = [$currentDiskPosition, $diskMaxPositions];
        }
        $this->printMachine();

        #for ($i = 1; $i < 100; $i++) {
        $i = 0;
        while (1) {
            //$this->printMachine();
            if ($this->checkThrough($i)) {
                echo ($i - 1) . PHP_EOL;
                break;
            }
            $i++;
        }

    }

    private function checkThrough($step)
    {
        $pass = true;
        foreach ($this->machine as $levelKey => $level) {
            $currentDiskPosition = $level[0];
            $maxDiskPositions = $level[1];
            if (($currentDiskPosition + ($step + ($levelKey - 1))) % $maxDiskPositions != 0) {
                $pass = false;
            }
        }
        return $pass;
    }

    private function printMachine()
    {
        for ($i = 1; $i <= 6; $i++) {

            $floorString = $i . ' | ';

            for ($j = 0; $j < count($this->machine[$i]); $j++) {
                # Get element from all elements
                $currentElement = $this->machine[$i][$j];
                $floorString .= $currentElement . ' ';
            }

            echo $floorString. PHP_EOL;
        }
        echo PHP_EOL . PHP_EOL;
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo '';
    }
}
