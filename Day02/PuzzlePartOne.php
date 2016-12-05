<?php

namespace Day02;

/**
 * Puzzle day 2
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne
{
    private $keypad = [
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9]
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
