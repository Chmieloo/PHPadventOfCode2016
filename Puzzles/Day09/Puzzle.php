<?php

namespace Puzzles\Day09;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 8
 * Common class for day 8
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    # Card representation
    protected $cardMap;

    public function __construct()
    {
        $this->initialize();
        $this->loadInput();
        $this->processInput();
    }

    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
    }

    protected function initialize()
    {
    }

    /**
     * Process input for puzzle
     * @return int
     */
    public function processInput()
    {
        $stringLength = strlen($this->input);
        //for ($i=0;$i<$x;$i++) {
    }

    /**
     * Add pixels to array
     * @param $instruction
     */
    protected function createRectangle($instruction)
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

    /**
     * @param $instruction
     */
    protected function rotateRow($instruction)
    {
        preg_match('/rotate row y=(\d+) by (\d+)/', $instruction, $matches);

        $row = $matches[1];
        $shift = $matches[2];

        for ($i=0;$i<$shift;$i++) {
            $element = array_pop($this->cardMap[$row]);
            array_unshift($this->cardMap[$row], $element);
        }
    }

    /**
     * @param $instruction
     */
    protected function rotateColumn($instruction)
    {
        # Temporary column to hold the cardMap values
        $col = [];

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

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
