<?php

namespace Puzzles\Day06;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 6
 * Common class for day 6
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $solution;

    /**
     * Let's define most likely characters as 1 and least likely characters as 2 (in child classes)
     * @var int
     */
    protected static $type;

    const MOST_LIKELY  = 1;
    const LEAST_LIKELY = 2;

    /**
     * Puzzle constructor.
     * Load the file into class variable
     */
    public function __construct()
    {
        $this->loadInput();
        $this->processLines();
    }

    /**
     * @return null
     */

    /**
     * @return int
     */
    protected function processLines()
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
            if (static::$type == static::LEAST_LIKELY) {
                ksort($flippedArray);
            } elseif (static::$type == static::MOST_LIKELY) {
                krsort($flippedArray);
            }
            $solution .= array_shift($flippedArray);
        }

        $this->solution = $solution;
    }

    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Message: ' . $this->solution . PHP_EOL;
    }
}
