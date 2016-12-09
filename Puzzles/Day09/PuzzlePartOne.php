<?php

namespace Puzzles\Day09;

/**
 * Puzzle day 9
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    private $length;

    public function processInput()
    {
        $compressionArray = [];

        $input = $this->input[0];
        $inputStringLength = strlen($input);

        preg_match_all('/\((\d+)x(\d+)\)/', $input, $matches, PREG_OFFSET_CAPTURE);

        $data = $matches[0];
        foreach ($data as $compressionInfo) {
            $compressionArray[$compressionInfo[1]] = $compressionInfo[0];
        }

        $compressionInfoPositions = array_keys($compressionArray);

        $pointer = 0;
        $resultString = '';

        while ($pointer < $inputStringLength) {
            if (in_array($pointer, $compressionInfoPositions)) {
                # Get compression info
                preg_match('/\((\d+)x(\d+)\)/', $compressionArray[$pointer], $matches);
                $compressionString = $matches[0];

                $numChars = $matches[1];
                $numMultiplications = $matches[2];

                $stringToMultiplicate = substr($input, ($pointer + strlen($compressionString)), $numChars);
                $multiplicatedString = str_repeat($stringToMultiplicate, $numMultiplications);

                $resultString .= $multiplicatedString;
                $pointer += $numChars + strlen($compressionString) - 1;
            } else {
                $resultString .= $input[$pointer];
            }

            $pointer++;
        }
        $this->length =  strlen($resultString);
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo  $this->length . PHP_EOL;
    }
}
