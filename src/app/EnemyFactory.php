<?php

class EnemyFactory
{
    /**
     * @return Enemy
     * @throws Exception
     */
    public static function create() {
        return new Enemy(
            random_int(60, 90),
            random_int(60, 90),
            random_int(40, 60),
            random_int(40, 60),
            random_int(25, 40)
        );
    }
}