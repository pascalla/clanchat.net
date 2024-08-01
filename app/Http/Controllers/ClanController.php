<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ClanOwnership;
use App\Models\Clan;
use App\Models\User;
use Exception;
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
        return response()->json(['status' => 'success', 'data' => $clans]);
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

        $clan = Clan::create([
            'name' => $request->name,
            'secret' => Str::random(32)
        ]);
        
        $clan->users()->attach(Auth::id());

        return response()->json(['status' => 'success', 'data' => 'Successfully created clan.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clan = Clan::findOrFail($id);

        $users = $clan->users()->get(['users.id', 'users.username', 'users.email']);

        return view('clan', compact('clan', 'users'));
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

        return response()->json(['status' => 'success', 'data' => 'Successfully deleted Clan.']);
    }

    /**
     * Add a user to a clan.
     */
    public function addUserToClan(Request $request, $clanId)
    {
        $validator = Validator::make($request->all(), [
            'discord_id' => 'required|exists:users,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 400);
        }
    
        $clan = Clan::findOrFail($clanId);
        $user = User::findOrFail($request->input('discord_id'));
    
        // Check if the user is already a member of the clan
        if ($clan->users->contains($user->id)) {
            return response()->json(['status' => 'error', 'message' => 'User is already a member of the clan'], 400);
        }
    
        $clan->users()->attach($user);
    
        $user = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'User added to clan successfully',
            'user' => $user
        ]);
    }


    public function removeUserFromClan(Request $request, Clan $clan, $userId)
    {
        try {
            $user = User::findOrFail($userId);

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        if (Auth::id() == $user->id) {
            return redirect()->back()->with('error', 'You cannot remove yourself from the clan.');
        }
    

        if (!$clan->users->contains($user->id)) {
            return redirect()->back()->with('error', 'User is not part of this clan.');
        }
    
        try {
            $clan->users()->detach($user->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while removing the user.');
        }
    
        $user = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'User removed from clan.',
            'user' => $user
        ]);
    }
    
    

}
