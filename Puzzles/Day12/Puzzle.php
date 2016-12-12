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
    protected $registers = [
        'a' => 0,
        'b' => 0,
        'c' => 1,
        'd' => 0,
    ];
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
        $j = 0;
        do {
            $this->processInstruction($this->pointer);
            //echo $this->registers['a'] . ' ' . $this->registers['b'] . PHP_EOL;
            $j++;
        } while ($this->pointer < count($this->input));

        echo $j . PHP_EOL;
        var_dump($this->registers);
    }

    private function processInstruction($pointer)
    {
        //echo 'Processing instruction: ' . ($pointer + 1). PHP_EOL;
        $line = $this->input[$pointer];
        $data = explode(' ', $line);

        switch ($data[0]) {
            case 'cpy':
                $this->instructionCopy($data);
                $this->display();
                $this->pointer++;
                break;
            case 'inc':
                $this->instructionIncrease($data);
                $this->display();
                $this->pointer++;
                break;
            case 'dec':
                $this->instructionDecrease($data);
                $this->display();
                $this->pointer++;
                break;
            case 'jnz':
                $this->instructionJump($data);
                $this->display();
                break;
        }
    }

    private function instructionCopy($instruction)
    {
        $from = trim($instruction[1]);
        $to = trim($instruction[2]);

        # integer to register
        if (is_numeric($from)) {
            $this->registers[$to] = $from;
        } else {
            $this->registers[$to] = $this->registers[$from];
        }
    }

    private function instructionIncrease($instruction)
    {
        $key = trim($instruction[1]);
        $this->registers[$key]++;
    }

    private function instructionDecrease($instruction)
    {
        $key = trim($instruction[1]);
        $this->registers[$key]--;
    }

    private function instructionJump($instruction)
    {
        $value = trim($instruction[1]);
        $to = trim($instruction[2]);

        # integer to register
        if (is_numeric($value)) {
            # Check if it is 0
            if ($value == 0) {
                $this->pointer++;
            } else {
                $this->pointer = $this->pointer + $to;
            }
        } else {
            $registryValue = $this->registers[$value];
            if ($registryValue == 0) {
                $this->pointer++;
            } else {
                $this->pointer = $this->pointer + $to;
            }
        }
    }

    private function display()
    {
        //var_dump($this->registers);
    }

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
