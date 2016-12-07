<?php

namespace Puzzles\Abstraction;

/**
 * Class Puzzle
 * @package Abstraction
 */
abstract class Puzzle
{
    /**
     * Name of input file
     * @var string $fileName
     */
    protected static $fileName = 'input';

    /**
     * Storage variable for input
     * @var mixed $input
     */
    protected $input;

    /**
     * Common method for outputting solution
     * @return mixed
     */
    public abstract function renderSolution();

    /**
     * Load input file into class variable
     * Use static variable to define file name
     */
    protected abstract function loadInput();
}
