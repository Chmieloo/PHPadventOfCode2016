<?php

// Put puzzle input into string
$input = file_get_contents('input.txt');

$directionsArray = explode(',', $input);

$currentPositionX = 0;
$currentPositionY = 0;

// This represents an angle
$currentDirection = 0;

foreach ($directionsArray as $step) {
    $step = trim($step);
    $turn = substr($step, 0, 1);
    $distance = substr($step, -1 * (strlen($step) - 1));

    // Check where we're facing
    $currentDirection += ($turn == 'L' ? -90 : 90);
    if ($currentDirection % 360 == 0) {
        $currentDirection= 0;
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

$distanceTotal = abs($currentPositionX) + abs($currentPositionY);
echo "Total distance: " . $distanceTotal;
