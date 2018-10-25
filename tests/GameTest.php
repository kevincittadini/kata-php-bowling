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
        $this->assertEquals(0, $this->game->calculateScore());
    }

    /**
     * @test
     */
    public function sumRollPins()
    {
        $this->rollMany(8, 1);
        $this->game->roll(1);
        $this->game->roll(1);

        $this->assertEquals(10, $this->game->calculateScore());
    }

    /**
     * @test
     */
    public function sumManyRollPins()
    {
        $this->rollMany(3, 2);
        $this->assertEquals(6, $this->game->calculateScore());
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
        $this->game->roll(3);
        $this->game->roll(2);
        $this->rollSpare();
        $this->game->roll(4);
        $this->game->roll(4);

        $this->assertTrue($this->game->isSpare(2));
    }

    /**
     * @test
     */
    public function calculateScoreWithSpare()
    {
        $this->rollSpare();
        $this->game->roll(3);
        $this->game->roll(2);

        $this->assertEquals(18, $this->game->calculateScore());
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

    private function rollSpare()
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }
}