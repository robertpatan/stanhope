<?php


class SkillFactory
{
    public static function create($skillName, $chance) {
        return new $skillName($chance);
    }
}