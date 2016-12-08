<?php

namespace Puzzles\Day07;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 7
 * Common class for day 8
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
    }

    /**
     * @param $string
     * @return bool
     */
    public function isMirrored($string)
    {
        $result = false;
        for ($i=0;$i<strlen($string)-3;$i++) {
            $controlCharacters = substr($string, $i, 2);
            $reverseCharacters = strrev(substr($string, $i+2, 2));

            if ($controlCharacters == $reverseCharacters && $controlCharacters[0] != $controlCharacters[1]) {
                return true;
            }
        }

        return $result;
    }

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
