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
    protected $input2;
    private $length = 35651584;
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

        while (strlen($first) < $this->length) {
            $suffix = strrev($first);
            $suffix = strtr($suffix, $replace);
            $first = $first . '0' . $suffix;
        }
        //echo $first . ' length: ' . strlen($first) . PHP_EOL;

        $input2 = substr($first, 0, $this->length);
        //echo "INPUT2: " . $input2 . PHP_EOL;
        $this->input2 = $input2;

        $j = 0;
        while(1) {
            $next = '';
            for ($i = 0; $i < strlen($this->input2) / 2; $i++) {
                $chunk = substr($this->input2, $i*2, 2);

                $xorArray = str_split($chunk);
                //var_dump($xorArray);
                $result = (((int)$xorArray[0] xor (int)$xorArray[1]) + 1) % 2;
                $next .= (string) $result;
            }

            //echo 'Checksum: ' . $next. ' Length: ' . strlen($next) . PHP_EOL;

            if (strlen($next) % 2 != 0) {
                echo PHP_EOL . 'NEXT:' . $next . PHP_EOL;
                break;
            }

            $this->input2 = $next;
            //echo PHP_EOL . $input2 . PHP_EOL;
            $j++;
        }
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        //echo 'Solution: ' . $this->solution . PHP_EOL;
    }
}
