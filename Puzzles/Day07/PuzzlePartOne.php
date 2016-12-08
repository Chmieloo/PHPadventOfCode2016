<?php

namespace Puzzles\Day07;

/**
 * Puzzle day 7
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    /**
     * PuzzlePartOne constructor.
     */
    public function __construct()
    {
        $this->initialize();
        $this->loadInput();
        $this->processInput();
    }

    protected function initialize()
    {
        $this->sum = 0;
    }

    /**
     * Process input for puzzle
     * @return int
     */
    public function processInput()
    {
        $output = '';

        foreach ($this->input as $line) {
            $regular = preg_split('/\[([a-z]+)\]/', $line);
            $regular = join(' ', $regular);

            preg_match_all('/\[([a-z]+)\]/', $line, $matches);
            $brackets = join(' ', $matches[1]);

            if (!$this->isMirrored($brackets)) {
                if ($this->isMirrored($regular)) {
                    $output .= $line . PHP_EOL;
                    $this->sum++;
                }
            }
        }
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Sum: ' . $this->sum . PHP_EOL;
    }
}
