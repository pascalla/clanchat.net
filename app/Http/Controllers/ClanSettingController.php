<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class ClanSettingController extends Controller
{
    public $settings = [
        'clan_id',
        'discord_webhook',
        'clan_chat',
        'collection_log',
        'drops',
        'level_up',
        'quests',
        'pets',
        'pbs',
        'pvp',
        'attendance',
        'icons',
        'combat_achievements',
        'clue_drop',
        'diary',
        'unknown'
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
            'clan_id' => ['required', 'exists:App\Models\Clan,id'],
            'discord_webhook' => ['required'],
            'clan_chat' => ['required', 'string','in:true,false'],
            'collection_log' => ['required','string','in:true,false'],
            'drops' => ['required','string','in:true,false'],
            'level_up' => ['required','string','in:true,false'],
            'quests' => ['required','string','in:true,false'],
            'pets' => ['required','string','in:true,false'],
            'pbs' => ['required','string','in:true,false'],
            'pvp' => ['required','string','in:true,false'],
            'attendance' => ['required','string','in:true,false'],
            'icons' => ['required','string','in:true,false'],
            'combat_achievements' => ['required','string','in:true,false'],
            'clue_drop' => ['required','string','in:true,false'],
            'diary' => ['required','string','in:true,false'],
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
