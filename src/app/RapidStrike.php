<?php


class RapidStrike extends Skill
{
    public function __construct($chance, $type)
    {
        parent::__construct($chance, $type);
    }
    
    public function apply(Character $character) {
        Log::getInstance()->info(get_class($this) . ' has been used');
        
        $enhanced = clone $character;
        $enhanced->setStrength($character->getStrength() *  2);
        
        return $enhanced;
    }
    
}