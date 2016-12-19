<?php

namespace Puzzles\Day19;

/**
 * Puzzle day 19
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    protected function processInput()
    {
        $elves = array_fill(0, $this->numElves, 1);

        $resultArray = $elves;
        while (count($resultArray) > 1) {
            for ($i = 0; $i < $this->numElves; $i++) {
                if ($elves[$i] == 0) {
                    continue;
                } else {
                    $nexElfIndex = $this->findNextElfIndex($i, $elves);
                    $elves[$i] += $elves[$nexElfIndex];
                    $elves[$nexElfIndex] = 0;
                }
            }
            $resultArray = array_filter($elves);
        }

        $this->solution = array_keys($resultArray)[0] + 1;
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
}
