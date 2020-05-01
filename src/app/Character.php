<?php

abstract class Character
{
    protected $health;
    protected $strength;
    protected $defense;
    protected $speed;
    protected $luck;
    
    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }
    
    /**
     * @return mixed
     */
    public function getStrength()
    {
        return $this->strength;
    }
    
    /**
     * @return mixed
     */
    public function getDefense()
    {
        return $this->defense;
    }
    
    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }
    
    /**
     * @return mixed
     */
    public function getLuck()
    {
        return $this->luck;
    }
    
    /**
     * @param $value
     * @return mixed
     */
    public function setStrength($value)
    {
        return $this->strength = $value;
    }
    
    /**
     * @param $value
     * @return mixed
     */
    public function setDefense($value)
    {
        return $this->defense = $value;
    }
    
    /**
     * @param $damage
     * @return int
     */
    public function takeDamage($damage)
    {
        $this->health -= $damage;
        
        if ($this->health < 0) {
            $this->health = 0;
        }
        
        return $this->health;
    }
    
    /**
     * @return bool
     * @throws Exception
     */
    public function isLucky()
    {
        return random_int(0, 100) <= $this->luck;
    }
    
    /**
     * @return string
     */
    public function getStatsString()
    {
        return <<<EOT
    Health: $this->health
    Strength: $this->strength
    Defense: $this->defense
    Speed: $this->speed
    Luck: $this->luck
EOT;
    }
    
    /**
     * @param $defenderDefense
     * @return mixed
     */
    abstract public function attack($defenderDefense);
    
    /**
     * @param $attackerStrength
     * @return mixed
     */
    abstract public function defend($attackerStrength);
}