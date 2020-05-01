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
    
    /**
     * @return mixed
     */
    public function getChance() {
        return $this->chance;
    }
    
    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * @return bool
     */
    public function hasTriggered() {
        return mt_rand(0, 100) <= $this->chance;
    }
    
    /**
     * @param Character $character
     * @return mixed
     */
    abstract public function apply(Character $character);
    
    
}