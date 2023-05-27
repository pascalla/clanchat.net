<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ClanMessage extends Model
{
    use HasFactory;

    public function generateHash() {
        $hashString = ($this->username ??  '') . $this->content . substr($this->timestamp, 0, -2);
        return base64_encode($hashString);
    }

    public function generateDiscordMessage($settings) {

        $message = "";

        $message = $this->prefixAccountType($settings["icons"], $message);

        // sanitize any discord related roles/emojis/channels
        $this->content = preg_replace('/<(?::\w+:|@!*&*|#)[0-9]+>/i',  '', $this->content);
        $this->content = str_replace('@everyone', '@\everyone', $this->content);
        $this->content = str_replace('@here', '@\here', $this->content);

        if ($this->systemMessageType == "NORMAL" && $settings["clan_chat"] == "true") {
            // I missed out LEVEL_UP notifications on the plugin, I'm going to add this temporary fix here
            if((str_contains($this->content, "has reached") && str_contains($this->content, "level")) && $settings['level_up'] == "true") {
                $message .= $this->content;
                return $message;
            }

            $message .= "**" . $this->username . "**: " . $this->content;
            return $message;
        }

        if ($this->systemMessageType == "COLLECTION_LOG" && $settings['collection_log'] == "true") {
            $message .= $this->content;
            return $message;
        }

        if ($this->systemMessageType == "DROP" && $settings['drop'] == "true") {
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

        return $message;
    }

    public function prefixAccountType($setting, $message) {
        if($setting == "true") {
            switch ($this->accountType) {
                case "IRON":
                    $message .= "<:Ironman_chat_badge:1082980848200065034> ";
                break;
                case "HARDCORE_IRON":
                    $message .= "<:Hardcore_ironman_chat_badge:1082980846887243826> ";
                    break;
                case "ULTIMATE_IRON":
                    $message .= "<:Ultimate_ironman_chat_badge:1082980849571602532> ";
                    break;
                case "UNRANKED IRON":
                    $$message .= "<:Unranked_group_ironman_chat_badg:1082981035068895302> ";
                    break;
                case "GROUP_IRON":
                    $message .= "<:Group_ironman_chat_badge:1082980845024985128> ";
                    break;
                case "HARDCORE_GROUP_IRON":
                    $message .= "<:Hardcore_group_ironman_chat_badg:1082981031315001344> ";
                    break;
                case "PLAYER_MODERATOR":
                    $message .= "<:Player_moderator_emblem:1082981033340833804> ";
                    break;
                default:
                    break;
            }
        }

        return $message;
    }
}
