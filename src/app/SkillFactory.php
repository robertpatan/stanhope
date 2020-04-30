<?php


class SkillFactory
{
    public static function create($skillName, $chance, $type) {
        return new $skillName($chance, $type);
    }
}