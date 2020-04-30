<?php


abstract  class Skill
{
    const ATTACK_SKILL = 'attack';
    const DEFENSE_SKILL = 'defense';
    
    protected $chance;
    protected $type;
    
    public function __construct($chance, $type)
    {
        $this->chance = $chance;
        $this->type = $type;
    }
    
    public function getChance() {
        return $this->chance;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function hasTriggered() {
        return mt_rand(0, 100) < $this->chance;
    }
    
    abstract public function apply(Character $character);
    
    
}