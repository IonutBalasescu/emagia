<?php

namespace App\Entity\Skills;

class AttackSkill extends Skill
{
    protected int $redo;

    public function __construct(string $name, int $chance, int $redo)
    {
        parent::__construct($name, $chance);
        $this->redo = $redo;
    }

    /**
     * @return int
     */
    public function getRedo(): int
    {
        return $this->redo;
    }

    /**
     * @param int $redo
     */
    public function setRedo(int $redo)
    {
        $this->redo = $redo;
    }
}