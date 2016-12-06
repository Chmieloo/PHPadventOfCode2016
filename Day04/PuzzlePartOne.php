<?php

namespace Day04;

/**
 * Puzzle day 2
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
        $this->sum = 0;
    }

    /**
     * Process input for puzzle
     * @return int
     */
    public function processInput()
    {

        foreach ($this->input as $key => $line) {
            # Get the checksum
            $splitString = explode('[', $line);
            $encryptedName = $splitString[0];
            $checksumDirty = $splitString[1];

            # Get rid of the square bracket
            $checksumLine = substr(trim($checksumDirty), 0, -1);

            list($checksum, $number) = $this->getChecksum($encryptedName);
            if ($checksum == $checksumLine) {
                $this->sum += $number;
            }
        }

        return $this->sum;
    }

    /**
     * @param $encryptedName
     * @return array
     */
    private function getChecksum($encryptedName)
    {
        $checksumArray = [];

        $strings = explode('-', $encryptedName);

        # This is the value to return if the checksum is right
        $number = array_pop($strings);

        # Put all the letters together
        $string = join('', $strings);

        # Get all individual letters
        $letters = str_split($string);

        foreach ($letters as $key => $letter) {
            if (array_key_exists($letter, $checksumArray)) {
                $checksumArray[$letter]++;
            } else {
                $checksumArray[$letter] = 1;
            }
        }

        # Sort array by number of letter occurrences, then alphabetically
        array_multisort(array_values($checksumArray), SORT_DESC, array_keys($checksumArray), SORT_ASC, $checksumArray);

        # Get only the first 5 characters and merge them into checksum
        $checksum = join('', array_slice(array_keys($checksumArray), 0, 5));

        return [$checksum, $number];
    }
}

$puzzle = new PuzzlePartOne();
$sum = $puzzle->processInput();
echo "Solution: " . $sum;
