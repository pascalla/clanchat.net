<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessMessage;
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
        $secrets = explode(',', $request->clan_secret);

        foreach($secrets as $secretKey) {
            // validate the clan chat in url is valid
            $clanSecret = ClanSecretKey::where('key', $secretKey)->firstOrFail();
            $clan = $clanSecret->clan;

            if ($clan->status === "INACTIVE") {
                return response()->json(array('status' => 'success', 'data' => 'Clan is not setup yet.'));
            }

            // process message into Message object
            $requestMessage = json_decode($request->data);

            if ($clanSecret->guest) {
                // only process system messages
                if ($requestMessage->systemMessageType == "NORMAL") {
                    continue;
                } else {
                    $guests = $clan->guests->pluck('name')->toArray();

                    // if guest name isn't included in message
                    $includes = false;
                    foreach ($guests as $guest) {
                        $guest = strtolower($guest);
                        $message = strtolower($requestMessage->content);

                        $match = preg_match("/\b" . $guest . "\b/i", $message);

                        if ($match == 1) {
                            $includes = true;
                        }
                    }

                    if (!$includes) {
                        continue;
                    }
                }
            }

            $message = new ClanMessage;
            $message->username = $requestMessage->author;
            $message->content = $requestMessage->content;
            $message->accountType = $requestMessage->accountType;
            $message->systemMessageType = $requestMessage->systemMessageType;
            $message->clanId = $clan->id;

            if (isset($requestMessage->clanTitle)) {
                $message->clanTitle = $requestMessage->clanTitle;
            }

            $message->timestamp = $requestMessage->timestamp;

            ProcessMessage::dispatch($message, $clan);
        }

        return response()->json(array('status' => 'success', 'data' => 'Message has been processed.'));
    }
}
