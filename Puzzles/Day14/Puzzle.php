<?php

namespace Puzzles\Day14;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 12
 * Common class for day 12
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected static $salt;
    protected $validHashes;

    public function __construct()
    {
        $this->loadInput();
        $this->processInput();
    }

    protected function loadInput()
    {
        static::$salt = $salt = 'ngcjuoqr';
        $this->validHashes = [];
    }

    protected static function getHash($index)
    {
        $hash = md5(static::$salt . $index);
/*
        for ($x = 1; $x <= 2016; $x++) {
            $hash = md5($hash);
        }
*/
        return $hash;
    }

    private function isValidHash3($index)
    {
        $hash = static::getHash($index);
        preg_match('/(.)\1\1/', $hash, $matches);
        if ($matches) {
            $str = $index . ' ' . $matches[0] . ' ';
            $char = $matches[0][0];
            for ($j = $index + 1; $j <= $index + 1000; $j++) {
                $hash5 = static::getHash($j);
                preg_match('/[' . $char . ']{5}/', $hash5, $matches5);
                if ($matches5) {
                    $str .= $matches5[0] . ' ' . PHP_EOL;
                    var_dump($hash);
                    return $str;
                }
            }
        }

        return false;
    }

    public function processInput()
    {
        $validHashes = [];
        $i = 0;
        while(1)
        {
            if ($valid = $this->isValidHash3($i)) {
                $validHashes[$i] = $valid;
            }

            if (count($validHashes) == 64) {
                break;
            }
            $i++;
        }

        $this->validHashes = $validHashes;
    }

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
