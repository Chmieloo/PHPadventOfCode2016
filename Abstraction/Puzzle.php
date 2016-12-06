<?php

namespace Abstraction;

abstract class Puzzle
{
    protected static $fileName;

    protected abstract function loadInput();
}
