<?php

spl_autoload_register(function ($className) {
    $directories = [
        __DIR__ . '/src/app',
    ];
    
    foreach ($directories as $dir) {
        $file = sprintf('%s/%s.php', $dir, $className);
        
        if (is_file($file)) {
            include $file;
        }
    }
});

$hero = HeroFactory::create();
$dujman = DujmanFactory::create();

// You’ll have to simulate a battle between Stanhope and a wild beast, either at command line or using a web browser.
// On every battle, Stanhope and the beast must be initialized with random properties, within their ranges.

/**
 * The first attack is done by the player with the higher speed. If both players have the same speed,
 * than the attack is carried on by the player with the highest luck. After an attack, the players switch
 * roles: the attacker now defends and the defender now attacks.
 *
 * The damage done by the attacker is calculated with the following formula: Damage = Attacker strength – Defender defense
 *
 * The damage is subtracted from the defender’s health. An attacker can miss their hit and do no damage if the defender gets lucky that turn.
 * Stanhope's skills occur randomly, based on their chances, so take them into account on each turn.
 *
 * Game over
 * The game ends when one of the players remain without health or the number of turns reaches 20.
 * The application must output the results each turn: what happened, which skills were used (if any), the damage done, defender’s health left.
 * If we have a winner before the maximum number of rounds is reached, he must be declared.
 */

echo($hero->getHealth());

