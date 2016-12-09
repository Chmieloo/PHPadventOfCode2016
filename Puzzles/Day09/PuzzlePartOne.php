<?php

namespace Puzzles\Day09;

/**
 * Puzzle day 9
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    private $decompresssed = '';

    public function processInput()
    {
        $length = 0;

        $input = $this->input[0];
        $stringLength = strlen($input);

        preg_match_all('/\((\d+)x(\d+)\)/', $input, $matches, PREG_OFFSET_CAPTURE);

        $data = $matches[0];
        foreach ($data as $compressionInfo) {
            $compressionArray[$compressionInfo[1]] = $compressionInfo[0];
        }

        $compressionInfoPositions = array_keys($compressionArray);

        $pointer = 0;
        do {
            if (in_array($pointer, $compressionInfoPositions)) {
                # Get compression info
                preg_match('/\((\d+)x(\d+)\)/', $compressionArray[$pointer], $matches);
                $compressionString = $matches[0];
                $numChars = $matches[1];
                $numDuplications = $matches[2];
                var_dump($compressionString);

                $multiplication = (int)$numChars * (int)$numDuplications;
                $length += $multiplication;

                $pointer += strlen($compressionString[0]) + $numChars;
            } else {
                $length++;
            }


            $pointer++;
        } while ($pointer < $stringLength);


        var_dump($length);
    }

    /**
     * @return int|number
     */
    private function countPixels()
    {
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Number of active pixels: ' . PHP_EOL;
    }
}
