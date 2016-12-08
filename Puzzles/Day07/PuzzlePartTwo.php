<?php

namespace Puzzles\Day07;

/**
 * Puzzle day 7
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartTwo
{
    # File input
    private $input;

    private $sum;

    public function __construct()
    {
        $this->input = file('input');
    }

    /**
     * Process input for puzzle
     * @return int
     */
    public function processInput()
    {
        $sum = 0;
        $output = '';
        foreach ($this->input as $line) {
            $regular = preg_split('/\[([a-z]+)\]/', $line);
            $regular = join('..', $regular);

            preg_match_all('/\[([a-z]+)\]/', $line, $matches);
            $brackets = join('..', $matches[1]);

            # Find the triplets
            $triplets = $this->findTriplets($regular);

            if ($this->hasTripletInBrackets($triplets, $brackets)) {
                $sum++;
            }
        }

        echo $sum . PHP_EOL;
    }

    /**
     * @param $triplets
     * @param $brackets
     * @return bool
     */
    private function hasTripletInBrackets($triplets, $brackets)
    {
        foreach ($triplets as $triplet) {
            $reverseTriplet = $triplet[1] . $triplet[0] . $triplet[1];
            if (strpos($brackets, $reverseTriplet) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $string
     * @return array
     */
    private function findTriplets($string)
    {
        $triplets = [];
        for ($i=0;$i<strlen($string)-3;$i++) {
            $triplet = substr($string, $i, 3);
            if ($triplet[0] == $triplet[2]) {
                $triplets[] = $triplet;
            }
        }

        return $triplets;
    }

    /**
     * @param $string
     * @return bool
     */
    public function isMirrored($string)
    {
        $result = false;
        for ($i=0;$i<strlen($string)-3;$i++) {
            $controlCharacters = substr($string, $i, 2);
            $reverseCharacters = strrev(substr($string, $i+2, 2));

            if ($controlCharacters == $reverseCharacters && $controlCharacters[0] != $controlCharacters[1]) {
                return true;
            }
        }

        return $result;
    }
}

$puzzle = new PuzzlePartTwo();
$sum = $puzzle->processInput();
echo "Solution: " . $sum;
