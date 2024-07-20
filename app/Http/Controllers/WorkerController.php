<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Worker::with('game')->get();
        $game = Game::all();
        return view('worker.index',[
            'data' => $data,
            'game' => $game,
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
        $request -> validate([
            'game_id' => 'required',
            'name' => 'required',
            'no_wa' => 'required',
            'email' => 'required',
        ]);
        $worker = new Worker();
        $worker->game_id = $request->game_id;
        $worker->name = $request->name;
        $worker->no_wa = $request->no_wa;
        $worker->email = $request->email;
        $worker->save();
        return response()->json([
            'data' => $worker,
           'message' => 'Data berhasil disimpan',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
    {
        return view('worker.edit',[
            'worker' => $worker,
            'games' => Game::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {
        $request->validate([
            'game_id' => 'required',
            'name' => 'required',
            'no_wa' => 'required',
            'email' => 'required',
        ]);
        $worker->game_id = $request->game_id;
        $worker->name = $request->name;
        $worker->no_wa = $request->no_wa;
        $worker->email = $request->email;
        $worker->save();
        return response()->json([
            'data' => $worker,
           'message' => 'Data berhasil diubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return response()->json([
           'message' => 'Data berhasil dihapus',
        ]);
    }
}
