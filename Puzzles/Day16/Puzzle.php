<?php

namespace Puzzles\Day16;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 16
 * Common class for day 16
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $input = '10001110011110000';
    protected $data;

    protected $solution;

    public function __construct()
    {
        $this->processInput();
    }

    protected function loadInput()
    {
    }

    protected function processInput()
    {
        $first = $this->input;
        $replace = ['0' => '1', '1' => '0'];

        while (strlen($first) < static::$length) {
            $suffix = strrev($first);
            $suffix = strtr($suffix, $replace);
            $first = $first . '0' . $suffix;
        }
        $this->data = substr($first, 0, static::$length);

        while(1) {
            $next = '';
            $len = strlen($this->data) / 2;
            for ($i = 0; $i < $len; $i++) {
                if ($this->data[$i*2] == $this->data[($i*2)+1]) {
                    $next .= 1;
                } else {
                    $next .= 0;
                }
            }

            if (strlen($next) % 2 != 0) {
                $this->solution = $next;
                break;
            }

            # Assign the new string value to next loop
            $this->data = $next;
        }
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        echo 'Solution: ' . $this->solution . PHP_EOL;
    }
}
