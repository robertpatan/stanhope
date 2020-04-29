<?php

class Character {
    protected $health;
    protected $strength;
    protected $defense;
    protected $speed;
    protected $luck;
    
    public function getHealth() {
        return $this->health;
    }
    
    public function getStrength() {
        return $this->strength;
    }
    
    public function getDefense() {
        return $this->defense;
    }
    
    public function getSpeed() {
        return $this->speed;
    }
    
    public function getLuck() {
        return $this->luck;
    }
    
    public function attack(Character $dujman) {
        $dujman->defend($this->strength);
    }
    
    public  function defend($dujmanStrength) {
        $this->health -=$dujmanStrength;
    }
   

}