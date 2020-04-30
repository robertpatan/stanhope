<?php


class GameTest extends \PHPUnit\Framework\TestCase
{
    public function createGame()
    {
        $this->assertInstanceOf(Game::class, new Game());
    }
    
    public function testOneGame()
    {
        $game = new Game();
        $this->assertNull($game->start());
    }
    
}