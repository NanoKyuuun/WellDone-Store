<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Game;
use App\Models\Paket;
use App\Models\Rank;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::with(['user', 'game', 'rank', 'paket'])->get();
        $user = User::all();
        $game = Game::all();
        $rank = Rank::all();
        $paket = Paket::with('rank.game')->get();
        // dd($paket);
        return view('order.index', [
            'data' => $data,
            'user' => $user,
            'game' => $game,
            'rank' => $rank,
            'paket' => $paket,
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
    public function store(StoreOrderRequest $request)
    {
        $request->validate([
            'user_id' => 'nullable',
            'game_id' => 'required',
            'rank_id' => 'required',
            'paket_id' => 'nullable',
            'rank_awal' => 'required',
            'rank_tujuan' => 'required',
            'bintang' => 'required',
            'catatan' => 'nullable',
            'req_hero' => 'required',
            'password' => 'required',
            'methode_login' => 'required',
            'email' => 'required|email',
            'no_wa' => 'required',
        ]);

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->game_id = $request->game_id;
        $order->rank_id = $request->rank_id;
        $order->paket_id = $request->paket_id;
        $order->rank_awal = $request->rank_awal;
        $order->rank_tujuan = $request->rank_tujuan;
        $order->bintang = $request->bintang;
        $order->catatan = $request->catatan;
        $order->req_hero = $request->req_hero;
        $order->password = $request->password;
        $order->methode_login = $request->methode_login;
        $order->email = $request->email;
        $order->no_wa = $request->no_wa;
        $order->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('order.edit', [
            'data' => $order,
            'users' => User::all(),
            'games' => Game::all(),
            'ranks' => Rank::all(),
            'pakets' => Paket::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $request->validate([
            'user_id' => 'nullable',
            'game_id' => 'required',
            'rank_id' => 'required',
            'paket_id' => 'nullable',
            'rank_awal' => 'required',
            'rank_tujuan' => 'required',
            'bintang' => 'required',
            'catatan' => 'nullable',
            'req_hero' => 'required',
            'password' => 'required',
            'methode_login' => 'required',
            'email' => 'required|email',
            'no_wa' => 'required',
        ]);

        $order->user_id = $request->user_id;
        $order->game_id = $request->game_id;
        $order->rank_id = $request->rank_id;
        $order->paket_id = $request->paket_id;
        $order->rank_awal = $request->rank_awal;
        $order->rank_tujuan = $request->rank_tujuan;
        $order->bintang = $request->bintang;
        $order->catatan = $request->catatan;
        $order->req_hero = $request->req_hero;
        $order->password = $request->password;
        $order->methode_login = $request->methode_login;
        $order->email = $request->email;
        $order->no_wa = $request->no_wa;
        $order->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses update data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'status' => true,
            'message' => 'Sukses menghapus data',
        ]);
    }
}
