<?php

namespace Puzzles\Day15;

/**
 * Puzzle day 14
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    protected static $something;
    protected static function getHash($index)
    {
        if (isset(static::$something[$index])) {
            return static::$something[$index];
        }
        $hash = md5(static::$salt . $index);
        for ($x = 1; $x <= 2016; $x++) {
            $hash = md5($hash);
            static::$something[$index] = $hash;
        }

        return $hash;
    }
}
