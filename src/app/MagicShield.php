<?php


class MagicShield  extends Skill
{
    public function __construct($chance, $type)
    {
        parent::__construct($chance, $type);
    }
    
    public function apply(Character $character) {
        
        $enhanced = clone $character;
        $enhanced->setDefense($character->getDefense() *  2);
        
        return $enhanced;
    }
    
}