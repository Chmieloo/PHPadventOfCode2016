<?php

namespace Day05;

/**
 * Puzzle day 5
 * Class PuzzlePartTwo
 * Advent Of Code 2016
 */
class PuzzlePartTwo
{
    private $inputString;
    private $password = [];

    public function __construct($input)
    {
        $this->inputString = $input;
    }

    /**
     * @return string
     */
    public function checkHash()
    {
        $i = 0;
        do {
            $hashInput = $this->inputString . $i;
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

        return $this->password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->checkHash();
    }
}

$input = 'reyedfim';
$puzzle = new PuzzlePartOne($input);
$pass = $puzzle->getPassword();
ksort($pass);
var_dump(join($pass));
