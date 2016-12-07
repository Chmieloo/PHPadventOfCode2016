<?php

namespace Puzzles\Day04;

use Puzzles\Abstraction\Puzzle;

/**
 * Puzzle day 4
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    private $searchPhrase = 'northpole object storage';

    # Output of result
    private $output;

    public function __construct()
    {
        $this->loadInput();
        $this->processInput();
    }

    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
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

            if ($decryptedName == $this->searchPhrase) {
                $this->output = $shift;
            }
        }
    }

    /**
     * Output to file
     */
    public function renderSolution()
    {
        echo 'Sector ID: ' . $this->output . PHP_EOL;
    }
}
