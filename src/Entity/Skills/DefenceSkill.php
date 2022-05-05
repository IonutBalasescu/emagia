<?php

namespace App\Entity\Skills;

class DefenceSkill extends Skill
{
    protected float $reduceDamage;

    public function __construct(string $name, int $chance, float $reduceDamage)
    {
        parent::__construct($name, $chance);
        $this->reduceDamage = $reduceDamage;
    }

    /**
     * @return float
     */
    public function getReduceDamage(): float
    {
        return $this->reduceDamage;
    }

    /**
     * @param float $reduceDamage
     */
    public function setReduceDamage(float $reduceDamage)
    {
        $this->reduceDamage = $reduceDamage;
    }
}