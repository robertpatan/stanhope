<?php

class DujmanFactory
{
    public static function create() {
        return new Dujman(
            mt_rand(60, 90),
            mt_rand(60, 90),
            mt_rand(40, 60),
            mt_rand(40, 60),
            mt_rand(25, 40)
        );
    }
}