<?php

namespace App\Service;

use App\Entity\Skills\AttackSkill;
use App\Entity\Skills\DefenceSkill;
use Doctrine\Common\Collections\ArrayCollection;

class SkillService
{
    const CHANCE = 'chance';
    const REDO = 'redo';
    const REDUCE_DAMAGE = 'reduceDamage';

    /**
     * @param ArrayCollection $skills
     * @return false|mixed
     */
    public static function getSkill(ArrayCollection $skills)
    {
        return $skills->first();
    }

    /**
     * @param array $arraySkills
     * @return ArrayCollection
     */
    public function getAttackSkills($arraySkills) : ArrayCollection
    {
        $skills = new ArrayCollection();

        foreach ($arraySkills[FighterService::ATTACK] as $name => $skill) {
            $attackSkill = new AttackSkill($name, $skill[self::CHANCE], $skill[self::REDO]);
            $skills->add($attackSkill);
        }
        return $skills;
    }

    /**
     * @param $arraySkills
     * @return ArrayCollection
     */
    public function getDefenceSkills($arraySkills) : ArrayCollection
    {
        $skills = new ArrayCollection();

        foreach ($arraySkills[FighterService::DEFENCE] as $name => $skill) {
            $defenceSkill = new DefenceSkill($name, $skill[self::CHANCE], $skill[self::REDUCE_DAMAGE]);
            $skills->add($defenceSkill);
        }
        return $skills;
    }
}