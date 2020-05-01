<?php


class HeroFactory
{
    /**
     * @return Hero
     * @throws Exception
     */
    public static function create() {
        $skills = [
            SkillFactory::create('RapidStrike', 10, Skill::ATTACK_SKILL),
            SkillFactory::create('MagicShield', 20, Skill::DEFENSE_SKILL),
        ];
        
        $hero = new Hero(
            random_int(70, 100),
            random_int(70, 80),
            random_int(45, 55),
            random_int(40, 50),
            random_int(10, 30)
        );
        
        $hero->setSkill($skills);
        
        return $hero;
    }
}