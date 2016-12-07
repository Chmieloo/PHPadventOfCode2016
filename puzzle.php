<?php

require_once 'vendor/autoload.php';

$test = new Day04\PuzzlePartOne();

$options = getopt('d:p:');
if (empty($options)){
    echo PHP_EOL;
    echo "No options specified, usage:" . PHP_EOL . PHP_EOL;
    echo "php puzzle.php -d NUMBER -p NUMBER" . PHP_EOL . PHP_EOL;
    echo "-d NUMBER (AoC day number)" . PHP_EOL;
    echo "-p NUMBER (Puzzle part for given day)" . PHP_EOL;
    echo PHP_EOL;
    exit();
}

if (isset($options['d']) && isset($options['p'])) {
    echo "Puzzle for day " . $options['d'] . ', part ' . $options['p'] . PHP_EOL;
}

$fileNameMapping = [
    1 => 'One',
    2 => 'Two',
    3 => 'Three'
];

$pathDirectory = 'Day' . str_pad($options['d'], 2, '0', STR_PAD_LEFT);
$pathFile = 'PuzzlePart' . $fileNameMapping[$options['p']];

$classPathName = $pathDirectory . '/' . $pathFile;
$puzzle = new $classPathName;

var_dump($puzzle);
