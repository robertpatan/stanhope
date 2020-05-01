<?php


class RapidStrike extends Skill
{
    public function __construct($chance, $type)
    {
        parent::__construct($chance, $type);
    }
    
    /**
     * @param Character $character
     * @return Character
     */
    public function apply(Character $character) {
        $enhanced = clone $character;
        $enhanced->setStrength($character->getStrength() *  2);
        
        return $enhanced;
    }
    
}