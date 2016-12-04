<?php

namespace Day03;

/**
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne
{
    private $input;

    private $numberOfTriangles;

    /**
     * Puzzle constructor.
     * Load the file into class variable
     */
    public function __construct()
    {
        // Put puzzle input into string
        $this->input = file('input.txt');

        $this->numberOfTriangles = 0;
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
    private function isTriangle($numbers)
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
}

$puzzle = new Puzzle();
$numberOfTriangles = $puzzle->countTriangles();
echo 'Number of triangles: ' . $numberOfTriangles;

