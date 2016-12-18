<?php

namespace Puzzles\Day18;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 18
 * Common class for day 18
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    private $solution;

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

    protected function processInput()
    {
        $input = $this->input[0];

        $safeTiles = $this->countTilesInRow($input);
        $rowLength = strlen($input);

        $prevRow = $input;

        for ($x = 0; $x < $this->numRows - 1; $x++) {

            $nextRow = '';
            for ($i = 0; $i < $rowLength; $i++) {
                if ($i == 0) {
                    $triplet = '.' . $prevRow[$i] . $prevRow[$i + 1];
                } elseif ($i == ($rowLength - 1)) {
                    $triplet = $prevRow[$i - 1] . $prevRow[$i] . '.';
                } else {
                    $triplet = $prevRow[$i - 1] . $prevRow[$i] . $prevRow[$i + 1];
                }
                $nextRow .= $this->getTile($triplet);
            }

            $safeTiles += $this->countTilesInRow($nextRow);
            $prevRow = $nextRow;
        }

        $this->solution = $safeTiles;
    }

    /**
     * @param $triplet
     * @return string
     */
    private function getTile($triplet)
    {
        switch ($triplet) {
            case '^^.':
            case '.^^':
            case '^..':
            case '..^':
                $tile = '^';
                break;
            default:
                $tile = '.';
                break;
        }

        return $tile;
    }

    /**
     * @param $row
     * @return int
     */
    private function countTilesInRow($row)
    {
        return substr_count($row, '.');
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . $this->solution . PHP_EOL;
    }
}
