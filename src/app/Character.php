<?php

abstract class Character
{
    protected $health;
    protected $strength;
    protected $defense;
    protected $speed;
    protected $luck;
    
    public function getHealth()
    {
        return $this->health;
    }
    
    public function getStrength()
    {
        return $this->strength;
    }
    
    public function getDefense()
    {
        return $this->defense;
    }
    
    public function getSpeed()
    {
        return $this->speed;
    }
    
    public function getLuck()
    {
        return $this->luck;
    }
    
    public function setStrength($value)
    {
        return $this->strength = $value;
    }
    
    public function setDefense($value)
    {
        return $this->defense = $value;
    }
    
    public function takeDamage($damage)
    {
        $this->health -= $damage;
        
        if ($this->health < 0) {
            $this->health = 0;
        }
        
        return $this->health;
    }
    
    public function isLucky()
    {
        return mt_rand(0, 100) < $this->luck;
    }
    
    abstract public function attack($defenderDefense);
    
    abstract public function defend($attackerStrength);
}