<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabinet;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class KabinetController extends Controller
{
    public function index(Request $request)
    {
        $kabinets = Kabinet::orderBy('nama', 'asc');
        $search = $request->input('search');

        if ($search) {
            $kabinets->where(function($query) use ($search) {
                $query->where('jabatan', 'like', '%' . $search . '%')
                      ->orWhere('departemen', 'like', '%'.$search.'%')
                      ->orWhere('nama', 'like', '%'.$search.'%')
                      ->orWhere('tahun', 'like', '%'.$search.'%');
            });
        }

        $kabinets = $kabinets->latest()->paginate(4);

        $dataKosong = $kabinets->isEmpty();

        return view('admin.hima.list-kabinet', compact('kabinets', 'dataKosong'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jabatan' => 'required',
            'departemen' => 'required',
            'tahun' => 'required',
            'foto' => 'required|image|mimes:png,jpg, jpeg,svg|max:2048',
            'hima_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $foto = $request->file('foto');
        $foto->storeAs('public/foto', $foto->hashName());

        $kabinet = Kabinet::create([
            'nama' => $request-> nama,
            'jabatan' => $request-> jabatan,
            'departemen' => $request-> departemen,
            'tahun' => $request-> tahun,
            'foto' => $foto-> hashName(),
            'hima_id' => $request-> hima_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $kabinet);

    }

    public function show($id)
    {
        $kabinet = Kabinet::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $kabinet);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jabatan' => 'required',
            'departemen' => 'required',
            'tahun' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        $kabinet = Kabinet::find($id);

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto');
            $foto->storeAs('public/foto', $foto->hashName());

            Storage::delete('public/foto/'.basename($kabinet->foto));

                // Update kabinet data with new photo
                $kabinet->update([
                    'nama' => $request-> input('nama'),
                    'jabatan' => $request-> input('jabatan'),
                    'departemen' => $request-> input('departemen'),
                    'tahun' => $request-> input('tahun'),
                    'foto' => $foto->hashName(),

                ]);
            } else {
                // Update kabinet data without changing photo
                $kabinet->update([
                    'nama' => $request-> input('nama'),
                    'jabatan' => $request-> input('jabatan'),
                    'departemen' => $request-> input('departemen'),
                    'tahun' => $request-> input('tahun'),

                ]);
            }

            return response()->json(['success' => true, 'message' => 'Data Berhasil diedit!', 'data' => $kabinet]);

    }

}
