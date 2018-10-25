<?php

namespace Bowling;

class Game
{

    public const MAX_ROLLS_PER_PLAYER = 21;
    public const FRAMES = 10;
    public const MAX_SCORE_PER_FRAME = 10;

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

        $this->rolls[$this->currentRoll] += $pins;
        $this->currentRoll++;
    }

    /**
     * @return int
     */
    public function calculateScore(): int
    {
        $totalScore = 0;
        $rollIndex  = 0;

        for ($frame = 0; $frame < self::FRAMES; $frame++) {
            if ($this->isSpare($rollIndex)) {
                $totalScore += $this->calculateFrameScoreWithSpareBonus($rollIndex);
            } else {
                $totalScore += $this->calculateFrameScore($rollIndex);
            }

            $rollIndex += 2;
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

    /**
     * @param int $rollIndex
     *
     * @return bool
     */
    public function isSpare(int $rollIndex)
    {
        return $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1] === self::MAX_SCORE_PER_FRAME;
    }

    /**
     * @param int $rollIndex
     *
     * @return int
     */
    public function calculateFrameScoreWithSpareBonus(int $rollIndex)
    {
        return self::MAX_SCORE_PER_FRAME + $this->rolls[$rollIndex + 2];
    }

    /**
     * @param int $rollIndex
     *
     * @return mixed
     */
    public function calculateFrameScore(int $rollIndex)
    {
        return $this->rolls[$rollIndex] + $this->rolls[$rollIndex + 1];
    }
}