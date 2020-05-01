<?php


final class EnemyTest extends \PHPUnit\Framework\TestCase
{
    
    protected $hero;
    
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        
        
        $this->enemy = new Enemy(
            70,
            70,
            45,
            45,
            20
        );
    }
    
    public function testCreate() {
        $this->assertInstanceOf(Enemy::class,
            new Enemy(
                70,
                70,
                45,
                45,
                10
            )
        );
    }
    
    public function testAttack()
    {
        $this->assertIsNumeric($this->enemy->attack(45));
    }
    
    public function testDefend()
    {
        $this->assertIsNumeric($this->enemy->defend(30));
    }

   
    
}