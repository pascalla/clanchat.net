<?php

namespace App\Enums;

use Exception;
use ReflectionEnum;

trait LazyEnum
{
    public static function tryFrom($caseName): ?self
    {
        $rc = new ReflectionEnum(self::class);
        return $rc->hasCase($caseName) ? $rc->getConstant($caseName) : null;
    }

    /**
     * @throws Exception
     */
    public static function from($caseName): self
    {
        return self::tryFrom($caseName) ?? throw new Exception('Enum '. $caseName . ' not found in ' . self::class);
    }

}

enum BroadcastType
{
    use LazyEnum;

    case COLLECTION_LOG;
    case DROP;
    case RAID_DROP;
    case LEVEL_UP;
    case QUESTS;
    case PET_DROP;
    case PERSONAL_BEST;
    case PVP;
    case ATTENDANCE;
    case COMBAT_ACHIEVEMENTS;
    case CLUE_DROP;
    case DIARY;

    public function emoji(): string
    {
        return match ($this) {
            BroadcastType::COLLECTION_LOG => '<:Collectionlog:1147701373455048814>',
            BroadcastType::DROP => '<:Guideprices:1147702301298016349>',
            BroadcastType::RAID_DROP => '<:Guideprices:1147702301298016349>',
            BroadcastType::LEVEL_UP => '<:Statsicon:1147702829029543996> ',
            BroadcastType::QUESTS => '<:Quest:1147703095711764550>',
            BroadcastType::PET_DROP => '<:Petshopicon:1147703359227297872>',
            BroadcastType::PERSONAL_BEST => '<:Speedrunningshopicon:1147703649917751357>',
            BroadcastType::PVP => '<:BountyHuntertradericon:1147703810110791802>',
            BroadcastType::ATTENDANCE => '<:AccountManagementCommunityicon:1147704337599041606>',
            BroadcastType::COMBAT_ACHIEVEMENTS => '<:CombatAchievementsicon:1147704502368075786> ',
            BroadcastType::CLUE_DROP => '<:DistractionDiversionmapicon:1147704823500779521>',
            BroadcastType::DIARY => '<:TaskMastericon:1147705076677345322>',
        };
    }
}
