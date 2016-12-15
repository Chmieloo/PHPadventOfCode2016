<?php

namespace Puzzles\Day05;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 05
 * Common class for day 05
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $input = 'reyedfim';

    protected $password;

    public function __construct()
    {
        $this->processInput();
    }

    protected function loadInput()
    {
    }

    protected function processInput()
    {
        $this->password = $this->getPassword();
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . $this->password . PHP_EOL;
    }
}
