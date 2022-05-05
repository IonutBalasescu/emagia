<?php

namespace App\Controller;

use App\Entity\Fighter\Fighter;
use App\Service\BattleService;
use App\Service\FighterFactory;
use App\Service\SkillService;

class BattleController
{
    private BattleService $battleService;
    private SkillService $skillService;
    private FighterFactory $fighterFactory;
    public function __construct()
    {
        $this->battleService = new BattleService();
        $this->skillService = new SkillService();
        $this->fighterFactory = new FighterFactory($this->battleService, $this->skillService);
    }

    public function index()
    {
        $hero = $this->getHero();
        $enemy = $this->getEnemy();
        $this->battleService->startFight($hero, $enemy);
    }

    /**
     * @return \App\Entity\Fighter\Enemy\Monster\WildBeast|Fighter|\App\Entity\Fighter\Hero\Hero|null
     */
    public function getHero()
    {
        return $this->fighterFactory->getFighter(Fighter::HERO, 'Orderus');
    }

    /**
     * @return \App\Entity\Fighter\Enemy\Monster\WildBeast|Fighter|\App\Entity\Fighter\Hero\Hero|null
     */
    public function getEnemy()
    {
        return $this->fighterFactory->getFighter(Fighter::WILD_BEAST);
    }
}