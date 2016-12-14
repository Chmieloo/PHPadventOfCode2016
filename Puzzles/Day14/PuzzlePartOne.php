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
        $hash = md5(static::$salt . $index);

        return $hash;
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        $lastHash = array_pop($this->validHashes);
        echo $lastHash . PHP_EOL;
        $solution = key($lastHash);
        echo PHP_EOL . 'Solution: ' . $solution . PHP_EOL;
    }
}
