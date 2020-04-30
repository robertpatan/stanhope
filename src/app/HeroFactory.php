<?php


class HeroFactory
{
    public static function create() {
        $skills = [
            SkillFactory::create('RapidStrike', 10),
            SkillFactory::create('MagicShield', 20),
        ];
        
        $hero = new Hero(
            mt_rand(70, 100),
            mt_rand(70, 80),
            mt_rand(45, 55),
            mt_rand(40, 50),
            mt_rand(10, 30)
        );
        
        $hero->setSkill($skills);
        
        return $hero;
    }
}