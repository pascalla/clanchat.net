<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ClanOwnership;
use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ClanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(ClanOwnership::class)->only(['view', 'show', 'delete']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clans = Auth::user()->clans()->get()->map->only('name', 'id', 'status');
        return response()->json(array('status' => 'success', 'data' => $clans));
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
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json($validator->messages()->first(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        Clan::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'secret' => Str::random(32)
        ]);

        return response()->json(['status' => 'success', 'data' => 'Successfully created clan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Clan $clan)
    {

        return view('clan')->with('clan', $clan)->with('status', $clan->chat_status);
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
    public function destroy(string $id, Request $request)
    {
        $clan = Clan::findOrFail($id);

        if ($request->user()->cannot('update', $clan)) {
            abort(403);
        }

        $clan->settings()->delete();
        $clan->secrets()->delete();
        $clan->delete();

        return response()->json(array('status' => 'success', 'data' => 'Sucessfully deleted Clan.'));
    }
}
