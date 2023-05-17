<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ClanOwnership;
use App\Models\Clan;
use App\Models\ClanSecretKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ClanSecretController extends Controller
{
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
            'nickname' => 'required|max:64',
            'clan_id' => 'required|exists:App\Models\Clan,id'
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json($validator->messages()->first(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $clan = Clan::findOrFail($request->clan_id);

        if ($request->user()->cannot('update', $clan)) {
            abort(403);
        }

        ClanSecretKey::create([
            'nickname' => $request->nickname,
            'clan_id' => $request->clan_id,
            'key' => Str::random(32)
        ]);

        return response()->json(['status' => 'success', 'data' => 'Successfully created clan secret.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClanSecretKey $clanSecretKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClanSecretKey $clanSecretKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClanSecretKey $clanSecretKey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClanSecretKey $clanSecretKey)
    {
        //
    }
}