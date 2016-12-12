<?php

namespace Puzzles\Day12;

/**
 * Puzzle day 11
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    protected static $registers = [
        'a' => 0,
        'b' => 0,
        'c' => 0,
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
