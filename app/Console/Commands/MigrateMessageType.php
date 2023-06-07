<?php

namespace App\Console\Commands;

use App\Models\Clan;
use App\Models\ClanSetting;
use Illuminate\Console\Command;

class MigrateMessageType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-message-type {setting_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create new setting and enable it for all active clans.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $settingName = $this->argument('setting_name');

        $clans = Clan::where('status', 'ACTIVE')->get();

        foreach ($clans as $clan) {
            $setting = new ClanSetting;
            $setting->clan_id = $clan->id;
            $setting->key = $settingName;
            $setting->value = "true";
            $setting->save();
        }
    }
}
