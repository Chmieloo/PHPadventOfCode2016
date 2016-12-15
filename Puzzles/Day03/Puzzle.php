<?php

namespace Puzzles\Day03;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 03
 * Common class for day 03
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $numberOfTriangles = 0;

    public function __construct()
    {
        $this->loadInput();
        $this->processInput();
    }

    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
    }

    protected function processInput()
    {
        $this->countTriangles();
    }

    /**
     * @return int
     */
    public function countTriangles()
    {
        foreach ($this->input as $line) {
            $line = trim($line);
            $numbers = preg_split('/\s+/', $line);
            $numbers = array_map('trim', $numbers);

            if ($this->isTriangle($numbers)) {
                $this->numberOfTriangles++;
            }
        }

        return $this->numberOfTriangles;
    }

    /**
     * @param $numbers
     * @return bool
     */
    protected function isTriangle($numbers)
    {
        if (is_array($numbers)) {
            if (is_numeric($numbers[0]) &&
                is_numeric($numbers[1]) &&
                is_numeric($numbers[2])
            ){
                $num1 = $numbers[0];
                $num2 = $numbers[1];
                $num3 = $numbers[2];

                if (($num1 + $num2 > $num3) &&
                    ($num1 + $num3 > $num2) &&
                    ($num2 + $num3 > $num1)
                ) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . $this->numberOfTriangles . PHP_EOL;
    }
}
