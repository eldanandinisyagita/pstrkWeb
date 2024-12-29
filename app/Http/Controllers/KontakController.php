<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontak;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class KontakController extends Controller
{
    public function index(Request $request)
    {
        $kontaks = Kontak::orderBy('created_at', 'desc');
        $search = $request->input('search');

        if ($search) {
            $kontaks->where(function($query) use ($search) {
                $query->where('kontak', 'like', '%' . $search . '%')
                      ->orWhere('jenis_kontak', 'like', '%'.$search.'%');
            });
        }

        $kontaks = $kontaks->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $kontaks->isEmpty();

        return view('admin.kontak.list-kontak', compact('kontaks', 'dataKosong'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kontak' => 'required',
            'jenis_kontak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kontak = Kontak::create([
            'kontak' => $request-> kontak,
            'jenis_kontak' => $request-> jenis_kontak,
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $kontak);

    }

    public function show($id)
    {
        $kontak = Kontak::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $kontak);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kontak' => 'required',
            'jenis_kontak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        else{
            $kontak = Kontak::find($id);

            $kontak->update([
                'kontak' => $request-> input('kontak'),
                'jenis_kontak' => $request-> input('jenis_kontak'),

            ]);

            if ($kontak) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $kontak);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }
}
