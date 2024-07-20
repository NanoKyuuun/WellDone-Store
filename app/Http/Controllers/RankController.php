<?php

namespace App\Http\Controllers;

use App\Models\Rank;
// use App\Http\Requests\StoreRankRequest;
use App\Http\Requests\UpdateRankRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rank::with('game')->get();
        // dd($data);
        $game = Game::all();
        return view('rank.index',[
            'data' => $data,
            'game' => $game
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
    public function store(Request $request)
    {
        $request->validate([
            'game_id' => 'required',
            'name' => 'required',
            'harga' => 'required',
        ]);

        $rank = new Rank();
        $rank->game_id = $request->game_id;
        $rank->name = $request->name;
        $rank->harga = $request->harga;
        $rank->save();

        return response()->json([
            'status' => true,
           'message' => 'Sukses memasukkan data',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rank $rank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rank $rank)
    {
        return view('rank.edit',[
            'data' => $rank,
            'games' => Game::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rank $rank)
    {
        $request->validate([
            'game_id' => 'required',
            'name' => 'required',
            'harga' => 'required',
        ]);
        $rank->game_id = $request->game_id;
        $rank->name = $request->name;
        $rank->harga = $request->harga;
        $rank->save();
        return response()->json([
            'status' => true,
           'message' => 'Sukses update data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rank $rank)
    {
        $rank->delete();
        return response()->json([
           'status' => true,
           'message' => 'Sukses menghapus data',
        ]);
    }
}
