<?php

namespace Puzzles\Day15;

/**
 * Puzzle day 14
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    protected static $something;
    protected static function getHash($index)
    {
        if (isset(static::$something[$index])) {
            return static::$something[$index];
        }
        return md5(static::$salt . $index);
    }
}
