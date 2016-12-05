<?php

namespace Day03;

/**
 * Puzzle day 3
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo
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

        $this->fixNumbersArray();

        $this->numberOfTriangles = 0;
    }

    /**
     * Split an input array into columns and 3 elements chunks
     * After that, merge the array so we end up with triplets
     */
    private function fixNumbersArray()
    {
        foreach ($this->input as $key => $line) {
            $line = trim($line);
            $numbers = preg_split('/\s+/', $line);
            $numbers = array_map('trim', $numbers);

            $firstColumnNumbers[] = $numbers[0];
            $secondColumnNumbers[] = $numbers[1];
            $thirdColumnNumbers[] = $numbers[2];
        }
        $first  = array_chunk($firstColumnNumbers, 3);
        $second = array_chunk($secondColumnNumbers, 3);
        $third  = array_chunk($thirdColumnNumbers, 3);

        $this->input = array_merge($first, $second, $third);
    }

    /**
     * @return int
     */
    public function countTriangles()
    {
        foreach ($this->input as $numbers) {
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
