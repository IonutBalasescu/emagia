<?php

namespace App\Service;


use App\Entity\Fighter\Enemy\Monster\WildBeast;
use App\Entity\Fighter\Fighter;
use App\Entity\Fighter\Hero\Hero;
use SimpleXMLElement;

class FighterFactory
{
    private SimpleXMLElement $stats;
    private SimpleXMLElement $skills;
    private BattleService $battleService;
    private SkillService $skillService;

    /**
     * @param BattleService $battleService
     * @param SkillService $skillService
     */
    public function __construct(BattleService $battleService, SkillService $skillService)
    {
        $this->stats = simplexml_load_file("resources/stats.xml") or die("Error: Cannot create object");
        $this->skills = simplexml_load_file("resources/skills.xml") or die("Error: Cannot create object");
        $this->battleService = $battleService;
        $this->skillService = $skillService;
    }
    /**
     * @param string $type
     * @param string|null $name
     * @return Fighter|null
     */
    public function getFighter(string $type, string $name = null)
    {
        switch($type) {
            case Fighter::HERO :
                $stats = $this->battleService->getStats($this->xmlToArray($this->stats->$type->$name));
                $skills = $this->xmlToArray($this->skills->$type->$name);

                return new Hero(
                    $name, $stats[FighterService::HEALTH],
                    $stats[FighterService::STRENGTH], $stats[FighterService::DEFENCE],
                    $stats[FighterService::SPEED], $stats[FighterService::LUCK],
                    $this->skillService->getAttackSkills($skills),
                    $this->skillService->getDefenceSkills($skills)
                );
            case Fighter::WILD_BEAST :
                $stats = $this->battleService
                    ->getStats(json_decode(json_encode($this->stats->enemy->monster->$type), true));

                return new WildBeast(
                    Fighter::WILD_BEAST, $stats[FighterService::HEALTH],
                    $stats[FighterService::STRENGTH], $stats[FighterService::DEFENCE],
                    $stats[FighterService::SPEED], $stats[FighterService::LUCK]
                );
            default:
                return null;
        }
    }

    /**
     * @param SimpleXMLElement $XMLElement
     * @return array
     */
    private function xmlToArray(SimpleXMLElement $XMLElement): array
    {
        return json_decode(json_encode($XMLElement), true);
    }
}