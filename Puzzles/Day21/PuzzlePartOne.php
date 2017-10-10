<?php

namespace Puzzles\Day21;

/**
 * Puzzle day 21
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    protected function processInput()
    {
        foreach ($this->input as $instruction) {
            $instruction = trim($instruction);
            $instructionWords = explode(' ', $instruction);

            switch ($instructionWords[0]) {
                case 'swap':
                    # Done
                    $this->swapInput($instruction);
                    break;
                case 'rotate':
                    # Done
                    $this->rotateInput($instruction);
                    break;
                case 'reverse':
                    $this->reverseInput($instruction);
                    break;
                case 'move':
                    $this->moveInput($instruction);
                    break;
            }
        }
    }

    /**
     * @param $instruction
     */
    private function swapInput($instruction)
    {
        /**
         * [swap position X with position Y]
         * - means that the letters at indexes X and Y (counting from 0) should be swapped.
         * [swap letter X with letter Y]
         * - means that the letters X and Y should be swapped (regardless of where they appear in the string).
         */
        if (strpos($instruction, 'swap position') === 0) {
            preg_match('/swap position (\d+) with position (\d+)/', $instruction, $matches);
            $x = $matches[1];
            $y = $matches[2];
            $letterAtPositionX = $this->inputString[$x];
            $this->inputString[$x] = $this->inputString[$y];
            $this->inputString[$y] = $letterAtPositionX;
        } elseif (strpos($instruction, 'swap letter') === 0) {
            preg_match('/swap letter (\w) with letter (\w)/', $instruction, $matches);
            $x = $matches[1];
            $y = $matches[2];
            $exploded = str_split($this->inputString);
            foreach ($exploded as $key => $letter) {
                if ($letter == $x) {
                    $letterXPositions[] = $key;
                } elseif ($letter == $y) {
                    $letterYPositions[] = $key;
                }
            }
            foreach ($letterXPositions as $index) {
                $this->inputString[$index] = $y;
            }
            foreach ($letterYPositions as $index) {
                $this->inputString[$index] = $x;
            }
        }
    }

    private function rotateInput($instruction)
    {
        /**
         * [rotate left/right X steps]
         * means that the whole string should be rotated; for example, one right rotation would turn abcd into dabc.
         */
        $inputArray = str_split($this->inputString);
        if (strpos($instruction, 'rotate left') === 0) {
            preg_match('/rotate left (\d+) steps/', $instruction, $matches);
            $steps = $matches[1];
            for ($i=0; $i<$steps; $i++){
                $element = array_shift($inputArray);
                array_push($inputArray, $element);
            }
        } elseif (strpos($instruction, 'rotate right') === 0) {
            preg_match('/rotate right (\d+) steps/', $instruction, $matches);
            $steps = $matches[1];
            for ($i=0; $i<$steps; $i++){
                $element = array_pop($inputArray);
                array_unshift($inputArray, $element);
            }
        }
        $this->inputString = join($inputArray);
    }

    /**
     * Reverse array slice between indexes
     */
    private function reverseInput($instruction)
    {
        $inputArray = str_split($this->inputString);
        if (strpos($instruction, 'reverse') === 0) {
            preg_match('/reverse positions (\d+) through (\d+)/', $instruction, $matches);
            $reverseStart = $matches[1];
            $reverseEnd = $matches[2];
            $exploded = str_split($this->inputString);
            $arrayChunk = 
                join(array_slice($exploded, 0, $reverseStart)) . 
                join(array_reverse(array_slice($exploded, $reverseStart, ($reverseEnd - $reverseStart + 1)))) . 
                join(array_slice($exploded, $reverseEnd + 1, count($exploded)));
            $this->inputString = $arrayChunk;
        }
    }

    private function moveInput($instruction)
    {
        $inputArray = str_split($this->inputString);
        if (strpos($instruction, 'move') === 0) {
            preg_match('/move position (\d+) to position (\d+)/', $instruction, $matches);
            $moveFrom = $matches[1];
            $moveTo = $matches[2];
            $exploded = str_split($this->inputString);
            $moveChar = $exploded[$moveFrom];
            unset($exploded[$moveFrom]);
            
            $exploded = array_values($exploded);
            $result = join(array_slice($exploded, 0, $moveTo)) .
                $moveChar .
                join(array_slice($exploded, $moveTo));
            $this->inputString = $result;
        }
    }
}
