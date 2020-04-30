<?php


final class LogTest extends \PHPUnit\Framework\TestCase
{
    public function testSingleton()
    {
        $log = Log::getInstance();
        $log2 = Log::getInstance();
        
        $this->assertEquals($log, $log2);
    }
    
}