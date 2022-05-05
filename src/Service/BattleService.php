<?php

namespace App\Service;

use App\Entity\Fighter\Fighter;

class BattleService
{
    const BASIC_ATTACK = "Basic Attack";
    const BASIC_DEFENCE = "Basic Defence";
    const MAX_ROUND = 20;

    /**
     * @param $stats
     * @return array|int[]
     */
    public function getStats($stats): array
    {
        return array_map(function ($stat) {
            return rand($stat['min'], $stat['max']);
            },
        $stats);
    }

    /**
     * @param Fighter $hero
     * @param Fighter $enemy
     */
    public function startFight(Fighter $hero, Fighter $enemy)
    {
        $this->showStats($hero);
        $this->showStats($enemy);

        $first = $this->whoStartsFirst($hero, $enemy);
        $second = $first === $hero ? $enemy : $hero;

        $round = 0;

        while ($round < self::MAX_ROUND) {
            if ($round % 2 == 0) {
                $first->attack($second);
            } else {
                $second->attack($first);
            }
            $round++;
        }

        $this->printDraw();
    }

    /**
     * @param Fighter $hero
     * @param Fighter $enemy
     * @return Fighter
     */
    public function whoStartsFirst(Fighter $hero, Fighter $enemy): Fighter
    {
        if ($hero->getSpeed() > $enemy->getSpeed()) {
            $first = $hero;
        } elseif ($hero->getSpeed() < $enemy->getSpeed()) {
            $first = $enemy;
        } elseif ($hero->getLuck() > $enemy->getLuck()) {
            $first = $hero;
        } else {
            $first = $enemy;
        }

        echo "{$first->getName()} will attack first\n";
        sleep(1);

        return $first;
    }

    /**
     * @param $attacker
     * @param $defender
     * @param string $skillName
     */
    public static function printAttackAttempt($attacker, $defender, $skillName = self::BASIC_ATTACK)
    {
        echo "{$attacker->getName()} is attacking {$defender->getName()} with $skillName\n";
        sleep(1);
    }

    /**
     * @param Fighter $defender
     * @param Fighter $attacker
     */
    public static function printDodgedAttack(Fighter $defender, Fighter $attacker)
    {
        echo "{$defender->getName()} dodged {$attacker->getName()}'s attack.\n";
        sleep(1);
    }

    /**
     * @param Fighter $defender
     * @param Fighter $attacker
     * @param int $damage
     * @param string $skillName
     */
    public static function printDefenderDamage(Fighter $defender, Fighter $attacker, int $damage,
                                               string  $skillName = self::BASIC_DEFENCE)
    {
        echo "{$defender->getName()} got hit for $damage by {$attacker->getName()} while using $skillName.\n";
        echo "Remaining health:  {$defender->getHealth()}\n";
        sleep(1);
    }

    /**
     * @param Fighter $winner
     * @param Fighter $defeated
     */
    public static function printWinner(Fighter $winner, Fighter $defeated)
    {
        echo "{$winner->getName()} won the fight against {$defeated->getName()}!";
        exit(0);
    }

    private function printDraw()
    {
        echo "The fight ended. Draw!\n";
    }

    /**
     * @param Fighter $fighter
     */
    private function showStats(Fighter $fighter)
    {
        echo "{$fighter->getName()} joins the fight with the following stats:\n";
        echo "HEALTH: {$fighter->getHealth()}\n";
        echo "STRENGTH: {$fighter->getStrength()}\n";
        echo "DEFENCE: {$fighter->getDefence()}\n";
        echo "SPEED: {$fighter->getSpeed()}\n";
        echo "LUCK: {$fighter->getLuck()}%\n";
        sleep(3);
    }
}