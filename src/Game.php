<?php

namespace Bowling;

class Game
{

    public const MAX_ROLLS_PER_PLAYER = 21;

    /** @var int $currentRoll */
    private $currentRoll = 0;

    /** @var array $rolls */
    private $rolls = [];

    /**
     * @param int $pins
     */
    public function roll(int $pins)
    {
        if ($this->currentRoll >= self::MAX_ROLLS_PER_PLAYER) {
            return;
        }

        $this->currentRoll++;
        $this->rolls[$this->currentRoll] += $pins;
    }

    /**
     * @return int
     */
    public function calculateScore(): int
    {
        $totalScore = 0;

        foreach ($this->rolls as $rollScore) {
            $totalScore += $rollScore;
        }

        return $totalScore;
    }

    /**
     * @return int
     */
    public function getCurrentRoll(): int
    {
        return $this->currentRoll;
    }
}