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

        ProcessMessage::dispatch($message, $clan);

        return response()->json(array('status' => 'success', 'data' => 'Message has been processed.'));
    }
}
