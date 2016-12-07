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
        foreach ($this->input as $line) {

            $brackets = '';
            $regular = '';

            $strings = explode('[', $line);
            $regular .= array_shift($strings);
            var_dump($strings);

            foreach ($strings as $string) {
                $substrings = explode(']', $string);
                foreach ($substrings as $substring) {
                    $brackets .= $substring[0];
                    $regular .= $substring[1];
                }
            }

            if (!$this->isMirrored($brackets)) {
                if ($this->isMirrored($regular)) {
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
        for ($i=0;$i<strlen($string)-2;$i++) {
            $controlCharacters = substr($string, $i, 2);
            $reverseCharacters = strrev(substr($string, $i+2, 2));

            if ($controlCharacters == $reverseCharacters) {
                return true;
            }
        }

        return $result;
    }
}

$puzzle = new PuzzlePartOne();
$sum = $puzzle->processInput();
echo "Solution: " . $sum;
