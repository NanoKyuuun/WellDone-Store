<?php

namespace App\Http\Controllers;

use App\Models\informasi;
use App\Http\Requests\StoreinformasiRequest;
use App\Http\Requests\UpdateinformasiRequest;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = informasi::orderBy('id', 'asc')->get();
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
    public function store(StoreinformasiRequest $request)
    {
        $request->validate([
            'body' => 'required',
            'fb' => 'required',
            'ig' => 'required',
            'telegram' => 'required',
            'tiktok' => 'required',
            'wa' => 'required',
            'email' => 'required|string|email',
        ]);

        $informasi = new informasi();
        $informasi->body = $request->body;
        $informasi->fb = $request->fb;
        $informasi->ig = $request->ig;
        $informasi->telegram = $request->telegram;
        $informasi->tiktok = $request->tiktok;
        $informasi->wa = $request->wa;
        $informasi->email = $request->email;
        $informasi->save();

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
        $data = informasi::find($id);
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
    public function edit(informasi $informasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinformasiRequest $request, $id)
    {
        $request->validate([
            'body' => 'required',
            'fb' => 'required',
            'ig' => 'required',
            'telegram' => 'required',
            'tiktok' => 'required',
            'wa' => 'required',
            'email' => 'required|string|email',
        ]);

        $informasi = Informasi::find($id);
        if($informasi) {
            $informasi->body = $request->body;
            $informasi->fb = $request->fb;
            $informasi->ig = $request->ig;
            $informasi->telegram = $request->telegram;
            $informasi->tiktok = $request->tiktok;
            $informasi->wa = $request->wa;
            $informasi->email = $request->email;
            $informasi->save();

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
        $informasi = Informasi::find($id);
        if($informasi) {
            $informasi->delete();
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
