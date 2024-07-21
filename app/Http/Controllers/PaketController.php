<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Http\Requests\StorePaketRequest;
use App\Http\Requests\UpdatePaketRequest;
use App\Models\Rank;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Paket::with('rank')->get();
        $rank = Rank::all();

        return view('paket.index', [
            'data' => $data,
            'rank' => $rank,
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
    public function store(StorePaketRequest $request)
    {
        $request->validate([
            'rank_id' => 'required',
            'name' => 'required',
            'bintang' => 'required',
            'harga' => 'required',
            'disc' => 'required',
            'descripsi' => 'required',
        ]);

        $paket = new Paket();
        $paket->rank_id = $request->rank_id;
        $paket->name = $request->name;
        $paket->bintang = $request->bintang;
        $paket->harga = $request->harga;
        $paket->disc = $request->disc;
        $paket->descripsi = $request->descripsi;
        $paket->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        return view('paket.edit', [
            'data' => $paket,
            'ranks' => Rank::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaketRequest $request, Paket $paket)
    {
        $request->validate([
            'rank_id' => 'required',
            'name' => 'required',
            'bintang' => 'required',
            'harga' => 'required',
            'disc' => 'required',
            'descripsi' => 'required',
        ]);

        $paket->rank_id = $request->rank_id;
        $paket->name = $request->name;
        $paket->bintang = $request->bintang;
        $paket->harga = $request->harga;
        $paket->disc = $request->disc;
        $paket->descripsi = $request->descripsi;
        $paket->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses update data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();
        return response()->json([
           'status' => true,
           'message' => 'Sukses menghapus data',
        ]);
    }
}
