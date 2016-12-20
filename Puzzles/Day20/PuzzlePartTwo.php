<?php

namespace Puzzles\Day20;

/**
 * Puzzle day 20
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    protected function processInput()
    {
        $numIPS = 0;

        $list = [];
        foreach ($this->input as $ranges) {
            $ranges = trim($ranges);
            $line = explode('-', $ranges);
            $list[$line[0]] = $line[1];
        }

        ksort($list);

        $prevStartRange = key($list);
        $prevEndRange = $list[$prevStartRange];

        $highestIpFound = $prevEndRange;

        reset($list);
        unset($list[key($list)]);

        foreach ($list as $startRange => $endRange) {
            $numPrevElements = ($prevEndRange - $prevStartRange) + 1;
            $numThisElements = ($endRange - $startRange) + 1;
            $totalBoth = ($endRange - $prevStartRange) + 1;
            if ($totalBoth - ($numPrevElements + $numThisElements) > 0
                # AND START IP > HIGHEST FOUND + 1
                && $startRange > ($highestIpFound + 1)
            ) {
                $this->solution = ($prevEndRange + 1);
                //break;
                $numIPS ++;
            }

            if ($endRange > $highestIpFound) {
                $highestIpFound = $endRange;
            }

            $prevStartRange = $startRange;
            $prevEndRange = $endRange;
        }


        $this->solution = $numIPS;
    }
}
