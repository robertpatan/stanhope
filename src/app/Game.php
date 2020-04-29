<?php


class Game
{
    const MAX_MOVES = 20;
    
    protected $hero;
    protected $dujman;
    protected $currentTurn;
    protected $gameOver = false;
    protected $winner;
    protected $moves = 0;
    
    public function __construct()
    {
        $this->hero = HeroFactory::create();
        $this->dujman = HeroFactory::create();
    }
    
    public function start()
    {
        $this->setTurn();
        
        while(!$this->gameOver) {
            if($this->currentTurn === get_class($this->hero)) {
                $this->hero->attack($this->dujman);
            } else if($this->currentTurn === get_class($this->dujman)) {
                $this->dujman->attack($this->hero);
            } else {
                //todo: throw exception
            }
            
            $this->moves++;
        }
        
        return $this->winner;
    }
    
    protected function  checkIfGameIsOver() {
        $heroHealth = $this->hero->getHealth();
        $dujmanHealth = $this->dujman->getHealth();
        
        if($this->moves === self::MAX_MOVES) {
            $this->gameOver = true;
        } else if ($heroHealth <= 0) {
            $this->winner = $this->hero;
        } else if($dujmanHealth <= 0) {
            $this->winner = $this->hero;
            $this->gameOver = true;
        }
        
        //TODO: treat case?
    }
    
    protected function setTurn() {
        $heroSpeed = $this->hero->getSpeed();
        $heroLuck = $this->hero->getLuck();
        $dujmanSpeed = $this->dujman->getSpeed();
        $dujmanLuck = $this->dujman->getLuck();
    
        if ($heroSpeed > $dujmanSpeed) {
            $this->currentTurn = get_class($this->hero);
        } elseif ($heroSpeed < $dujmanSpeed) {
            $this->currentTurn = get_class($this->dujman);
        } else if ($heroLuck > $dujmanLuck) {
            $this->currentTurn = get_class($this->hero);
        } else if ($dujmanLuck > $heroLuck) {
            $this->currentTurn = get_class($this->dujman);
        } else {
            //todo:
        }
    }
    
}