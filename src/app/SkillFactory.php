<?php


class SkillFactory
{
    /**
     * @param $skillName
     * @param $chance
     * @param $type
     * @return mixed
     */
    public static function create($skillName, $chance, $type) {
        return new $skillName($chance, $type);
    }
}