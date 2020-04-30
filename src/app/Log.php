<?php


class Log
{
    private static $instance = null;
    private static $file;
    
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs';
        self::$file = $dir . DIRECTORY_SEPARATOR . 'battle_' . time() . '.log';
        
        if (!file_exists($dir)) {
            if (!mkdir($dir, 0755, true) && !is_dir($dir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
            }
        }
        
        return static::$instance;
    }
    
    private function __construct()
    {
    }
    
    private function __clone()
    {
    }
    
    private function __wakeup()
    {
    } //prevents serialiazation
    
    /**
     * @param $message
     */
    public static function info($message)
    {
        if(file_exists(self::$file)) {
            $filePointer = fopen(self::$file, 'a');
        } else {
            $filePointer = fopen(self::$file, 'w');
        }
    
        fwrite($filePointer, $message . PHP_EOL);
        fclose($filePointer);
    
    }
    
    
}