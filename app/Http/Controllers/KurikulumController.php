<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Kontak;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class KurikulumController extends Controller
{
    public function index(Request $request)
    {
        $kurikulums = Kurikulum::orderBy('smstr', 'asc');
        $search = $request->input('search');

        if ($search) {
            $kurikulums->where(function($query) use ($search) {
                $query->where('nama_mk', 'like', '%' . $search . '%')
                      ->orWhere('kode_mk', 'like', '%'.$search.'%')
                      ->orWhere('smstr', 'like', '%'.$search.'%')
                      ->orWhere('sks_teori', 'like', '%'.$search.'%')
                      ->orWhere('jam_teori', 'like', '%'.$search.'%')
                      ->orWhere('sks_prak', 'like', '%'.$search.'%')
                      ->orWhere('jam_prak', 'like', '%'.$search.'%');
            });
        }

        $kurikulums = $kurikulums->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $kurikulums->isEmpty();

        return view('admin.kurikulum.list-kurikulum', compact('kurikulums', 'dataKosong'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'smstr' => 'required',
            'sks_teori' => 'required',
            'jam_teori' => 'required',
            'sks_prak' => 'required',
            'jam_prak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kurikulum = Kurikulum::create([
            'kode_mk' => $request-> kode_mk,
            'nama_mk' => $request-> nama_mk,
            'smstr' => $request-> smstr,
            'sks_teori' => $request-> sks_teori,
            'jam_teori' => $request-> jam_teori,
            'sks_prak' => $request-> sks_prak,
            'jam_prak' => $request-> jam_prak,

        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $kurikulum);

    }

    public function show($id)
    {
        $kurikulum = Kurikulum::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $kurikulum);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'smstr' => 'required',
            'sks_teori' => 'required',
            'jam_teori' => 'required',
            'sks_prak' => 'required',
            'jam_prak' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        else{
            $kurikulum = Kurikulum::find($id);

            $kurikulum->update([
                'kode_mk' => $request-> input('kode_mk'),
                'nama_mk' => $request-> input('nama_mk'),
                'smstr' => $request-> input('smstr'),
                'sks_teori' => $request-> input('sks_teori'),
                'jam_teori' => $request-> input('jam_teori'),
                'sks_prak' => $request-> input('sks_prak'),
                'jam_prak' => $request-> input('jam_prak'),

            ]);

            if ($kurikulum) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $kurikulum);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }



    //pengguna
    public function kurikulumPengunjung(Request $request)
    {

        $kurikulums = Kurikulum::all();
        $kontaks = Kontak::all();
        $pesans = Pesan::all();

        return view('pengunjung.kurikulum-pengunjung', compact('kurikulums', 'kontaks', 'pesans'));
    }
}
