<?php

namespace App\Entity\Skills;

class Skill
{
    protected string $name;
    protected int $chance;

    public function __construct(string $name, int $chance)
    {
        $this->chance = $chance;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getChance(): int
    {
        return $this->chance;
    }

    /**
     * @param int $chance
     */
    public function setChance(int $chance)
    {
        $this->chance = $chance;
    }


}