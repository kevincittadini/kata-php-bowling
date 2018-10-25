<?php

namespace Bowling\Test;

use Bowling\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{

    /** @var Game $game */
    private $game;

    public function setUp()
    {
        parent::setUp();

        $this->game = new Game();
    }

    /**
     * @test
     */
    public function startGame()
    {
        $this->rollMany(0, 0);
        $this->assertEquals(0, $this->game->calculateTotalScore());
    }

    /**
     * @test
     */
    public function sumRollPins()
    {
        $this->rollMany(8, 1);
        $this->rollFrame(1, 1);

        $this->assertEquals(10, $this->game->calculateTotalScore());
    }

    /**
     * @test
     */
    public function sumManyRollPins()
    {
        $this->rollMany(3, 2);
        $this->assertEquals(6, $this->game->calculateTotalScore());
    }

    /**
     * @test
     */
    public function cannotRollMoreThanMaxRollsAmount()
    {
        $this->rollMany(25, 0);
        $this->assertEquals(Game::MAX_ROLLS_PER_PLAYER, $this->game->getCurrentRoll());
    }

    /**
     * @test
     */
    public function recognizeASpareFrame()
    {
        $this->rollFrame(3, 2);
        $this->rollSpare();
        $this->rollFrame(4, 4);

        $this->assertTrue($this->game->isSpare(2));
    }

    /**
     * @test
     */
    public function calculateScoreWithSpare()
    {
        $this->rollSpare();
        $this->rollFrame(3, 2);

        $this->assertEquals(18, $this->game->calculateTotalScore());
    }

    /**
     * @test
     */
    public function recognizeAStrike()
    {
        $this->rollFrame(3, 2);
        $this->rollFrame(4, 4);
        $this->rollStrike();

        $this->assertTrue($this->game->isStrike(4));
    }

    /**
     * @test
     */
    public function calculateScoreWithStrike()
    {
        $this->rollFrame(3, 2);
        $this->rollFrame(4, 4);
        $this->rollStrike();
        $this->rollFrame(2, 7);

        $this->assertEquals(41, $this->game->calculateTotalScore());
    }

    /**
     * @test
     */
    public function calculatePerfectGame()
    {
        $this->rollMany(12, Game::MAX_SCORE_PER_FRAME);
        $this->assertEquals(Game::PERFECT_GAME_SCORE, $this->game->calculateTotalScore());
    }

    /**
     * @param int $rolls
     * @param int $pins
     */
    private function rollMany(int $rolls, int $pins)
    {
        for ($i = 0; $i < $rolls; $i++) {
            $this->game->roll($pins);
        }
    }

    /**
     * @param int $firstRoll
     * @param int $secondRoll
     */
    private function rollFrame(int $firstRoll, int $secondRoll)
    {
        $this->game->roll($firstRoll);
        $this->game->roll($secondRoll);

    }

    private function rollSpare()
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

    private function rollStrike()
    {
        $this->game->roll(Game::MAX_SCORE_PER_FRAME);
    }
}