<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoregameRequest;
use App\Http\Requests\UpdategameRequest;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Game::orderBy('id', 'asc')->get();
        return view('game.index', [
            'data' => $data
        ]);
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
    public function store(StoregameRequest $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $game = new Game();
        $game->name = $request->name;
        $game->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Game::find($id);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sukses! data ditemukam',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed! data tidak ditemukam',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('game.edit', [
            'data' => $game,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategameRequest $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $game = Game::find($id);
        if ($game) {
            $game->name = $request->name;
            $game->save();

            return response()->json([
                'status' => true,
                'message' => 'Sukses memperbarui data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed! data tidak ditemukan',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $game = Game::find($id);
        if ($game) {
            $game->delete();
            return response()->json([
                'status' => true,
                'message' => 'Sukses menghapus data',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed! data tidak ditemukan',
            ]);
        }
    }
}
