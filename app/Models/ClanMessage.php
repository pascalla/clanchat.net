<?php

namespace App\Models;

use App\Enums\BroadcastType;
use App\Enums\ClanRank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanMessage extends Model
{
    use HasFactory;

    public function generateHash() {
        $hashString = $this->clanId . ($this->username ??  '') . $this->content . substr($this->timestamp, 0, -4);
        return base64_encode($hashString);
    }

    public function generateDiscordMessage($settings) {

        $message = "";

        $message = $this->prefixClanRank($settings["clan_icons"], $message);
        $message = $this->prefixAccountType($settings["icons"], $message);
        $message = $this->prefixBroadcastType($settings["broadcast_icons"], $message);

        // sanitize any discord related roles/emojis/channels
        $this->content = preg_replace('/<(?::\w+:|@!*&*|#)[0-9]+>/i',  '', $this->content);
        $this->content = str_replace('@everyone', '@ everyone', $this->content);
        $this->content = str_replace('@here', '@ here', $this->content);
        $this->content = preg_quote($this->content);
        $this->content = str_replace('@', '\@', $this->content);
        $this->content = str_replace('~', '\~', $this->content);
        $this->content = str_replace('`', '\`', $this->content);

        if ($this->systemMessageType == "NORMAL" && $settings["clan_chat"] == "true") {
            $message .= " **" . $this->username . "**: " . $this->content;
            return $message;
        }

        if ($this->systemMessageType == "COLLECTION_LOG" && $settings['collection_log'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "DROP" && $settings['drops'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "RAID_DROP" && $settings['drops'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "LEVEL_UP" && $settings['level_up'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "QUESTS" && $settings['quests'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "PET_DROP" && $settings['pets'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "PERSONAL_BEST" && $settings['pbs']  == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "PVP" && $settings['pvp'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "ATTENDANCE" && $settings['attendance'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "COMBAT_ACHIEVEMENTS" && $settings['combat_achievements'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "CLUE_DROP" && $settings['clue_drop'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "DIARY" && $settings['diary'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "UNKNOWN") {
            $message .= $this->content;
            return $message;
        }

        return "";
    }

    public function prefixClanRank($setting, $message) {
        if($setting == "true") {
            if(isset($this->clanTitle)) {
                $rank = ClanRank::tryFrom($this->parseClanTitle($this->clanTitle));

                if($rank != null) {
                    $message .= " ". $rank->emoji();
                }
            }
        }

        return $message;
    }

    public function prefixBroadcastType($setting, $message) {
        // CHECK IF BROADCAST MESSAGE
        if($setting == "true") {
            $broadcast = BroadcastType::tryFrom($this->systemMessageType);

            if($broadcast !== null) {
                $message .= " ". $broadcast->emoji();
            }
        }

        return $message;
    }

    public function prefixAccountType($setting, $message) {
        if($setting == "true") {
            switch ($this->accountType) {
                case "IRON":
                    $message .= "<:Ironman_chat_badge:1082980848200065034>";
                break;
                case "HARDCORE_IRON":
                    $message .= "<:Hardcore_ironman_chat_badge:1082980846887243826>";
                    break;
                case "ULTIMATE_IRON":
                    $message .= "<:Ultimate_ironman_chat_badge:1082980849571602532>";
                    break;
                case "UNRANKED_IRON":
                    $message .= "<:Unranked_group_ironman_chat_badg:1082981035068895302>";
                    break;
                case "GROUP_IRON":
                    $message .= "<:Group_ironman_chat_badge:1082980845024985128>";
                    break;
                case "HARDCORE_GROUP_IRON":
                    $message .= "<:Hardcore_group_ironman_chat_badg:1082981031315001344>";
                    break;
                case "PLAYER_MODERATOR":
                    $message .= "<:Player_moderator_emblem:1082981033340833804>";
                    break;
                default:
                    break;
            }
        }

        return $message;
    }

    private function parseClanTitle($title) {
        $title = str_replace(" ", "_", $title);
        $title = str_replace("-", "_", $title);

        return $title;
    }
}
