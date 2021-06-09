<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use App\Http\Resources\Player as PlayerResource;
use App\Http\Resources\PlayerCollection;

class PlayerController extends Controller
{
    public function index()
    {
        return new PlayerCollection(Player::all());
    }

    public function show($id)
    {
        return new PlayerResource(Player::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $player = Player::create($request->all());

        return (new PlayerResource($player))
                ->response()
                ->setStatusCode(201);
    }

    public function goal($id)
    {
        $player = Player::findOrFail($id);
        $player->goals++;
        $player->save();

        return new PlayerResource($player);
    }

    public function delete($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return response()->json(null, 204);
    }

    public function resetGoals($id)
    {
        $player = Player::findOrFail($id);
        $player->goals = 0;

        return new PlayerResource($player);
    }
}
