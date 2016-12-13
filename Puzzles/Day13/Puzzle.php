<?php

namespace Puzzles\Day13;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 13
 * Common class for day 13
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    /*
     * Find x*x + 3*x + 2*x*y + y + y*y.
Add the office designer's favorite number (your puzzle input).
Find the binary representation of that sum; count the number of bits that are 1.
If the number of bits that are 1 is even, it's an open space.
If the number of bits that are 1 is odd, it's a wall.
     */

    private $exitX = 31;
    private $exitY = 39;
    private $designersNumber = 1364;

    # Array representation;
    private $labyrinth;

    public function __construct()
    {
        $this->loadInput();
        $this->processInput();
    }

    /**
     * Construct a labyrinth
     */
    protected function loadInput()
    {
        $this->constructLabyrinth();
    }

    private function constructLabyrinth()
    {
        for ($i = 0; $i <= $this->exitX; $i++) {
            for ($j = 0; $j <= $this->exitY; $j++) {
                if ($this->spaceType($i, $j) == 0) {
                    $this->labyrinth[$i][$j] = '.';
                } else {
                    $this->labyrinth[$i][$j] = '#';
                }
            }
        }
    }

    private function spaceType($x, $y)
    {
        $value = $x * $x + 3 * $x + 2 * $x * $y + $y + $y * $y;
        $value += $this->designersNumber;
        $binary = decbin($value);
        $split = str_split((string)$binary);
        $sum = array_sum($split);

        return ($sum % 2);
    }

    public function processInput()
    {
        #$spaceType = $this->spaceType($this->exitX, $this->exitY);
        #var_dump($spaceType);
        $this->drawLabyrinth();
    }

    public function drawLabyrinth()
    {
        $string = '';
        for ($i = 0; $i <= $this->exitX; $i++) {
            for ($j = 0; $j <= $this->exitY; $j++) {
                $string .= $this->labyrinth[$i][$j];
            }
            $string .= PHP_EOL;
        }

        echo $string;
    }

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
