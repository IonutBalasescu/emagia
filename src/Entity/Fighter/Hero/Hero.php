<?php

namespace App\Entity\Fighter\Hero;

use App\Entity\Fighter\Fighter;
use App\Service\BattleService;
use App\Service\SkillService;
use Doctrine\Common\Collections\ArrayCollection;

class Hero extends Fighter
{
    private ArrayCollection $attackSkills;
    private ArrayCollection $defenceSkills;

    /**
     * @param string $name
     * @param int $health
     * @param int $strength
     * @param int $defence
     * @param int $speed
     * @param int $luck
     * @param ArrayCollection $attackSkills
     * @param ArrayCollection $defenceSkills
     */
    public function __construct(string $name, int $health, int $strength, int $defence, int $speed, int $luck,
                                ArrayCollection $attackSkills, ArrayCollection $defenceSkills
    ) {
        parent::__construct($name, $health, $strength, $defence, $speed, $luck);
        $this->attackSkills = $attackSkills;
        $this->defenceSkills = $defenceSkills;
    }

    /**
     * @return bool
     */
    function hasAttackSkills(): bool
    {
        return !$this->attackSkills->isEmpty();
    }

    /**
     * @return bool
     */
    function hasDefenceSkills(): bool
    {
        return !$this->defenceSkills->isEmpty();
    }

    /**
     * @param Fighter $fighter
     * @param string|null $attackName
     */
    public function attack(Fighter $fighter, $displayAttack = true)
    {
        if (true === $this->hasAttackSkills()) {

            $skill = SkillService::getSkill($this->attackSkills);
            if (rand(1, 100) <= $skill->getChance()) {
                BattleService::printAttackAttempt($this, $fighter, $skill->getName());
                parent::attack($fighter, false);
                if (true == $skill->getRedo()) {
                    parent::attack($fighter, false);
                }
            } else {
                parent::attack($fighter);
            }
        } else {
            parent::attack($fighter);
        }
    }

    /**
     * @param Fighter $fighter
     */
    public function defend(Fighter $fighter)
    {
        if (true === $this->hasDefenceSkills()) {
            $skill = SkillService::getSkill($this->defenceSkills);
            if (rand(1, 100) <= $skill->getChance()) {
                if (false === $this->dodge()) {
                    $damage = $fighter->getStrength() - $this->defence;
                    $damage *= $skill->getReduceDamage();
                    $this->health -= $damage;
                    BattleService::printDefenderDamage($this, $fighter, $damage, $skill->getName());
                } else {
                    BattleService::printDodgedAttack($this, $fighter);
                }
                $this->checkGameStatus($fighter);
            } else {
                parent::defend($fighter);
            }
        } else {
            parent::defend($fighter);
        }
    }
}