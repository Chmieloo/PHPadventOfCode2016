<?php

namespace Puzzles\Day15;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 15
 * Common class for day 15
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $input;
    protected $machine;
    protected $solution;

    public function __construct()
    {
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
        $pattern = '/Disc #(\d+) has (\d+) positions; at time=0, it is at position (\d+)./';

        foreach ($this->input as $line) {
            preg_match($pattern, $line, $matches);
            $diskRow = $matches[1];
            $diskMaxPositions = $matches[2];
            $currentDiskPosition = $matches[3];

            $this->machine[$diskRow] = [$currentDiskPosition, $diskMaxPositions];
        }

        $i = 0;
        while (1) {
            if ($this->checkThrough($i)) {
                echo ($i - 1) . PHP_EOL;
                $this->solution = $i - 1;
                break;
            }
            $i++;
        }
    }

    /**
     * @param $step
     * @return bool
     */
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

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . $this->solution;
    }
}
