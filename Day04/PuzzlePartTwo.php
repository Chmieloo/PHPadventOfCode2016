<?php

namespace Day04;

/**
 * Puzzle day 4
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo
{
    # File input
    private $input;

    # Output of result
    private $output;

    public function __construct()
    {
        $this->input = file('input');
        $this->processInput();
    }

    /**
     * Write to file
     */
    public function outputFile()
    {
        file_put_contents('output', print_r($this->output, true));
    }

    /**
     * Process input for puzzle
     * @return int
     */
    public function processInput()
    {
        $cycle = [
            'a', 'b', 'c', 'd', 'e', 'f', 'g',
            'h', 'i', 'j', 'k', 'l', 'm', 'n',
            'o', 'p', 'q', 'r', 's', 't', 'u',
            'v', 'w', 'x', 'y', 'z'
        ];

        foreach ($this->input as $key => $line) {
            # Get the checksum
            $splitString = explode('[', $line);
            $encryptedName = $splitString[0];

            $strings = explode('-', $encryptedName);

            # Get the shift value'
            $shift = array_pop($strings);

            # Put the array together again
            $encryptedName = join('-', $strings);

            $decryptedName = '';

            $characters = str_split($encryptedName);
            foreach ($characters as $character) {
                if ($character == '-') {
                    $newCharacter = ' ';
                } else {
                    $key = array_search($character, $cycle);
                    $key = ($key + $shift) % count($cycle);
                    $newCharacter = $cycle[$key];
                }

                $decryptedName .= $newCharacter;
            }

            $this->output .= $decryptedName . ' ' . $shift . PHP_EOL;
        }
    }
}

$puzzle = new PuzzlePartTwo();
$puzzle->outputFile();
