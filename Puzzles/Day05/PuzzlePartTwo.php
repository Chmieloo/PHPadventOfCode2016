<?php

namespace Puzzles\Day05;

/**
 * Puzzle day 5
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo extends Puzzle
{
    protected $password = [];

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
                $char6 = substr($hash, 5, 1);
                if (is_numeric($char6) && $char6 >= 0 && $char6 <= 7) {
                    $char7 = substr($hash, 6, 1);
                    if (!array_key_exists($char6, $this->password)) {
                        $this->password[$char6] = $char7;
                    }
                }
            }
            $i++;
        } while (count($this->password) < 8);

        $pass = $this->password;
        ksort($pass);
        $this->password = join($pass);

        return $this->password;
    }
}
