<?php

namespace Puzzles\Day02;

/**
 * Puzzle day 2
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    private $solution;

    protected static $keypad = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9]
    ];

    /**
     * Process input for puzzle
     */
    public function processInput()
    {
        $lastRow = 1;
        $lastCol = 1;

        foreach ($this->input as $key => $line) {
            // explode each line to single character step
            $steps = str_split($line);
            foreach ($steps as $step) {
                switch ($step) {
                    case 'L':
                        $newCol = $lastCol > 0 ? $lastCol - 1 : $lastCol;
                        $newRow = $lastRow;
                        break;
                    case 'R':
                        $newCol = $lastCol < 2 ? $lastCol + 1 : $lastCol;
                        $newRow = $lastRow;
                        break;
                    case 'U':
                        $newRow = $lastRow > 0 ? $lastRow - 1 : $lastRow;
                        $newCol = $lastCol;
                        break;
                    case 'D':
                        $newRow = $lastRow < 2 ? $lastRow + 1 : $lastRow;
                        $newCol = $lastCol;
                        break;
                }

                $lastCol = $newCol;
                $lastRow = $newRow;
            }
            $this->solution .= static::$keypad[$newRow][$newCol];
        }

    }

    public function renderSolution()
    {
        echo 'Solution: ' . $this->solution . PHP_EOL;
    }
}

