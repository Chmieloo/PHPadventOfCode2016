<?php

namespace Puzzles\Day14;

/**
 * Puzzle day 14
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    protected static function getHash($index)
    {
        $hash = md5(static::$salt . $index);
        for ($x = 1; $x <= 2016; $x++) {
            $hash = md5($hash);
        }

        return $hash;
    }
}
