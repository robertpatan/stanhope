<?php


final class HeroTest extends \PHPUnit\Framework\TestCase
{
    protected $skills;
    protected $hero;
    
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        
        $this->skills = [
            SkillFactory::create('RapidStrike', 10, Skill::ATTACK_SKILL),
            SkillFactory::create('MagicShield', 20, Skill::DEFENSE_SKILL),
        ];
        
        $this->hero = new Hero(
            70,
            70,
            45,
            45,
            10
        );
        
        
    }
    
    public function testCreate()
    {
        $this->assertInstanceOf(Hero::class,
            new Hero(
                70,
                70,
                45,
                45,
                10
            )
        );
    }
    
    public function testSetSkills()
    {
        $this->hero->setSkill($this->skills);
        $this->assertEquals(count( $this->hero->getSkills()), 2);
    }
    
    public function testAttack()
    {
        $this->assertIsNumeric($this->hero->attack(70));
    }
    
    public function testDefend()
    {
        $this->assertIsNumeric($this->hero->defend(70));
    }
}