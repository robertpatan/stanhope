<?php


class Game
{
    const MAX_MOVES = 20;
    
    protected $hero;
    protected $enemy;
    protected $currentTurn;
    protected $gameOver = false;
    protected $winner;
    protected $moves = 1;
    
    public function __construct()
    {
        $this->hero = HeroFactory::create();
        $this->enemy = DujmanFactory::create();
    }
    
    public function start()
    {
        $this->setFirstTurn();
        
        while (!$this->gameOver) {
            Log::getInstance()->info('---------- Start round  ' . $this->moves . ' ----------');
            Log::getInstance()->info('Turn: ' . $this->currentTurn);
            
            $this->playTurn();
            
            $this->checkIfGameOver();
            
            Log::getInstance()->info('---------- End round  ' . $this->moves . ' ----------' . PHP_EOL);
            
            $this->moves++;
            
        }
        
        Log::getInstance()->info('GAME OVER' . PHP_EOL);
        
        Log::getInstance()->info('Total moves: ' . $this->moves);
        
        
        
        if ($this->winner) {
            Log::getInstance()->info('Whe winner is: ' . get_class($this->winner));
        } else {
            Log::getInstance()->info('It\'s a tie');
        }
        
        return;
    }
    
    /**
     *
     */
    protected function checkIfGameOver()
    {
        $heroHealth = $this->hero->getHealth();
        $enemyHealth = $this->enemy->getHealth();
        
        if ($this->moves === self::MAX_MOVES) {
            $this->gameOver = true;
            
            if ($heroHealth > $enemyHealth) {
                $this->winner = $this->hero;
            } elseif ($heroHealth < $enemyHealth) {
                $this->winner = $this->enemy;
            } else {
                $this->winner = null;
            }
        } elseif ($heroHealth <= 0) {
            $this->winner = $this->enemy;
            $this->gameOver = true;
        } elseif ($enemyHealth <= 0) {
            $this->winner = $this->hero;
            $this->gameOver = true;
        }
        
        //TODO: treat case?
    }
    
    /**
     * @throws Exception
     */
    protected function playTurn()
    {
        if ($this->currentTurn === get_class($this->hero)) {
            
            $damage = $this->hero->attack($this->enemy->getDefense());
            $this->enemy->defend($damage);
            $this->currentTurn = get_class($this->enemy);
            
            Log::getInstance()->info('Enemy health:' . $this->enemy->getHealth());
            
        } elseif ($this->currentTurn === get_class($this->enemy)) {
            
            $this->hero->defend($this->enemy->getStrength());
            $this->currentTurn = get_class($this->hero);
            
            Log::getInstance()->info('Hero health:' . $this->hero->getHealth());
            
        } else {
            throw new Exception('No one\'s turn? How can this be?');
        }
    }
    
    /**
     * 
     */
    protected function setFirstTurn()
    {
        $heroSpeed = $this->hero->getSpeed();
        $heroLuck = $this->hero->getLuck();
        $enemySpeed = $this->enemy->getSpeed();
        $enemyLuck = $this->enemy->getLuck();
        
        if ($heroSpeed > $enemySpeed) {
            $this->currentTurn = get_class($this->hero);
        } elseif ($heroSpeed < $enemySpeed) {
            $this->currentTurn = get_class($this->enemy);
        } elseif ($heroLuck > $enemyLuck) {
            $this->currentTurn = get_class($this->hero);
        } elseif ($enemyLuck > $heroLuck) {
            $this->currentTurn = get_class($this->enemy);
        } else {//randomize
            if (mt_rand(0, 1) === 0) {
                $this->currentTurn = get_class($this->hero);
            } else {
                $this->currentTurn = get_class($this->enemy);
            }
        }
    }
    
}