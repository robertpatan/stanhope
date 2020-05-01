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
        $this->enemy = EnemyFactory::create();
    }
    
    /**
     * @throws Exception
     */
    public function start()
    {
        Log::getInstance()->info('Battle begins!' . PHP_EOL);
        
        Log::getInstance()->info('Hero stats:');
        Log::getInstance()->info($this->hero->getStatsString() . PHP_EOL);
        Log::getInstance()->info($this->hero->getSkillsString());
        
        Log::getInstance()->info('Enemy stats:');
        Log::getInstance()->info($this->enemy->getStatsString() . PHP_EOL);
        
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
            Log::getInstance()->info('Whe winner is: ' . get_class($this->winner) . PHP_EOL);
        } else {
            Log::getInstance()->info('It\'s a tie' . PHP_EOL);
        }
        
        Log::getInstance()->info('Hero stats:');
        Log::getInstance()->info($this->hero->getStatsString() . PHP_EOL);
        
        Log::getInstance()->info('Enemy stats:');
        Log::getInstance()->info($this->enemy->getStatsString() . PHP_EOL);
        
        
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
     * @throws Exception
     */
    protected function setFirstTurn()
    {
        $heroSpeed = $this->hero->getSpeed();
        $heroLuck = $this->hero->getLuck();
        $enemySpeed = $this->enemy->getSpeed();
        $enemyLuck = $this->enemy->getLuck();
        
        $heroClass = get_class($this->hero);
        $enemyClass = get_class($this->enemy);
        
        if ($heroSpeed > $enemySpeed) {
            $this->currentTurn = $heroClass;
        } elseif ($heroSpeed < $enemySpeed) {
            $this->currentTurn = $enemyClass;
        } elseif ($heroLuck > $enemyLuck) {
            $this->currentTurn = $heroClass;
        } elseif ($enemyLuck > $heroLuck) {
            $this->currentTurn = $enemyClass;
        } else {//randomize
            if (random_int(0, 1) === 0) {
                $this->currentTurn = $heroClass;
            } else {
                $this->currentTurn = $enemyClass;
            }
        }
    }
    
}