<?php

namespace Day07;

/**
 * Puzzle day 7
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne
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
            $regular = join(' ', $regular);

            preg_match_all('/\[([a-z]+)\]/', $line, $matches);
            $brackets = join(' ', $matches[1]);

            if (!$this->isMirrored($brackets)) {
                if ($this->isMirrored($regular)) {
                    $output .= $line . PHP_EOL;
                    $sum++;
                }
            }
        }

        echo $sum . PHP_EOL;
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

$puzzle = new PuzzlePartOne();
$sum = $puzzle->processInput();
echo "Solution: " . $sum;
