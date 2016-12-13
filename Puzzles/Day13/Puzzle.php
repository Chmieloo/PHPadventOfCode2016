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
    protected $solution1;
    protected $solution2;

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
        for ($i = 0; $i <= $this->exitX + 1; $i++) {
            for ($j = 0; $j <= $this->exitY + 1; $j++) {
                if ($this->spaceType($i, $j) == 0) {
                    $this->labyrinth[$i][$j] = '...';
                } else {
                    $this->labyrinth[$i][$j] = '███';
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

    private function processInput()
    {
        $counter = 0;
        $this->labyrinth[1][1] = 0;
        # A bit dirty way to solve it since there has to be enough loops to fill all neighbors
        # Possible check would be to keep a flag indicating if there are more elements < 50 with neighbors
        for($x = 0; $x < 20; $x ++) {
            for ($i = 0; $i <= $this->exitX + 10; $i++) {
                for ($j = 0; $j <= $this->exitY + 10; $j++) {
                    if (isset($this->labyrinth[$i][$j]) && is_numeric($this->labyrinth[$i][$j])) {

                        # Find neighbors for these coordinates
                        $possibleMoves = $this->possibleMoves($i, $j);

                        foreach ($possibleMoves as $possibleMove) {
                            if (isset($this->labyrinth[$possibleMove[0]][$possibleMove[1]]) &&
                                is_numeric($this->labyrinth[$possibleMove[0]][$possibleMove[1]])) {
                            } else {
                                $this->labyrinth[$possibleMove[0]][$possibleMove[1]] = $this->labyrinth[$i][$j] + 1;
                                $counter++;
                            }
                        }
                    }
                }
            }
        }

        $visited = 0;
        for ($i = 0; $i <= $this->exitX + 10; $i++) {
            for ($j = 0; $j <= $this->exitY + 10; $j++) {
                if (isset($this->labyrinth[$i][$j]) &&
                    is_numeric($this->labyrinth[$i][$j]) &&
                    $this->labyrinth[$i][$j] <= 50
                ) {
                    $visited++;
                }
            }
        }

        $this->solution1 = $this->labyrinth[$this->exitX][$this->exitY];
        $this->solution2 = $visited;
    }

    /**
     * @param $x
     * @param $y
     * @return array
     */
    public function possibleMoves($x, $y)
    {
        $possibleMoves = [];
        $up = [$x - 1, $y];
        $left = [$x, $y - 1];
        $down = [$x + 1, $y];
        $right = [$x, $y + 1];

        if ($left[0] >= 0 && $left[1] >= 0 && $this->spaceType($left[0], $left[1]) == 0) {
            $possibleMoves[] = $left;
        }
        if ($down[0] >= 0 && $down[1] >= 0 && $this->spaceType($down[0], $down[1]) == 0) {
            $possibleMoves[] = $down;
        }
        if ($right[0] >= 0 && $right[1] >= 0 && $this->spaceType($right[0], $right[1]) == 0) {
            $possibleMoves[] = $right;
        }
        if ($up[0] >= 0 && $up[1] >= 0 && $this->spaceType($up[0], $up[1]) == 0) {
            $possibleMoves[] = $up;
        }

        return $possibleMoves;
    }

    public function drawLabyrinth()
    {
        $string = '';
        for ($i = 0; $i <= $this->exitX + 1; $i++) {
            for ($j = 0; $j <= $this->exitY + 1; $j++) {
                $string .= str_pad($this->labyrinth[$i][$j], 3, 0, STR_PAD_LEFT) . ' ';
            }
            $string .= PHP_EOL . PHP_EOL;
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
