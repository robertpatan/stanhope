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
        $this->dujman = DujmanFactory::create();
    }
    
    public function start()
    {
        $this->setFirstTurn();
    
        Log::getInstance()->info('Turn: ' . $this->currentTurn);
        
        while (!$this->gameOver) {
            $this->setTurn();
    
            Log::getInstance()->info('Turn: ' . $this->currentTurn);
            
            $this->checkIfGameIsOver();
            
            $this->moves++;
        }
    
        Log::getInstance()->info('Whe winner is: ' . get_class($this->winner));
        
        return $this->winner;
    }
    
    protected function checkIfGameIsOver()
    {
        $heroHealth = $this->hero->getHealth();
        $dujmanHealth = $this->dujman->getHealth();
        
        if ($this->moves === self::MAX_MOVES) {
            $this->gameOver = true;
        } elseif ($heroHealth <= 0) {
            $this->winner = $this->hero;
            $this->gameOver = true;
        } elseif ($dujmanHealth <= 0) {
            $this->winner = $this->hero;
            $this->gameOver = true;
        }
        
        //TODO: treat case?
    }
    
    protected function setTurn() {
    
        Log::getInstance()->info('Hero health:' . $this->hero->getHealth());
        Log::getInstance()->info('Dujman health:' . $this->dujman->getHealth());
    
        //hero turn
        if ($this->currentTurn === get_class($this->hero)) {
            Log::getInstance()->info('hero turn');
            $this->hero->attack($this->dujman);
            $this->currentTurn = get_class($this->dujman);
            //dujman turn
        } elseif ($this->currentTurn === get_class($this->dujman)) {
            Log::getInstance()->info('dujman turn');
            $this->dujman->attack($this->hero);
            $this->currentTurn = get_class($this->hero);
        } else {
            Log::getInstance()->info('else turn');
            //todo: throw exception
        }
    }
    
    protected function setFirstTurn()
    {
        $heroSpeed = $this->hero->getSpeed();
        $heroLuck = $this->hero->getLuck();
        $dujmanSpeed = $this->dujman->getSpeed();
        $dujmanLuck = $this->dujman->getLuck();
        
        if ($heroSpeed > $dujmanSpeed) {
            $this->currentTurn = get_class($this->hero);
        } elseif ($heroSpeed < $dujmanSpeed) {
            $this->currentTurn = get_class($this->dujman);
        } elseif ($heroLuck > $dujmanLuck) {
            $this->currentTurn = get_class($this->hero);
        } elseif ($dujmanLuck > $heroLuck) {
            $this->currentTurn = get_class($this->dujman);
        } else {
            //todo:
        }
    }
    
}