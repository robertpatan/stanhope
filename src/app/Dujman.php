<?php

class Dujman extends Character {
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
    
    public function attack($defenderDefense) {
        return $defenderDefense - $this->strength;
    }
    
    public  function defend($damage) {
    
        if ($this->isLucky()) {
            $damage = 0;
            Log::getInstance()->info('Dujman got lucky, Hero missed.');
        } else {
            Log::getInstance()->info('Hero hit with ' . $damage . ' damage');
        }
    
        $this->takeDamage($damage);
        
        return $damage;
    }
}