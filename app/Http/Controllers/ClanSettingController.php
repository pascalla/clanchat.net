<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ClanSettingController extends Controller
{
    public $settings = [
        'clan_id',
        'discord_webhook',
        'clan_chat',
        'collection_log',
        'quests',
        'pets',
        'pbs',
        'pvp',
        'attendance',
        'icons',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clan_id' => 'required|exists:App\Models\Clan,id',
            'discord_webhook' => 'required',
            'clan_chat' => 'required',
            'collection_log' => 'required',
            'quests' => 'required',
            'pets' => 'required',
            'pbs' => 'required',
            'pvp' => 'required',
            'attendance' => 'required',
            'icons' => 'required',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json($validator->messages()->first(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $clan = Clan::findOrFail($request->clan_id);

        if ($request->user()->cannot('update', $clan)) {
            abort(403);
        }

        $settings = $request->only($this->settings);

        foreach($settings as $key => $value) {
            ClanSetting::updateOrCreate([
                'clan_id' => $request->clan_id,
                'key' => $key
            ],
            [
                'value' => $value
            ]);
        }

        $clan->status = "ACTIVE";
        $clan->save();

        return response()->json(array('status' => 'success', 'data' => 'Successfully updated Clan settings.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
