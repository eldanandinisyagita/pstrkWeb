<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pesan;
use App\Models\Alumni;
use App\Models\Kontak;
use App\Models\Konten;
use App\Models\Jenis_konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::join('users', 'alumnis.admin_id', '=', 'users.id')
                    ->select('alumnis.*');

        if ($request->has('search')) {
            $query->where('alumnis.nama', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.pekerjaan', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.kompetensi', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.deskripsi', 'like', '%'.$request->search.'%')
            ->orWhere('alumnis.generasi', 'like', '%'.$request->search.'%');
        }

        $alumnis = $query->paginate(5);
        $dataKosong = $alumnis->isEmpty();
        $users = User::all();

        return view('admin.alumni.list-alumni', compact('alumnis', 'users', 'dataKosong'));
    }

    //pengguna
    public function alumniPengunjung(Request $request)
    {
        $jenis2 = 'Berita';

        $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                        ->where('jenis_kontens.jenis', $jenis2)
                        ->select('kontens.*')->paginate(5);

        $jenis_kontens = Jenis_konten::all();

        $alumnis = Alumni::all();
        $kontaks = Kontak::all();
        $pesans = Pesan::all();

        return view('pengunjung.alumni-pengunjung', compact('alumnis', 'kontaks', 'jenis2', 'jenis_kontens','beritas','pesans'));
    }
    //------------------------------------- API --------------------------------------------------------

    public function store(Request $request, Alumni $alumni)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'generasi' => 'required',
            'pekerjaan' => 'required',
            'deskripsi' => 'required',
            'kompetensi' => 'required',
            'foto' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        $alumni = Alumni::create([
            'nama' => $request-> nama,
            'generasi' => $request-> generasi,
            'pekerjaan' => $request-> pekerjaan,
            'deskripsi' => $request-> deskripsi,
            'kompetensi' => $request-> kompetensi,
            'foto' => $foto-> hashName(),
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $alumni);

    }

    public function show($id)
    {
        $alumni = Alumni::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $alumni);

    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'generasi' => 'required',
            'pekerjaan' => 'required',
            'deskripsi' => 'required',
            'kompetensi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }

        $alumni = Alumni::find($id);

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            Storage::delete('public/foto/'.basename($alumni->foto));

                // Update alumni data with new photo
                $alumni->update([
                    'nama' => $request->input('nama'),
                    'generasi' => $request->input('generasi'),
                    'pekerjaan' => $request->input('pekerjaan'),
                    'deskripsi' => $request->input('deskripsi'),
                    'kompetensi' => $request->input('kompetensi'),
                    'foto' => $foto->hashName(),
                ]);
            } else {
                // Update alumni data without changing photo
                $alumni->update([
                    'nama' => $request->input('nama'),
                    'generasi' => $request->input('generasi'),
                    'pekerjaan' => $request->input('pekerjaan'),
                    'deskripsi' => $request->input('deskripsi'),
                    'kompetensi' => $request->input('kompetensi'),


                ]);
            }

            return response()->json(['success' => true, 'message' => 'Data Berhasil diedit!', 'data' => $alumni]);
    }
}
