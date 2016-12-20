<?php

namespace Puzzles\Day19;

/**
 * Puzzle day 19
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    protected function processInput()
    {
        $numElves = 5;//$this->numElves;

        for ($i=0;$i<$numElves;$i++) {
            $elves[$i] = $i;
        }

        echo 'Initial: ' . join(' ', $elves) . PHP_EOL;

        while ($numElves > 1) {
            # Reindex ?
            //$elves = array_values($elves);
            //$numElves = count($elves);
            $middle = (int) floor($numElves / 2);
            echo $middle . PHP_EOL;
            # Remove element
            unset($elves[$middle]);
            $numElves--;

            $element = reset($elves); // also returns element
            unset($elves[key($elves)]);

            $elves[] = $element;

            //unset($elves[0]);

            echo 'Step: ' . join(' ', $elves) . PHP_EOL;
            if ($numElves % 10 == 0) {
                echo $numElves . PHP_EOL;
            }
            //echo $numElves . PHP_EOL;
            //sleep(1);
        }

        $this->solution = array_values($elves)[0] + 1;

    }
}
