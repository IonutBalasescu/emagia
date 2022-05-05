<?php

namespace App\Tests\Fighter;

use App\Entity\Fighter\Enemy\Monster\WildBeast;
use App\Entity\Fighter\Hero\Hero;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class FighterTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->hero = new Hero("Hero", 1,2,3,4,100, new ArrayCollection(), new ArrayCollection());
        $this->enemy = new WildBeast("WildBeast", 10, 2, 0, 1, 0);
    }

    public function testConstruct()
    {
        $this->assertInstanceOf(Hero::class, $this->hero);
    }

    public function testHealth()
    {
        $this->hero->setHealth(100);
        $this->assertEquals(100, $this->hero->getHealth());
    }

    public function testGetLuck()
    {
        $this->assertEquals(100, $this->hero->getLuck());
    }

    public function testGetStrength()
    {
        $this->assertEquals(2, $this->hero->getStrength());
    }

    public function testGetSpeed()
    {
        $this->assertEquals(4, $this->hero->getSpeed());

    }

    public function testGetName()
    {
        $this->assertEquals("Hero", $this->hero->getName());

    }

    public function testAttack()
    {
        $health = $this->hero->getHealth();
        $this->enemy->attack($this->hero);
        $this->assertEquals($health, $this->hero->getHealth());

        $this->hero->attack($this->enemy);
        $this->assertEquals(8, $this->enemy->getHealth());
    }

    public function testHasAttackSkills()
    {
        $this->assertFalse($this->hero->hasAttackSkills());
        $this->assertFalse($this->hero->hasDefenceSkills());
    }

    public function testDefend()
    {
        $health = $this->hero->getHealth();
        $this->hero->defend($this->enemy);
        $this->assertEquals($health, $this->hero->getHealth());

        $this->enemy->defend($this->hero);
        $this->assertEquals(8, $this->enemy->getHealth());
    }

    public function testGetDefence()
    {
        $this->assertEquals(3, $this->hero->getDefence());
    }

    public function testDodge()
    {
        $this->assertTrue($this->hero->dodge());
        $this->assertFalse($this->enemy->dodge());
    }
}
