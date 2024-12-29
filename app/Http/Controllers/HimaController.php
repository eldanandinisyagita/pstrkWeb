<?php

namespace App\Http\Controllers;

use App\Models\Hima;
use App\Models\Pesan;
use App\Models\Kontak;
use App\Models\Kabinet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class HimaController extends Controller
{
    public function index(Request $request)
    {
        $himas = Hima::orderBy('nama', 'asc');
        $search = $request->input('search');

        if ($search) {
            $himas->where(function($query) use ($search) {
                $query->where('sejarah', 'like', '%' . $search . '%')
                      ->orWhere('visi', 'like', '%'.$search.'%')
                      ->orWhere('misi', 'like', '%'.$search.'%')
                      ->orWhere('deskripsi', 'like', '%'.$search.'%');
            });
        }

        $himas = $himas->latest()->paginate(4);

        $dataKosong = $himas->isEmpty();

        return view('admin.hima.list-hima', compact('himas', 'dataKosong'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048', // untuk poto
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        $hima = Hima::create([
            'nama' => $request-> nama,
            'sejarah' => $request-> sejarah,
            'visi' => $request-> visi,
            'misi' => $request-> misi,
            'deskripsi' => $request-> deskripsi,
            'foto' => $foto-> hashName(),
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $hima);

    }

    public function show($id)
    {
        $hima = Hima::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $hima);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'deskripsi' => 'required',
            // 'foto' => 'image|mimes:png,jpg, jpeg,svg|max:2048', // untuk poto

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $hima = Hima::find($id);

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            Storage::delete('public/foto/'.basename($hima->foto));

                // Update hima data with new photo
                $hima->update([
                    'nama' => $request-> input('nama'),
                    'sejarah' => $request-> input('sejarah'),
                    'visi' => $request-> input('visi'),
                    'misi' => $request-> input('misi'),
                    'deskripsi' => $request-> input('deskripsi'),
                    'foto' => $foto->hashName(),
                ]);
            } else {
                // Update hima data without changing photo
                $hima->update([
                    'nama' => $request-> input('nama'),
                    'sejarah' => $request-> input('sejarah'),
                    'visi' => $request-> input('visi'),
                    'misi' => $request-> input('misi'),
                    'deskripsi' => $request-> input('deskripsi'),
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Data Berhasil diedit!', 'data' => $hima]);

    }





    //pengguna
     public function himaPengunjung(Request $request)
     {

         $himas = Hima::all();
         $kontaks = Kontak::all();
         $kabinets = Kabinet::all();
         $pesans = Pesan::all();

         foreach ($himas as $hima) {
            // Pastikan 'misi' tidak kosong sebelum dipecah
            if (!empty($hima->misi)) {
                // Pisahkan misi menjadi array berdasarkan tanda titik
                $hima->misi_list = array_filter(array_map('trim', explode('.', $hima->misi)));
            } else {
                $hima->misi_list = []; // Set ke array kosong jika 'misi' kosong
            }
        }

         return view('pengunjung.hima-pengunjung', compact('himas', 'kontaks', 'kabinets', 'pesans'));
     }
}
