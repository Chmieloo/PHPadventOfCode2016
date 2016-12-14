<?php

namespace Puzzles\Day14;

/**
 * Puzzle day 14
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    protected static function getHash($index)
    {
        return md5(static::$salt . $index);
    }
}
