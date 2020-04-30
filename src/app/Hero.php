<?php

class Hero extends Character
{
    protected $skills = [];
    
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
    
    public function getSkills()
    {
        return $this->skills;
    }
    
    /**
     * @param $skills
     * @throws Exception
     */
    public function setSkill($skills)
    {
        if (is_array($skills)) {
            $this->skills = $skills;
        } else {
            throw new Exception('Must be an array');
        }
        
    }
    
    public function hasSkills()
    {
        return count($this->skills) > 0;
    }
    
    protected function getAttackSkills()
    {
        return array_filter($this->skills, function ($skill) {
            return $skill->getType() === Skill::ATTACK_SKILL;
        });
    }
    
    protected function getDefenseSkills()
    {
        return array_filter($this->skills, function ($skill) {
            return $skill->getType() === Skill::DEFENSE_SKILL;
        });
    }
    
    
    /**
     * @param $defenderDefense
     * @return int
     */
    public function attack($defenderDefense)
    {
        $hero = $this;
        
        foreach ($this->getAttackSkills() as $skill) {
            if ($skill->hasTriggered()) {
                $hero = $skill->apply($hero);
            }
        }
        
        $damage = $hero->getStrength() - $defenderDefense;
        
        return $damage < 0 ? 0 : $damage;
    }
    
    
    public function defend($attackerStrength)
    {
        $damage = 0;
        $hero = $this;
        
        if (!$this->isLucky()) {
            
            foreach ($this->getDefenseSkills() as $skill) {
                if ($skill->hasTriggered()) {
                    $hero = $skill->apply($hero);
                }
            }
            $damage = $attackerStrength - $hero->getDefense();
            $damage = $damage < 0 ? 0 : $damage;
            
            Log::getInstance()->info('Enemy hit with ' . $damage . ' damage');
            
        } else {
            Log::getInstance()->info('Hero got lucky, enemy missed.');
        }
        
        $this->takeDamage($damage);
        
        return $damage;
    }
    
    
}