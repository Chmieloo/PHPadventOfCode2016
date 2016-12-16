<?php

namespace Puzzles\Day14;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 14
 * Common class for day 14
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected static $salt;
    protected $validHashes;
    private $displayIndexes;

    public function __construct()
    {
        $this->loadInput();
        $this->initialize();
        $this->processInput();
    }

    protected function loadInput()
    {
    }

    private function initialize()
    {
        static::$salt = 'ngcjuoqr';
        $this->validHashes = [];
        $this->displayIndexes = true;
    }

    /**
     * @param $index
     * @return string
     */
    protected static function getHash($index)
    {
        return md5(static::$salt . $index);
    }

    /**
     * Return false if not valid, index of hash if valid
     * @param $index
     * @return bool|integer
     */
    private function isValidHash3($index)
    {
        $hash = static::getHash($index);
        preg_match('/(.)\1\1/', $hash, $matches);
        if ($matches) {
            $char = $matches[0][0];
            for ($j = $index + 1; $j <= $index + 1000; $j++) {
                $hash5 = static::getHash($j);
                preg_match('/[' . $char . ']{5}/', $hash5, $matches5);
                if ($matches5) {
                    return $index;
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
                if ($this->displayIndexes) {
                    //echo $valid . PHP_EOL;
                }
            }

            if (count($validHashes) == 64) {
                break;
            }
            $i++;
        }

        $this->validHashes = $validHashes;
    }

    /**
     * Direct output
     */
    public function renderSolution()
    {
        $lastHash = array_pop($this->validHashes);
        echo 'Solution: ' . $lastHash . PHP_EOL;
    }
}
