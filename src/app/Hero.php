<?php

class Hero extends Character
{
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
    
    public function attack(Character $enemy)
    {
        $damage = $this->strength - $enemy->getDefense();
        
        return $damage;
    }
    
}