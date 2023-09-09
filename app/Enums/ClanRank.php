<?php

namespace App\Enums;

use Exception;
use ReflectionEnum;

trait LazyEnumRank
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

enum ClanRank
{
    use LazyEnumRank;

    case Achiever;
    case Adamant;
    case Adept;
    case Administrator;
    case Admiral;
    case Adventurer;
    case Air;
    case Anchor;
    case Apothecary;
    case Archer;
    case Armadylean;
    case Artillery;
    case Artisan;
    case Asgarnian;
    case Assassin;
    case Assistant;
    case Astral;
    case Athlete;
    case Attacker;
    case Bandit;
    case Bandosian;
    case Barbarian;
    case Battlemage;
    case Beast;
    case Berserker;
    case Blisterwood;
    case Blood;
    case Blue;
    case Bob;
    case Body;
    case Brassican;
    case Brawler;
    case Brigadier;
    case Brigand;
    case Bronze;
    case Bruiser;
    case Bulwark;
    case Burglar;
    case Burnt;
    case Cadet;
    case Captain;
    case Carry;
    case Champion;
    case Chaos;
    case Cleric;
    case Collector;
    case Colonel;
    case Commander;
    case Competitor;
    case Completionist;
    case Constructor;
    case Cook;
    case Coordinator;
    case Corporal;
    case Cosmic;
    case Councillor;
    case Crafter;
    case Crew;
    case Crusader;
    case Cutpurse;
    case Death;
    case Defender;
    case Defiler;
    case Deputy_owner;
    case Destroyer;
    case Diamond;
    case Diseased;
    case Doctor;
    case Dogsbody;
    case Dragon;
    case Dragonstone;
    case Druid;
    case Duellist;
    case Earth;
    case Elite;
    case Emerald;
    case Enforcer;
    case Epic;
    case Executive;
    case Expert;
    case Explorer;
    case Farmer;
    case Feeder;
    case Fighter;
    case Fire;
    case Firemaker;
    case Firestarter;
    case Fisher;
    case Fletcher;
    case Forager;
    case Fremennik;
    case Gamer;
    case Gatherer;
    case General;
    case Gnome_Child;
    case Gnome_Elder;
    case Goblin;
    case Gold;
    case Goon;
    case Green;
    case Grey;
    case Guardian;
    case Guest;
    case Guthixian;
    case Harpoon;
    case Healer;
    case Hellcat;
    case Helper;
    case Herbologist;
    case Hero;
    case Hoarder;
    case Holy;
    case Hunter;
    case Ignitor;
    case Illusionist;
    case Imp;
    case Infantry;
    case Inquisitor;
    case Iron;
    case Jade;
    case Jmod;
    case Justiciar;
    case Kandarin;
    case Karamjan;
    case Kharidian;
    case Kitten;
    case Knight;
    case Labourer;
    case Law;
    case Leader;
    case Learner;
    case Legacy;
    case Legend;
    case Legionnaire;
    case Lieutenant;
    case Looter;
    case Lumberjack;
    case Magic;
    case Magician;
    case Major;
    case Maple;
    case Marshal;
    case Master;
    case Maxed;
    case Mediator;
    case Medic;
    case Mentor;
    case Merchant;
    case Mind;
    case Miner;
    case Minion;
    case Misthalinian;
    case Mithril;
    case Moderator;
    case Monarch;
    case Morytanian;
    case Mystic;
    case Myth;
    case Natural;
    case Nature;
    case Necromancer;
    case Ninja;
    case Noble;
    case Novice;
    case Nurse;
    case Oak;
    case Officer;
    case Onyx;
    case Opal;
    case Oracle;
    case Orange;
    case Owner;
    case Page;
    case Paladin;
    case Pawn;
    case Pilgrim;
    case Pine;
    case Pink;
    case Prefect;
    case Priest;
    case Private;
    case Prodigy;
    case Proselyte;
    case Prospector;
    case Protector;
    case Pure;
    case Purple;
    case Pyromancer;
    case Quester;
    case Racer;
    case Raider;
    case Ranger;
    case Record_chaser;
    case Recruit;
    case Recruiter;
    case Red_Topaz;
    case Red;
    case Rogue;
    case Ruby;
    case Rune;
    case Runecrafter;
    case Sage;
    case Sapphire;
    case Saradominist;
    case Saviour;
    case Scavenger;
    case Scholar;
    case Scourge;
    case Scout;
    case Scribe;
    case Seer;
    case Senator;
    case Sentry;
    case Serenist;
    case Sergeant;
    case Shaman;
    case Sheriff;
    case Short_Green_Guy;
    case Skiller;
    case Skulled;
    case Slayer;
    case Smiter;
    case Smith;
    case Smuggler;
    case Sniper;
    case Soul;
    case Specialist;
    case Speed_Runner;
    case Spellcaster;
    case Squire;
    case Staff;
    case Steel;
    case Strider;
    case Striker;
    case Summoner;
    case Superior;
    case Supervisor;
    case Teacher;
    case Templar;
    case Therapist;
    case Thief;
    case Tirannian;
    case Trialist;
    case Trickster;
    case TzKal;
    case TzTok;
    case Unholy;
    case Vagrant;
    case Vanguard;
    case Walker;
    case Wanderer;
    case Warden;
    case Warlock;
    case Warrior;
    case Water;
    case Wild;
    case Willow;
    case Wily;
    case Wintumber;
    case Witch;
    case Wizard;
    case Worker;
    case Wrath;
    case Xerician;
    case Yellow;
    case Yew;
    case Zamorakian;
    case Zarosian;
    case Zealot;
    case Zenyte;

    public function emoji(): string
    {
        return match($this)
        {
            ClanRank::Achiever => '<:Achiever:1144312039053987930>',
            ClanRank::Adept => '<:Adept:1144312040496836730>',
            ClanRank::Adamant => '<:Adamant:1144312041901928528>',
            ClanRank::Administrator => '<:Administrator:1144312043579646043>',
            ClanRank::Adventurer => '<:Adventurer:1144312045139935295>',
            ClanRank::Admiral => '<:Admiral:1144312046721183956>',
            ClanRank::Air => '<:Air:1144312048663142452>',
            ClanRank::Anchor => '<:Anchor:1144312049799802952>',
            ClanRank::Apothecary => '<:Apothecary:1144312050898718843>',
            ClanRank::Archer => '<:Archer:1144312052303790151>',
            ClanRank::Armadylean => '<:Armadylean:1144312053427875910>',
            ClanRank::Artillery => '<:Artillery:1144312055025893509>',
            ClanRank::Artisan => '<:Artisan:1144312056544243792>',
            ClanRank::Asgarnian => '<:Asgarnian:1144312058414911498>',
            ClanRank::Assistant => '<:Assistant:1144312059970977802>',
            ClanRank::Assassin => '<:Assassin:1144312061459955914>',
            ClanRank::Athlete => '<:Athlete:1144312062823108699>',
            ClanRank::Attacker => '<:Attacker:1144312063938805831>',
            ClanRank::Bandit => '<:Bandit:1144312065096433754>',
            ClanRank::Bandosian => '<:Bandosian:1144312067650748436>',
            ClanRank::Barbarian => '<:Barbarian:1144312069328478279>',
            ClanRank::Berserker => '<:Berserker:1144312070758736032>',
            ClanRank::Beast => '<:Beast:1144312071870222346>',
            ClanRank::Battlemage => '<:Battlemage:1144312072742654003>',
            ClanRank::Blisterwood => '<:Blisterwood:1144312073866706975>',
            ClanRank::Astral => '<:Astral:1144312075431182417>',
            ClanRank::Body => '<:Body:1144312076957921290>',
            ClanRank::Bob => '<:Bob:1144312079273177128>',
            ClanRank::Blue => '<:Blue:1144312080565030943>',
            ClanRank::Brawler => '<:Brawler:1144312082364375142>',
            ClanRank::Brassican => '<:Brassican:1144312083891110008>',
            ClanRank::Brigadier => '<:Brigadier:1144312085422022756>',
            ClanRank::Brigand => '<:Brigand:1144312086634176633>',
            ClanRank::Blood => '<:Blood:1144312088311894087>',
            ClanRank::Bronze => '<:Bronze:1144312089582772315>',
            ClanRank::Bruiser => '<:Bruiser:1144312090769756270>',
            ClanRank::Burnt => '<:Burnt:1144312091948363876>',
            ClanRank::Cadet => '<:Cadet:1144312093273772062>',
            ClanRank::Captain => '<:Captain:1144312094422994944>',
            ClanRank::Burglar => '<:Burglar:1144312095719047199>',
            ClanRank::Carry => '<:Carry:1144312100878024754>',
            ClanRank::Champion => '<:Champion:1144312102085988443>',
            ClanRank::Chaos => '<:Chaos:1144312103222644767>',
            ClanRank::Collector => '<:Collector:1144312104267042886>',
            ClanRank::Colonel => '<:Colonel:1144312105592434839>',
            ClanRank::Cleric => '<:Cleric:1144312107014303804>',
            ClanRank::Bulwark => '<:Bulwark:1144312108687827004>',
            ClanRank::Commander => '<:Commander:1144312110000656425>',
            ClanRank::Competitor => '<:Competitor:1144312111435108395>',
            ClanRank::Completionist => '<:Completionist:1144312112840200233>',
            ClanRank::Cook => '<:Cook:1144313578380329121>',
            ClanRank::Constructor => '<:Constructor:1144313579680571496>',
            ClanRank::Coordinator => '<:Coordinator:1144313580926283877>',
            ClanRank::Corporal => '<:Corporal:1144313582289436772>',
            ClanRank::Councillor => '<:Councillor:1144313583992316004>',
            ClanRank::Crew => '<:Crew:1144313585179304057>',
            ClanRank::Crafter => '<:Crafter:1144313586408226826>',
            ClanRank::Cosmic => '<:Cosmic:1144313587981099099>',
            ClanRank::Crusader => '<:Crusader:1144313589486850068>',
            ClanRank::Cutpurse => '<:Cutpurse:1144313590812258347>',
            ClanRank::Death => '<:Death:1144313592284446731>',
            ClanRank::Defender => '<:Defender:1144313593635012680>',
            ClanRank::Defiler => '<:Defiler:1144313594863956160>',
            ClanRank::Deputy_owner => '<:Deputy_owner:1144313595925110857>',
            ClanRank::Destroyer => '<:Destroyer:1144313597481193514>',
            ClanRank::Diamond => '<:Diamond:1144313598747877417>',
            ClanRank::Diseased => '<:Diseased:1144313599968428283>',
            ClanRank::Doctor => '<:Doctor:1144313601289617538>',
            ClanRank::Dogsbody => '<:Dogsbody:1144313602858295306>',
            ClanRank::Dragon => '<:Dragon:1144313604770910218>',
            ClanRank::Dragonstone => '<:Dragonstone:1144313606578647131>',
            ClanRank::Druid => '<:Druid:1144313607878873148>',
            ClanRank::Duellist => '<:Duellist:1144313609044893709>',
            ClanRank::Earth => '<:Earth:1144313611230130236>',
            ClanRank::Elite => '<:Elite:1144313613285347398>',
            ClanRank::Expert => '<:Expert:1144313614073868361>',
            ClanRank::Epic => '<:Epic:1144313615730626661>',
            ClanRank::Enforcer => '<:Enforcer:1144313618515628144>',
            ClanRank::Feeder => '<:Feeder:1144313620411457627>',
            ClanRank::Fighter => '<:Fighter:1144313622307291146>',
            ClanRank::Fire => '<:Fire:1144313623402008647>',
            ClanRank::Farmer => '<:Farmer:1144313624559620257>',
            ClanRank::Firemaker => '<:Firemaker:1144313626098929725>',
            ClanRank::Firestarter => '<:Firestarter:1144313628183506964>',
            ClanRank::Explorer => '<:Explorer:1144313629697646632>',
            ClanRank::Fisher => '<:Fisher:1144313630800756871>',
            ClanRank::Fremennik => '<:Fremennik:1144313632851767387>',
            ClanRank::Gamer => '<:Gamer:1144313633749356586>',
            ClanRank::Forager => '<:Forager:1144313635456434256>',
            ClanRank::Fletcher => '<:Fletcher:1144313636580491354>',
            ClanRank::Gatherer => '<:Gatherer:1144313638165954662>',
            ClanRank::Executive => '<:Executive:1144313639298408549>',
            ClanRank::Emerald => '<:Emerald:1144313640481206424>',
            ClanRank::Gnome_Child => '<:Gnome_Child:1144313642209255544>',
            ClanRank::General => '<:General:1144313643626926123>',
            ClanRank::Gnome_Elder => '<:Gnome_Elder:1144313645086543872>',
            ClanRank::Goblin => '<:Goblin:1144313646437113947>',
            ClanRank::Goon => '<:Goon:1144313647691206830>',
            ClanRank::Gold => '<:Gold:1144313649436037230>',
            ClanRank::Green => '<:Green:1144313650874683464>',
            ClanRank::Guardian => '<:Guardian:1144314003041046609>',
            ClanRank::Guthixian => '<:Guthixian:1144314005268205688>',
            ClanRank::Grey => '<:Grey:1144314006467780638>',
            ClanRank::Guest => '<:Guest:1144314007612817538>',
            ClanRank::Harpoon => '<:Harpoon:1144314008783032470>',
            ClanRank::Healer => '<:Healer:1144314009831616612>',
            ClanRank::Helper => '<:Helper:1144314011207352360>',
            ClanRank::Hellcat => '<:Hellcat:1144314012981538866>',
            ClanRank::Herbologist => '<:Herbologist:1144314014323724370>',
            ClanRank::Hero => '<:Hero:1144314015464566784>',
            ClanRank::Hoarder => '<:Hoarder:1144314017012252692>',
            ClanRank::Ignitor => '<:Ignitor:1144314018333474836>',
            ClanRank::Hunter => '<:Hunter:1144314019449151540>',
            ClanRank::Holy => '<:Holy:1144314021126881400>',
            ClanRank::Illusionist => '<:Illusionist:1144314022183845942>',
            ClanRank::Iron => '<:Iron:1144314023400198144>',
            ClanRank::Inquisitor => '<:Inquisitor:1144314024536842364>',
            ClanRank::Imp => '<:Imp:1144314025753190450>',
            ClanRank::Jade => '<:Jade:1144314027137319012>',
            ClanRank::Jmod => '<:Jmod:1144314028722757763>',
            ClanRank::Infantry => '<:Infantry:1144314029813276744>',
            ClanRank::Kharidian => '<:Kharidian:1144314031562305586>',
            ClanRank::Justiciar => '<:Justiciar:1144314032661221526>',
            ClanRank::Kandarin => '<:Kandarin:1144314033772691646>',
            ClanRank::Karamjan => '<:Karamjan:1144314034942906489>',
            ClanRank::Kitten => '<:Kitten:1144314036499005522>',
            ClanRank::Knight => '<:Knight:1144314037845368852>',
            ClanRank::Law => '<:Law:1144314039325954159>',
            ClanRank::Labourer => '<:Labourer:1144314040852680804>',
            ClanRank::Leader => '<:Leader:1144314042798837840>',
            ClanRank::Learner => '<:Learner:1144314044589801532>',
            ClanRank::Legacy => '<:Legacy:1144314045961338942>',
            ClanRank::Legend => '<:Legend:1144314047513243820>',
            ClanRank::Legionnaire => '<:Legionnaire:1144314048909938791>',
            ClanRank::Looter => '<:Looter:1144314051195834469>',
            ClanRank::Lumberjack => '<:Lumberjack:1144314052986810448>',
            ClanRank::Magician => '<:Magician:1144314054601625732>',
            ClanRank::Magic => '<:Magic:1144314056069619824>',
            ClanRank::Master => '<:Master:1144314057617309737>',
            ClanRank::Marshal => '<:Marshal:1144314059005636658>',
            ClanRank::Maple => '<:Maple:1144314060842737805>',
            ClanRank::Lieutenant => '<:Lieutenant:1144314062512082944>',
            ClanRank::Mentor => '<:Mentor:1144314063602601995>',
            ClanRank::Medic => '<:Medic:1144314064827318412>',
            ClanRank::Maxed => '<:Maxed:1144314066127568967>',
            ClanRank::Mediator => '<:Mediator:1144314068623167629>',
            ClanRank::Merchant => '<:Merchant:1144314069994721411>',
            ClanRank::Major => '<:Major:1144314071366258749>',
            ClanRank::Minion => '<:Minion:1144314072603570258>',
            ClanRank::Mind => '<:Mind:1144314074109313114>',
            ClanRank::Miner => '<:Miner:1144318197319868486>',
            ClanRank::Misthalinian => '<:Misthalinian:1144315520229855263>',
            ClanRank::Mithril => '<:Mithril:1144315521534283847>',
            ClanRank::Moderator => '<:Moderator:1144315522360557590>',
            ClanRank::Monarch => '<:Monarch:1144315523799187546>',
            ClanRank::Natural => '<:Natural:1144315525153959937>',
            ClanRank::Nature => '<:Nature:1144315526861033582>',
            ClanRank::Morytanian => '<:Morytanian:1144315528400347197>',
            ClanRank::Mystic => '<:Mystic:1144315529478295572>',
            ClanRank::Myth => '<:Myth:1144315530694623242>',
            ClanRank::Noble => '<:Noble:1144315531952930948>',
            ClanRank::Necromancer => '<:Necromancer:1144315533550944357>',
            ClanRank::Ninja => '<:Ninja:1144315534989590549>',
            ClanRank::Novice => '<:Novice:1144315536449224914>',
            ClanRank::Nurse => '<:Nurse:1144315537686548551>',
            ClanRank::Oak => '<:Oak:1144315539049693234>',
            ClanRank::Onyx => '<:Onyx:1144315540488339566>',
            ClanRank::Officer => '<:Officer:1144315541704671242>',
            ClanRank::Oracle => '<:Oracle:1144315543340449934>',
            ClanRank::Orange => '<:Orange:1144315545504727214>',
            ClanRank::Paladin => '<:Paladin:1144315546708496515>',
            ClanRank::Owner => '<:Owner:1144315547866116096>',
            ClanRank::Page => '<:Page:1144315549552234578>',
            ClanRank::Pawn => '<:Pawn:1144315551431270500>',
            ClanRank::Pink => '<:Pink:1144315552676982978>',
            ClanRank::Pine => '<:Pine:1144315553813647451>',
            ClanRank::Pilgrim => '<:Pilgrim:1144315555185164369>',
            ClanRank::Priest => '<:Priest:1144315556678357093>',
            ClanRank::Prefect => '<:Prefect:1144315557852749844>',
            ClanRank::Opal => '<:Opal:1144315559186538516>',
            ClanRank::Prodigy => '<:Prodigy:1144315560377712690>',
            ClanRank::Proselyte => '<:Proselyte:1144315561824759959>',
            ClanRank::Private => '<:Private:1144315563208880303>',
            ClanRank::Prospector => '<:Prospector:1144315564756566038>',
            ClanRank::Pure => '<:Pure:1144315566270730311>',
            ClanRank::Racer => '<:Racer:1144315567638053034>',
            ClanRank::Protector => '<:Protector:1144315568925704293>',
            ClanRank::Purple => '<:Purple:1144315570049785968>',
            ClanRank::Quester => '<:Quester:1144315571245170869>',
            ClanRank::Raider => '<:Raider:1144315572876746782>',
            ClanRank::Ranger => '<:Ranger:1144315573908553821>',
            ClanRank::Record_chaser => '<:Record_chaser:1144315575498178721>',
            ClanRank::Recruit => '<:Recruit:1144315577154932936>',
            ClanRank::Recruiter => '<:Recruiter:1144315578430005359>',
            ClanRank::Red => '<:Red:1144315579637977118>',
            ClanRank::Red_Topaz => '<:Red_Topaz:1144315580850110637>',
            ClanRank::Rogue => '<:Rogue:1144315581877723259>',
            ClanRank::Ruby => '<:Ruby:1144315582989205605>',
            ClanRank::Rune => '<:Rune:1144315583740006523>',
            ClanRank::Pyromancer => '<:Pyromancer:1144315585367380070>',
            ClanRank::Runecrafter => '<:Runecrafter:1144315586554376232>',
            ClanRank::Sage => '<:Sage:1144318509082480680>',
            ClanRank::Sapphire => '<:Sapphire:1144317075280646216>',
            ClanRank::Saradominist => '<:Saradominist:1144317076778012702>',
            ClanRank::Saviour => '<:Saviour:1144317078296330331>',
            ClanRank::Scribe => '<:Scribe:1144317079621738587>',
            ClanRank::Scavenger => '<:Scavenger:1144317080842285116>',
            ClanRank::Scholar => '<:Scholar:1144317082092183552>',
            ClanRank::Scourge => '<:Scourge:1144317083602145470>',
            ClanRank::Seer => '<:Seer:1144317085275652186>',
            ClanRank::Senator => '<:Senator:1144317087112765530>',
            ClanRank::Scout => '<:Scout:1144317088727572582>',
            ClanRank::Sentry => '<:Sentry:1144317090136871062>',
            ClanRank::Serenist => '<:Serenist:1144317091378380891>',
            ClanRank::Sergeant => '<:Sergeant:1144317092171108375>',
            ClanRank::Shaman => '<:Shaman:1144317093790093383>',
            ClanRank::Sheriff => '<:Sheriff:1144317095060967495>',
            ClanRank::Short_Green_Guy => '<:Short_Green_Guy:1144317096185036870>',
            ClanRank::Skulled => '<:Skulled:1144317097279750245>',
            ClanRank::Slayer => '<:Slayer:1144317098508693606>',
            ClanRank::Smiter => '<:Smiter:1144317099343360144>',
            ClanRank::Sniper => '<:Sniper:1144317101562150952>',
            ClanRank::Smith => '<:Smith:1144317103193739304>',
            ClanRank::Soul => '<:Soul:1144317104506552471>',
            ClanRank::Specialist => '<:Specialist:1144317105567711232>',
            ClanRank::Speed_Runner => '<:Speed_Runner:1144317107782295622>',
            ClanRank::Spellcaster => '<:Spellcaster:1144317109166419969>',
            ClanRank::Skiller => '<:Skiller:1144317110294687936>',
            ClanRank::Smuggler => '<:Smuggler:1144317111473295360>',
            ClanRank::Squire => '<:Squire:1144317112731582544>',
            ClanRank::Staff => '<:Staff:1144317114002440192>',
            ClanRank::Steel => '<:Steel:1144317115076182158>',
            ClanRank::Striker => '<:Striker:1144317116862959616>',
            ClanRank::Strider => '<:Strider:1144317118167404665>',
            ClanRank::Teacher => '<:Teacher:1144317119773810860>',
            ClanRank::Summoner => '<:Summoner:1144317121455718420>',
            ClanRank::Tirannian => '<:Tirannian:1144317122877591562>',
            ClanRank::Therapist => '<:Therapist:1144317124723097801>',
            ClanRank::Superior => '<:Superior:1144317126040100885>',
            ClanRank::Thief => '<:Thief:1144317128770584727>',
            ClanRank::TzKal => '<:TzKal:1144317130360246292>',
            ClanRank::TzTok => '<:TzTok:1144317131924709496>',
            ClanRank::Unholy => '<:Unholy:1144317133300453496>',
            ClanRank::Trickster => '<:Trickster:1144317134533566605>',
            ClanRank::Vanguard => '<:Vanguard:1144317136177725511>',
            ClanRank::Templar => '<:Templar:1144317137259860008>',
            ClanRank::Vagrant => '<:Vagrant:1144317138794979459>',
            ClanRank::Supervisor => '<:Supervisor:1144317139965194340>',
            ClanRank::Trialist => '<:Trialist:1144317141550649495>',
            ClanRank::Walker => '<:Walker:1144317142452412569>',
            ClanRank::Warden => '<:Warden:1144317144071413850>',
            ClanRank::Wanderer => '<:Wanderer:1144317145589755944>',
            ClanRank::Wild => '<:Wild:1144317478567157883>',
            ClanRank::Water => '<:Water:1144317480110661672>',
            ClanRank::Warlock => '<:Warlock:1144317481205366844>',
            ClanRank::Warrior => '<:Warrior:1144317483248009257>',
            ClanRank::Wily => '<:Wily:1144317485508722721>',
            ClanRank::Witch => '<:Witch:1144317487480054013>',
            ClanRank::Wintumber => '<:Wintumber:1144317488893542581>',
            ClanRank::Willow => '<:Willow:1144317490290245803>',
            ClanRank::Wizard => '<:Wizard:1144317491787608206>',
            ClanRank::Worker => '<:Worker:1144317493205286932>',
            ClanRank::Wrath => '<:Wrath:1144317494903967754>',
            ClanRank::Xerician => '<:Xerician:1144317496367783956>',
            ClanRank::Yellow => '<:Yellow:1144317497907089569>',
            ClanRank::Yew => '<:Yew:1144317499161198635>',
            ClanRank::Zamorakian => '<:Zamorakian:1144317500910215178>',
            ClanRank::Zealot => '<:Zealot:1144317502470488114>',
            ClanRank::Zenyte => '<:Zenyte:1144317503883976876>',
            ClanRank::Zarosian => '<:Zarosian:1144317506039853129>'
        };
    }
}
?>
