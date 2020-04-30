<?php
spl_autoload_register(function ($className) {
    $directories = [
        __DIR__ . '/app',
    ];
    
    foreach ($directories as $dir) {
        $file = sprintf('%s/%s.php', $dir, $className);
        
        if (is_file($file)) {
            include $file;
        }
    }
});