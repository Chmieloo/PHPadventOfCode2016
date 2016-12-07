<?php

namespace Day06;

/**
 * Puzzle day 6
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends \Abstraction\Puzzle
{
    protected static $filename = 'input';

    private $input;

    private $message;

    /**
     * Puzzle constructor.
     * Load the file into class variable
     */
    public function __construct()
    {
        $this->loadInput();
    }

    /**
     * Load input file into class variable
     * Use static variable to define file name
     */
    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$filename)) {
            $this->input = file(__DIR__ . '/' . static::$filename);
        }
    }

    /**
     * @return int
     */
    public function processLines()
    {
        $solution = '';

        $positionsCount = [
            0 => [],
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => [],
            6 => [],
            7 => [],
        ];

        foreach ($this->input as $line) {
            $line = trim($line);
            $letters = str_split($line);

            foreach ($letters as $key => $letter) {
                if (array_key_exists($letter, $positionsCount[$key])) {
                    $positionsCount[$key][$letter]++;
                } else {
                    $positionsCount[$key][$letter] = 1;
                }
            }
        }

        foreach ($positionsCount as $countArray) {
            $flippedArray = array_flip($countArray);
            krsort($flippedArray);
            $solution .= array_shift($flippedArray);
        }

        return $solution;
    }
}

$puzzle = new PuzzlePartOne();
$solution = $puzzle->processLines();
echo $solution;


