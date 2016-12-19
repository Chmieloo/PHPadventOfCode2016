<?php

namespace Puzzles\Day19;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 18
 * Common class for day 18
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    private $solution;
    private $numElves = 5;//3014387;

    public function __construct()
    {
        $this->loadInput();
        $this->processInput();
    }

    protected function loadInput()
    {
    }

    protected function processInput()
    {
        $elves = array_fill(0, $this->numElves, 1);
        //var_dump($elves[3014386]);

        $resultArray = $elves;
        while (count($resultArray) > 1) {
            for ($i = 0; $i < $this->numElves; $i++) {
                if ($elves[$i] == 0) {
                    continue;
                } else {
                    $nexElfIndex = $this->findNextElfIndex($i, $elves); //$i + 1) % $numElves;
                    if (!$nexElfIndex) {
                        echo $i;
                        return 100;
                    }
                    $elves[$i] += $elves[$nexElfIndex];
                    $elves[$nexElfIndex] = 0; //$elves[$nexElfIndex] - 1 < 0 ? 0 : $elves[$nexElfIndex] - 1;
                }
            }
            $resultArray = array_filter($elves);
        }

        var_dump(array_filter($elves));
    }

    private function findNextElfIndex($i, $elves)
    {
        for ($j = 1; $j <= $this->numElves; $j++) {
            $nextIndex = ($i + $j) % $this->numElves;
            if ($elves[$nextIndex] != 0){
                return $nextIndex;
            }
        }
        return null;
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
