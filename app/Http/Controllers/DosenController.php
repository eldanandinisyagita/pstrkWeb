<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pesan;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $dosensQuery = Dosen::where('status', 'Aktif');

        if ($search) {
            $dosensQuery->where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('kompetensi', 'like', '%' . $search . '%')
                    ->orWhere('matkul', 'like', '%' . $search . '%');
            });
        }

        $dosens = $dosensQuery->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $dosens->isEmpty();

        return view('admin.dosen.list-dosen', compact('dosens', 'dataKosong'));
    }

    public function arsip(Request $request)
    {
        $search = $request->input('search');
        $dosensQuery = Dosen::where('status', 'Tidak Aktif');

        if ($search) {
            $dosensQuery->where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('kompetensi', 'like', '%' . $search . '%')
                    ->orWhere('matkul', 'like', '%' . $search . '%');
            });
        }

        $dosens = $dosensQuery->latest()->paginate(4);

        // Cek apakah hasil pencarian kosong
        $dataKosong = $dosens->isEmpty();

        return view('admin.arsip.arsipDosen', compact('dosens', 'dataKosong'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'foto' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048',
            'kompetensi' => 'required',
            'matkul' => 'required',
            'lampiran' => 'required', // Ini untuk kasi tau lulusan mana
            'pddikti' => 'required',
            'status' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        $dosen = Dosen::create([
            'nip' => $request-> nip,
            'nama' => $request-> nama,
            'email' => $request-> email,
            'foto' => $foto-> hashName(),
            'kompetensi' => $request-> kompetensi,
            'matkul' => $request-> matkul,
            'lampiran' => $request-> lampiran,
            'pddikti' => $request-> pddikti,
            'status' => $request-> status,
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $dosen);

    }

    public function show($id)
    {
        $dosen = Dosen::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $dosen);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'kompetensi' => 'required',
            'matkul' => 'required',
            'lampiran' => 'required',
            'pddikti' => 'required',
            'status' => 'required',
            // 'admin_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $dosen = Dosen::find($id);

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            Storage::delete('public/foto/'.basename($dosen->foto));

                // Update dosen data with new photo
                $dosen->update([
                    'nip' => $request->input('nip'),
                    'nama' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'foto' => $foto->hashName(),
                    'kompetensi' => $request->input('kompetensi'),
                    'matkul' => $request->input('matkul'),
                    'lampiran' => $request->input('lampiran'),
                    'pddikti' => $request->input('pddikti'),
                    'status' => $request->input('status'),
                    // 'admin_id' => $request->input('admin_id'),
                ]);
            } else {

                $dosen->update([
                    'nip' => $request->input('nip'),
                    'nama' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'kompetensi' => $request->input('kompetensi'),
                    'matkul' => $request->input('matkul'),
                    'lampiran' => $request->input('lampiran'),
                    'pddikti' => $request->input('pddikti'),
                    'status' => $request->input('status'),
                    // 'admin_id' => $request->input('admin_id'),
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Data Berhasil diedit!', 'data' => $dosen]);

    }



    //pengguna
    public function dosenPengunjung(Request $request)
    {
        $dosens = Dosen::where('status', 'Aktif')->get(); // Hanya ambil dosen dengan status 'Aktif'
        $kontaks = Kontak::all();
        $pesans = Pesan::all();

        return view('pengunjung.dosen-pengunjung', compact('dosens', 'kontaks', 'pesans'));
    }

}
