<?php

namespace Puzzles\Day09;

/**
 * Puzzle day 9
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    private $length;

    public function processInput()
    {
        $input = $this->input[0];
        $this->length = $this->recursiveDecompression($input);
    }

    /**
     * @param $string
     * @return int
     */
    private function recursiveDecompression($string)
    {
        $length = strlen($string);

        for ($i = 0; $i < strlen($string); $i++) {
            if ($string[$i] === '(') {
                if (preg_match('/^\((\d+)x(\d+)\)/', substr($string, $i), $matches)) {
                    $compressionInfo = $matches[0];
                    $matchLength = $matches[1];
                    $repetitions = $matches[2];
                    # Beginning index of string to multiply
                    $start = $i + strlen($compressionInfo);
                    # String to multiply
                    $matchStr = substr($string, $start, $matchLength);
                    $decompressedLength = $this->recursiveDecompression($matchStr);
                    # Substract one occurrence of substring to be multiplied and the compression info length
                    $length += $decompressedLength * $repetitions - strlen($matchStr) - strlen($compressionInfo);
                    # Move the pointer behind
                    $i = $start + strlen($matchStr) - 1;
                }
            }
        }

        return $length;
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . $this->length . PHP_EOL;
    }
}
