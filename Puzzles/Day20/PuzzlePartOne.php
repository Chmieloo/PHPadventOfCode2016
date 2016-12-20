<?php

namespace Puzzles\Day20;

/**
 * Puzzle day 20
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    protected function processInput()
    {
        $list = [];
        foreach ($this->input as $ranges) {
            $ranges = trim($ranges);
            $line = explode('-', $ranges);
            $list[$line[0]] = $line[1];
        }

        ksort($list);

        $lowestIpLow = key($list);
        $lowestIpHigh = $list[$lowestIpLow];

        $highestIpTotal = $lowestIpHigh;

        reset($list);
        unset($list[key($list)]);

        foreach ($list as $lowIP => $highIP) {
            # If the key of the next row is higher then the last highIP + 1,
            # solution equals this key
            if ($lowIP > ($lowestIpHigh + 1) && ($lowestIpHigh+1) > $highestIpTotal) {
                $this->solution = $lowestIpHigh + 1;
                break;
            } else {
                $lowestIpHigh = $highIP;
                if ($highIP > $highestIpTotal) {
                    $highestIpTotal = $highIP;
                }
            }
        }
    }
}
