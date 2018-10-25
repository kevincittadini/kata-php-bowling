<?php

namespace Bowling;

class Game
{
    public const MAX_ROLLS = 21;

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
    public function calculateScore()
    {
        return $this->score;
    }
}