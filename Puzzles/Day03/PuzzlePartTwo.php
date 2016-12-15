<?php

namespace Puzzles\Day03;

/**
 * Puzzle day 3
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    protected function processInput()
    {
        $this->fixNumbersArray();
        parent::processInput();
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
}
