<?php

namespace Puzzles\Day01;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 1
 * Common class for day 1
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
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
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
