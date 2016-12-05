<?php

namespace Day02;

/**
 * Puzzle day 2
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo
{
    private $keypad = [
        [0,  0,   1,   0,  0],
        [0,  2,   3,   4,  0],
        [5,  6,   7,   8,  9],
        [0, 'A', 'B', 'C', 0],
        [0,  0,  'D',  0,  0],
    ];

    # File input
    private $input;

    private $lastKeypadPosition;

    public function __construct()
    {
        $this->input = file('input');

        # Starting position (middle of $keypad)
        $this->lastKeypadPosition = $this->keypad[1][1];
    }

    /**
     * Process input for puzzle
     */
    public function processInput()
    {
        $lastRow = 2;
        $lastCol = 0;

        foreach ($this->input as $key => $line) {
            // explode each line to single character step
            $steps = str_split($line);
            foreach ($steps as $step) {
                switch ($step) {
                    case 'L':
                        # Check if new column exists and is not 0
                        $tmpNewCol = $lastCol > 0 ? $lastCol - 1 : $lastCol;
                        $newRow = $lastRow;
                        $newCol = $this->keypad[$newRow][$tmpNewCol] !== 0 ? $tmpNewCol : $lastCol;
                        break;
                    case 'R':
                        $tmpNewCol = $lastCol < 4 ? $lastCol + 1 : $lastCol;
                        $newRow = $lastRow;
                        $newCol = $this->keypad[$newRow][$tmpNewCol] !== 0 ? $tmpNewCol : $lastCol;
                        break;
                    case 'U':
                        $tmpNewRow = $lastRow > 0 ? $lastRow - 1 : $lastRow;
                        $newCol = $lastCol;
                        $newRow = $this->keypad[$tmpNewRow][$newCol] !== 0 ? $tmpNewRow : $lastRow;
                        break;
                    case 'D':
                        $tmpNewRow = $lastRow < 4 ? $lastRow + 1 : $lastRow;
                        $newCol = $lastCol;
                        $newRow = $this->keypad[$tmpNewRow][$newCol] !== 0 ? $tmpNewRow : $lastRow;
                        break;
                }

                $lastCol = $newCol;
                $lastRow = $newRow;
            }

            echo 'Number ' . $key . ': ';
            echo $this->keypad[$newRow][$newCol];
            echo PHP_EOL;

        }
    }

    /**
     * @return array
     */
    public function getKeypad()
    {
        return $this->keypad;
    }

    /**
     * @param array $keypad
     */
    public function setKeypad($keypad)
    {
        $this->keypad = $keypad;
    }
}

$puzzle = new PuzzlePartOne();
$puzzle->processInput();
