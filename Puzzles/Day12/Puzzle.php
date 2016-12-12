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
    protected $registers;
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
            echo $this->pointer . PHP_EOL;
        } while ($this->pointer <= count($this->input));

        var_dump($this->registers);
    }

    private function processInstruction($pointer)
    {
        echo 'Processing instruction: ' . $pointer . PHP_EOL;
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
        $from = $instruction[1];
        $to = $instruction[2];

        preg_match('/([a-z])+/', $from, $matchesLettersFrom);
        preg_match('/(\d+)/', $from, $matchesDigitsFrom);

        preg_match('/([a-z])+/', $from, $matchesLettersTo);
        preg_match('/(\d+)/', $from, $matchesDigitsTo);

        # integer to register
        if ($matchesDigitsFrom[0]) {
            $this->registers[$to] = (int) $from;
        }
        if ($matchesLettersFrom[0]) {
            $this->registers[$to] = $this->registers[$from];
        }
    }

    private function instructionIncrease($instruction)
    {
        $key = $instruction[1];
        $this->registers[$key]++;
    }

    private function instructionDecrease($instruction)
    {
        $key = $instruction[1];
        $this->registers[$key]--;
    }

    private function instructionJump($instruction)
    {
        $targetPosition = $instruction[2];
        if ($this->registers[$instruction[1]]) {
            # Move pointer
            $this->pointer = $this->pointer + (int) $targetPosition;
            if ($targetPosition < 0)
                echo $this->pointer . PHP_EOL;
        } else {
            $this->pointer++;
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
