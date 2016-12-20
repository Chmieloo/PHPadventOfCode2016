<?php

namespace Puzzles\Day20;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 18
 * Common class for day 18
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $solution;
    protected $numElves = 3014387;

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

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . $this->solution . PHP_EOL;
    }
}
