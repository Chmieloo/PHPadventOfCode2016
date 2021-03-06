<?php

namespace Puzzles\Day01;

class PuzzlePartOne extends Puzzle
{
    private $distanceTotal;

    public function processInput()
    {
        $this->distanceTotal = 0;

        $currentPositionX = 0;
        $currentPositionY = 0;
        $currentDirection = 0;

        $directionsArray = explode(',', $this->input[0]);
        foreach ($directionsArray as $step) {
            $step = trim($step);
            $turn = substr($step, 0, 1);
            $distance = substr($step, -1 * (strlen($step) - 1));
            // Check where we're facing
            $currentDirection += ($turn == 'L' ? -90 : 90);
            if ($currentDirection % 360 == 0) {
                $currentDirection = 0;
            }
            // Move by given distance changing the coordinates
            switch ($currentDirection) {
                case 0:
                    $currentPositionY += $distance;
                    break;
                case 90:
                case -270:
                    $currentPositionX += $distance;
                    break;
                case -90:
                case 270:
                    $currentPositionX -= $distance;
                    break;
                case 180:
                case -180:
                    $currentPositionY -= $distance;
                    break;
            }
        }
        $this->distanceTotal = abs($currentPositionX) + abs($currentPositionY);
    }

    public function renderSolution()
    {
        echo 'Solution: ' . $this->distanceTotal . PHP_EOL;
    }
}
