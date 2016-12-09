<?php

namespace Puzzles\Day09;

/**
 * Puzzle day 9
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    public function processInput()
    {
        $inputArray = [];
        $input = $this->input[0];
        preg_match_all('/\((\d+)x(\d+)\)/', $input, $matches, PREG_OFFSET_CAPTURE);
        preg_match_all('/([A-Z]+)/', $input, $matchesLetters, PREG_OFFSET_CAPTURE);

        $tmpString = '';
        $previousPosition = 0;
        $previousLength = 0;

        $i = 0;

        foreach ($matches[0] as $compressionInfo) {
            # If previous position + previous length equals this start position,
            # add it to string
            if (($previousPosition + $previousLength) == $compressionInfo[1]) {
                $tmpString .= $compressionInfo[0];
            } else {
                $inputArray[] = $tmpString;
                $tmpString = $compressionInfo[0];
            }

            $previousPosition = $compressionInfo[1];
            $previousLength = strlen($compressionInfo[0]);

            if ($i == (count($matches[0]) - 1)) {
                $inputArray[] = $tmpString;
            }
            $i++;
        }

        $sum = 0;
        foreach ($inputArray as $data) {
            preg_match_all('/\((\d+)x(\d+)\)/', $data, $matches, PREG_OFFSET_CAPTURE);
            //var_dump($matches[2]);

            $multiplication = 1;

            foreach($matches[2] as $numbers) {
                $multiplication *= $numbers[0];
            }
            echo $multiplication . PHP_EOL;
            $sum += $multiplication;
            //echo PHP_EOL;

        }

        echo $sum;
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
    }
}
