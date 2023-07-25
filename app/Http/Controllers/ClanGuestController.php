<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ClanGuestController extends Controller
{
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
            'name' => 'required|max:64',
            'clan_id' => 'required|exists:App\Models\Clan,id'
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json($validator->messages()->first(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $clan = Clan::findOrFail($request->clan_id);

        if ($request->user()->cannot('update', $clan)) {
            abort(403);
        }

        ClanGuest::create([
            'name' => $request->name,
            'clan_id' => $request->clan_id,
        ]);

        return response()->json(['status' => 'success', 'data' => 'Successfully added clan guest.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Clan $clan, Request $request)
    {
        $clan = Clan::findOrFail($clan->id);

        if ($request->user()->cannot('update', $clan)) {
            abort(403);
        }

        return response()->json(array('status' => 'success', 'data' => $clan->guests));
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
    public function destroy(string $clanGuestId, Request $request)
    {
        $clanGuest = ClanGuest::findOrFail($clanGuestId);
        $clan = Clan::findOrFail($clanGuest->clan_id);

        if ($request->user()->cannot('update', $clan)) {
            abort(403);
        }

        $clanGuest->delete();

        return response()->json(array('status' => 'success', 'data' => 'Successfully deleted clan guest member.'));
    }
}
