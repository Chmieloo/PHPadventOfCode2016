<?php

namespace Puzzles\Day01;

class PuzzlePartTwo extends Puzzle
{
    private $distanceTotal;

    public function processInput()
    {
        # Put puzzle input into string
        $directionsArray = explode(',', $this->input[0]);
        $allVisitedCoordinates = [];
        $currentPositionX = 0;
        $currentPositionY = 0;
        # This represents an angle
        $currentDirection = 0;
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
                    for ($i = 1; $i <= $distance; $i++) {
                        $nextCoordinates = $currentPositionX . ':' . ($currentPositionY + $i);
                        $allVisitedCoordinates[] = $nextCoordinates;
                    }
                    $currentPositionY += $distance;
                    break;
                case 90:
                case -270:
                    for ($i = 1; $i <= $distance; $i++) {
                        $nextCoordinates = ($currentPositionX + $i) . ':' . $currentPositionY;
                        $allVisitedCoordinates[] = $nextCoordinates;
                    }
                    $currentPositionX += $distance;
                    break;
                case -90:
                case 270:
                    for ($i = 1; $i <= $distance; $i++) {
                        $nextCoordinates = ($currentPositionX - $i) . ':' . $currentPositionY;
                        $allVisitedCoordinates[] = $nextCoordinates;
                    }
                    $currentPositionX -= $distance;
                    break;
                case 180:
                case -180:
                    for ($i = 1; $i <= $distance; $i++) {
                        $nextCoordinates = $currentPositionX . ':' . ($currentPositionY - $i);
                        $allVisitedCoordinates[] = $nextCoordinates;
                    }
                    $currentPositionY -= $distance;
                    break;
            }
        }
        $countArray = [];
        foreach ($allVisitedCoordinates as $key => $coordinates) {
            if (array_key_exists($coordinates, $countArray)) {
                $countArray[$coordinates]++;
                $c = $coordinates;
                break;
            } else {
                $countArray[$coordinates] = 1;
            }
        }
        $coordinates = explode(':', $c);
        $this->distanceTotal = abs($coordinates[0]) + abs($coordinates[1]);
    }

    public function renderSolution()
    {
        echo 'Solution: ' . $this->distanceTotal . PHP_EOL;
    }
}
