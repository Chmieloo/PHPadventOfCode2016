<?php

namespace Puzzles\Day08;

/**
 * Puzzle day 8
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    /**
     * @return int|number
     */
    private function countPixels()
    {
        $sum = 0;

        for ($i=0;$i<6;$i++) {
            $sum += array_sum($this->cardMap[$i]);
        }

        return $sum;
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Number of active pixels: ' . $this->countPixels() . PHP_EOL;
    }
}
