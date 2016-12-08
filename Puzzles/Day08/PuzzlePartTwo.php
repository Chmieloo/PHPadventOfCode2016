<?php

namespace Puzzles\Day08;

/**
 * Puzzle day 8
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    /**
     * Process input for puzzle
     * @return int
     */
    public function processInput()
    {
        foreach ($this->input as $instruction) {
            if (substr($instruction, 0, 4) == 'rect') {
                $this->createRectangle($instruction);
            } elseif (substr($instruction, 0, 10) == 'rotate row') {
                $this->rotateRow($instruction);
            } elseif (substr($instruction, 0, 13) == 'rotate column') {
                $this->rotateColumn($instruction);
            }
        }

        $this->displayCardMap();
    }

    private function displayCardMap()
    {
        for ($i=0;$i<6;$i++) {
            $line = '';
            for ($j=0;$j<50;$j++) {
                if ($this->cardMap[$i][$j] == 0) {
                    $line .= ' ';
                } else {
                    $line .= '#';
                }
            }
            echo $line . PHP_EOL;
        }
    }
}
