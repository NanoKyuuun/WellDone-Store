<?php

namespace App\Http\Controllers;

use App\Models\game;
use App\Http\Requests\StoregameRequest;
use App\Http\Requests\UpdategameRequest;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = game::orderBy('id', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Sukses! data ditemukam',
            'data' => $data,
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

        $game = new game();
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
        $data = game::find($id);
        if($data){
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
    public function edit(game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdategameRequest $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $game = game::find($id);
        if($game) {
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
        $game = game::find($id);
        if($game) {
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
