<?php

namespace Day08;

/**
 * Puzzle day 8
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartTwo
{
    # File input
    private $input;

    private $cardMap = [
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    ];

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
        foreach ($this->input as $instruction) {
            if (substr($instruction, 0, 4) == 'rect') {
                $this->createRectangle($instruction);
            } elseif (substr($instruction, 0, 10) == 'rotate row') {
                $this->rotateRow($instruction);
            } elseif (substr($instruction, 0, 13) == 'rotate column') {
                $this->rotateColumn($instruction);
            }
        }

        $countPixels = $this->countPixels();

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
        #file_put_contents('output',print_r($this->cardMap, true));

        echo $countPixels . PHP_EOL;
    }

    private function countPixels()
    {
        $sum = 0;

        for ($i=0;$i<6;$i++) {
            $sum += array_sum($this->cardMap[$i]);
        }

        return $sum;
    }

    private function createRectangle($instruction)
    {
        preg_match('/rect\s+(\d+)x(\d+)/', $instruction, $matches);
        $x = $matches[1];
        $y = $matches[2];

        for ($i=0;$i<$x;$i++) {
            for ($j=0;$j<$y;$j++) {
                $this->cardMap[$j][$i] = 1;
            }
        }
    }

    private function rotateRow($instruction)
    {
        preg_match('/rotate row y=(\d+) by (\d+)/', $instruction, $matches);

        $row = $matches[1];
        $shift = $matches[2];

        for ($i=0;$i<$shift;$i++) {
            $element = array_pop($this->cardMap[$row]);
            array_unshift($this->cardMap[$row], $element);
        }
    }

    private function rotateColumn($instruction)
    {
        preg_match('/rotate column x=(\d+) by (\d+)/', $instruction, $matches);

        $column = $matches[1];
        $shift = $matches[2];

        # Get cardMap column as an array
        for ($i=0;$i<6;$i++) {
            $col[] = $this->cardMap[$i][$column];
        }

        for ($i=0;$i<$shift;$i++) {
            $element = array_pop($col);
            array_unshift($col, $element);
        }

        for ($i=0;$i<6;$i++) {
            $this->cardMap[$i][$column] = $col[$i];
        }
    }
}

$puzzle = new PuzzlePartTwo();
$sum = $puzzle->processInput();
echo "Solution: " . $sum;
