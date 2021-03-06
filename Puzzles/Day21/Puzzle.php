<?php

namespace Puzzles\Day21;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 21
 * Common class for day 21
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $solution;
    protected $inputString = 'abcdefgh';
    protected static $fileName = 'input';

    public function __construct()
    {
        echo 'Input: ' . $this->inputString . PHP_EOL;
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
        echo 'Solution: ' . $this->inputString . PHP_EOL;
    }
}
