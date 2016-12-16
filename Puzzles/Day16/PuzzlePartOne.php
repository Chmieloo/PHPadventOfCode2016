<?php

namespace Puzzles\Day16;

/**
 * Puzzle day 5
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne extends Puzzle
{
    /**
     * @return string
     */
    public function getPassword()
    {
        $i = 0;
        do {
            $hashInput = $this->input . $i;
            $hash = md5($hashInput);
            if (substr($hash, 0, 5) === '00000') {
                $this->password .= substr($hash, 5, 1);
            }
            $i++;
        } while (strlen($this->password) < 8);

        return $this->password;
    }
}
