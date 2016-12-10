<?php

namespace Puzzles\Day10;

use Puzzles\Abstraction\Puzzle as PuzzleAbstract;

/**
 * Puzzle day 10
 * Common class for day 10
 * Advent Of Code 2016
 */
class Puzzle extends PuzzleAbstract
{
    protected $botNumber;
    protected $outputs;

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
        $botsAndValues = [];
        foreach ($this->input as $line) {
            if (preg_match('/value (\d+) goes to bot (\d+)/', $line, $matches)) {
                $chipValue = $matches[1];
                $botNumber = $matches[2];

                if (array_key_exists($botNumber, $botsAndValues)) {
                    if (!in_array($chipValue, $botsAndValues[$botNumber]['values'])) {
                        $botsAndValues[$botNumber]['values'][] = (int)$chipValue;
                        sort($botsAndValues[$botNumber]['values']);
                    }
                } else {
                    # Add this chip to high
                    $botArray = [
                        'values' => [(int)$chipValue],
                        'outputs' => []
                    ];
                    $botsAndValues[$botNumber] = $botArray;
                }
            }
        }

        $botRules = [];
        foreach ($this->input as $line) {
            if (preg_match('/bot (\d+) gives low to (\w+) (\d+) and high to (\w+) (\d+)/', $line, $matches)) {
                $givingBotNumber = $matches[1];

                $receiver1 = $matches[2];
                $receiver1Number = $matches[3];

                $receiver2 = $matches[4];
                $receiver2Number = $matches[5];

                $botRules[$givingBotNumber]['low'] = [
                    $receiver1 => (int)$receiver1Number
                ];
                $botRules[$givingBotNumber]['high'] = [
                    $receiver2 => (int)$receiver2Number
                ];
            }
        }

        while ($this->checkForDoubleValues($botsAndValues) == true) {
            $this->applyBotRules($botRules, $botsAndValues);
        }

        # Part 2
        ksort($this->outputs);
    }

    /**
     * @param $botRules
     * @param $botArray
     */
    private function applyBotRules($botRules, &$botArray)
    {
        # Single pass a bot values array and apply rule for the specific one
        foreach ($botArray as $botNumber => $bot) {
            if (count($bot['values']) == 2) {
                $rules = $botRules[$botNumber];
                $lowRule = $rules['low'];
                $highRule = $rules['high'];

                if ($bot['values'][0] == 17 && $bot['values'][1] == 61) {
                    $this->botNumber = $botNumber;
                }

                if (array_key_exists('bot', $lowRule)) {
                    # Move element to other bot
                    $targetBot = (int)$lowRule['bot'];
                    if (!in_array($botArray[$botNumber]['values'][0], $botArray[$targetBot]['values'])) {
                        $botArray[$targetBot]['values'][] = array_shift($botArray[$botNumber]['values']);
                        sort($botArray[$targetBot]['values']);
                    }
                } elseif (array_key_exists('output', $lowRule)) {
                    # Move to output
                    $targetOutput = (int)$lowRule['output'];
                    $this->outputs[$targetOutput] = array_shift($botArray[$botNumber]['values']);
                }

                if (array_key_exists('bot', $highRule)) {
                    # Move element to other bot
                    $targetBot = (int)$highRule['bot'];
                    if (!in_array($botArray[$botNumber]['values'][1], $botArray[$targetBot]['values'])) {
                        $botArray[$targetBot]['values'][] = array_shift($botArray[$botNumber]['values']);
                        sort($botArray[$targetBot]['values']);
                    }
                } elseif (array_key_exists('output', $highRule)) {
                    # Move to output
                    $targetOutput = (int)$highRule['output'];
                    $this->outputs[$targetOutput] = array_shift($botArray[$botNumber]['values']);
                }
            }
        }
    }

    /**
     * @param $botArray
     * @return bool
     */
    private function checkForDoubleValues($botArray)
    {
        foreach ($botArray as $bot) {
            if (count($bot['values']) == 2) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return null
     */
    public function renderSolution()
    {
        return null;
    }
}
