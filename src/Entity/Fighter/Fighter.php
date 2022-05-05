<?php

namespace App\Entity\Fighter;

use App\Service\BattleService;

abstract class Fighter
{
    const HERO = 'hero';
    const WILD_BEAST = 'WildBeast';

    protected string $name;
    protected int $health;
    protected int $strength;
    protected int $defence;
    protected int $speed;
    protected int $luck;

    /**
     * @param string $name
     * @param int $health
     * @param int $strength
     * @param int $defence
     * @param int $speed
     * @param int $luck
     */
    public function __construct(string $name, int $health, int $strength, int $defence, int $speed, int $luck)
    {
        $this->name = $name;
        $this->health = $health;
        $this->strength = $strength;
        $this->defence = $defence;
        $this->speed = $speed;
        $this->luck = $luck;
    }

    /**
     * @param Fighter $fighter
     * @param bool $displayAttack
     */
    public function attack(Fighter $fighter, bool $displayAttack = true)
    {
        if ($displayAttack) {
            BattleService::printAttackAttempt($this, $fighter, BattleService::BASIC_ATTACK);
        }
        $fighter->defend($this);
    }

    /**
     * @param Fighter $fighter
     */
    public function defend(Fighter $fighter)
    {
        if (false === $this->dodge()) {
            $damage = $fighter->getStrength() - $this->defence;
            $this->health -= $damage;
            BattleService::printDefenderDamage($this, $fighter, $damage);
        } else {
            BattleService::printDodgedAttack($this, $fighter);
        }
        $this->checkGameStatus($fighter);
    }

    protected function checkGameStatus(Fighter $fighter)
    {
        if ($this->health <= 0) {
            BattleService::printWinner($fighter, $this);
        }
    }


    /**
     * @return bool
     */
    public function dodge(): bool
    {
        if (rand(1, 100) <= $this->luck) {
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth(int $health)
    {
        $this->health = $health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence() : int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

}