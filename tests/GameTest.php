<?php

namespace Bowling\Test;

use Bowling\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{

    /**
     * @test
     */
    public function startGame()
    {
        $game = new Game();

        for ($i = 0; $i < Game::MAX_PINS_PER_FRAME; $i++) {
            $game->roll(0);
        }

        $this->assertEquals(0, $game->score());
    }

    /**
     * @test
     */
    public function pinsSum()
    {
        $game = new Game();

        for ($i = 0; $i < Game::MAX_PINS_PER_FRAME; $i++) {
            $game->roll(1);
        }

        $this->assertEquals(20, $game->score());
    }
}