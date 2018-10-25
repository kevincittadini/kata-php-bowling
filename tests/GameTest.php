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
        $this->playFor(0, 0);

        $this->assertEquals(0, $this->game->calculateScore());
    }

    /**
     * @test
     */
    public function pinsSum()
    {
        $this->playFor(3, 2);

        $this->assertEquals(6, $this->game->calculateScore());
    }

    /**
     * @param int $rolls
     * @param int $pins
     */
    public function playFor(int $rolls, int $pins)
    {
        for ($i = 0; $i < $rolls; $i++) {
            $this->game->roll($pins);
        }
    }
}