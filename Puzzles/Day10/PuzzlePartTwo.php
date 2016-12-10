<?php

namespace Puzzles\Day10;

/**
 * Puzzle day 10
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    /**
     * Direct output
     */
    public function renderSolution()
    {
        $multiply = $this->outputs[0] * $this->outputs[1] * $this->outputs[2];
        echo 'Solution: ' . $multiply . PHP_EOL;
    }
}
