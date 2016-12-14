<?php

namespace Puzzles\Day14;

/**
 * Puzzle day 11
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    protected static $registers = [
        'a' => 0,
        'b' => 0,
        'c' => 1,
        'd' => 0,
    ];

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . static::$registers['a'] . PHP_EOL;
    }
}
