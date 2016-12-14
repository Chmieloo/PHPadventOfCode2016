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
    public function __construct()
    {
        $this->loadInput();
        $this->processInput();
    }

    protected function loadInput()
    {
        $this->input = 'ngcjuoqr';
    }

    private function getHash($index)
    {
        $hash = md5($this->input . $index);

        for ($x = 1; $x <= 2016; $x++) {
            $hash = md5($hash);
        }

        return $hash;
    }

    private function isValidHash3($index)
    {
        $hash = $this->getHash($index);
        preg_match('/(.)\1\1/', $hash, $matches);
        if ($matches) {
            $str = $index . ' ' . $matches[0] . ' ';
            $char = $matches[0][0];
            for ($j = $index + 1; $j <= $index + 1000; $j++) {
                $hash5 = $this->getHash($j);
                preg_match('/[' . $char . ']{5}/', $hash5, $matches5);
                if ($matches5) {
                    $str .= $matches5[0] . ' ' . PHP_EOL;
                    return $str;
                }
            }
        }

        return false;
    }

    public function processInput()
    {
        $validHashes = [];
        #for ($i = 0; $i < 100; $i++)
        $i = 0;
        while(1)
        {
            if ($valid = $this->isValidHash3($i)) {
                $validHashes[$i] = $valid;
            }

            if (count($validHashes) == 64) {
                echo $i;
                break;
            }
            $i++;
        }

        $i = 1;
        foreach ($validHashes as $validHash) {
            echo $i . ' ' .$validHash . PHP_EOL;
            $i++;
        }
        //var_dump($validHashes);
    }

    private function processInstruction($pointer)
    {
        $line = $this->input[$pointer];
        $data = explode(' ', $line);

        switch ($data[0]) {
            case 'cpy':
                $this->instructionCopy($data);
                $this->pointer++;
                break;
            case 'inc':
                $this->instructionIncrease($data);
                $this->pointer++;
                break;
            case 'dec':
                $this->instructionDecrease($data);
                $this->pointer++;
                break;
            case 'jnz':
                $this->instructionJump($data);
                break;
        }
    }

    private function instructionCopy($instruction)
    {
        $from = trim($instruction[1]);
        $to = trim($instruction[2]);

        # integer to register
        if (is_numeric($from)) {
            static::$registers[$to] = $from;
        } else {
            static::$registers[$to] = static::$registers[$from];
        }
    }

    private function instructionIncrease($instruction)
    {
        $key = trim($instruction[1]);
        static::$registers[$key]++;
    }

    private function instructionDecrease($instruction)
    {
        $key = trim($instruction[1]);
        static::$registers[$key]--;
    }

    private function instructionJump($instruction)
    {
        $value = trim($instruction[1]);
        $to = trim($instruction[2]);

        # integer to register
        if (is_numeric($value)) {
            if ($value == 0) {
                $this->pointer++;
            } else {
                $this->pointer = $this->pointer + $to;
            }
        } else {
            $registryValue = static::$registers[$value];
            if ($registryValue == 0) {
                $this->pointer++;
            } else {
                $this->pointer = $this->pointer + $to;
            }
        }
    }

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
