<?php

namespace Puzzles\Day12;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 12
 * Common class for day 12
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected static $registers;
    protected $pointer = 0;

    public function __construct()
    {
        $this->loadInput();
        $this->processInput();
    }

    protected function loadInput()
    {
        if (file_exists(__DIR__ . '/' . static::$fileName)) {
            $this->input = file(__DIR__ . '/' . static::$fileName);
        }
    }

    public function processInput()
    {
        do {
            $this->processInstruction($this->pointer);
        } while ($this->pointer < count($this->input));
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
