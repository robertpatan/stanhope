<?php

class Enemy extends Character {
    public function __construct(
        $health = 0,
        $strength = 0,
        $defense = 0,
        $speed = 0,
        $luck = 0
    )
    {
        $this->health = $health;
        $this->strength = $strength;
        $this->defense = $defense;
        $this->speed = $speed;
        $this->luck = $luck;
    }
    
    /**
     * @param $defenderDefense
     * @return int|mixed
     */
    public function attack($defenderDefense) {
        $damage = $this->strength - $defenderDefense;
        
        return $damage < 0 ? 0 : $damage;
    }
    
    /**
     * @param $damage
     * @return int|mixed
     * @throws Exception
     */
    public  function defend($damage) {
    
        if ($this->isLucky()) {
            $damage = 0;
            Log::getInstance()->info('Enemy got lucky, Hero missed.');
        } else {
            Log::getInstance()->info('Hero hit with ' . $damage . ' damage');
        }
    
        $this->takeDamage($damage);
        
        return $damage;
    }
}