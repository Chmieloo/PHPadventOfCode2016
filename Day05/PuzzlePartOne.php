<?php

namespace Day05;

/**
 * Puzzle day 5
 * Class PuzzlePartOne
 * Advent Of Code 2016
 */
class PuzzlePartOne
{
    private $inputString;
    private $password;

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
                $this->password .= substr($hash, 5, 1);
            }
            $i++;
        } while (strlen($this->password) < 8);

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
echo $pass;
