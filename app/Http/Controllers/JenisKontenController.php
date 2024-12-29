<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_konten;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;

class JenisKontenController extends Controller
{
    public function index(Request $request)
    {
        $jenis_kontens = Jenis_konten::orderBy('created_at', 'desc');
        $search = $request->input('search');

        if ($search) {
            $jenis_kontens->where(function($query) use ($search) {
                $query->where('jenis', 'like', '%' . $search . '%');
            });
        }

        $jenis_kontens = $jenis_kontens->latest()->paginate(5);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $jenis_kontens->isEmpty();


        return view('admin.jeniskonten.list-jeniskonten', compact('jenis_kontens', 'dataKosong'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jenis_konten = Jenis_konten::create([
            'jenis' => $request-> jenis,

        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $jenis_konten);

    }

    public function show($id)
    {
        $jenis_konten = Jenis_konten::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $jenis_konten);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        else{
            $jenis_konten = Jenis_konten::find($id);

            $jenis_konten->update([
                'jenis' => $request-> input('jenis'),

            ]);

            if ($jenis_konten) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $jenis_konten);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }
}
