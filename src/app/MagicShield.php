<?php


class MagicShield  extends Skill
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
        $enhanced->setDefense($character->getDefense() *  2);
        
        return $enhanced;
    }
    
}