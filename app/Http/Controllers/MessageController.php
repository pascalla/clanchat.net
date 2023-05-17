<?php

namespace App\Http\Controllers;

use App\Models\ClanMessage;
use App\Models\ClanSecretKey;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validate the clan chat in url is valid
        $clan = ClanSecretKey::where('key', $request->clan_secret)->firstOrFail()->clan;

        if ($clan->status === "INACTIVE") {
            return response()->json(array('status' => 'success', 'data' => 'Clan is not setup yet.'));
        }

        // process message into Message object
        $requestMessage = json_decode($request->data);

        $message = new ClanMessage;
        $message->username = $requestMessage->author;
        $message->content = $requestMessage->content;
        $message->accountType = $requestMessage->accountType;
        $message->systemMessageType = $requestMessage->systemMessageType;
        $message->timestamp = $requestMessage->timestamp;

        // acquire clan chat specific lock
        $lock = Cache::lock('clan-lock-' . $clan->id, 10);

        try {
            $lock->block(5);

            // Lock acquired after waiting a maximum of 5 seconds
            $added = Cache::add($message->generateHash(), $clan->id, 10);

            // check if message exists in redis
            if(!$added) {
                $lock?->release();
                return response()->json(array('status' => 'success', 'data' => 'Message has already been processed'));
            }

        } catch (LockTimeoutException $e) {
            // Unable to acquire lock...
        } finally {
            $lock?->release();
        }

        $webhook = $clan->settings()->where('key', 'discord_webhook')->get()->pluck('value')->first();

        $settings = $clan->settings()->get()->mapWithKeys(function($setting, $key) {
            return [$setting->key => $setting->value];
        });

        // send message to clan chat webhook
        $response = Http::post($webhook, [
            'content' => $message->generateDiscordMessage($settings)
        ]);

        return response()->json(array('status' => 'success', 'data' => 'Message has been processed.'));
    }
}
