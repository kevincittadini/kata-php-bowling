<?php

namespace Bowling;

class Game
{
    public const MAX_PINS_PER_FRAME = 20;

    /** @var int $score */
    private $score;

    /**
     * @param int $pins
     */
    public function roll(int $pins)
    {
        $this->score += $pins;
    }

    /**
     * @return int
     */
    public function score()
    {
        return $this->score;
    }
}