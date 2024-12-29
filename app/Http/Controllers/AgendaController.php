<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $agendas = Agenda::orderBy('tgl_mulai', 'desc');
        $search = $request->input('search');

        if ($search) {
            $agendas->where(function($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%'.$search.'%')
                      ->orWhere('tgl_mulai', 'like', '%'.$search.'%')
                      ->orWhere('tgl_selesai', 'like', '%'.$search.'%')
                      ->orWhere('tags', 'like', '%'.$search.'%')
                      ->orWhere('lokasi', 'like', '%'.$search.'%')
                      ->orWhere('penyelenggara', 'like', '%'.$search.'%');
            });
        }

        $agendas = $agendas->latest()->paginate(4);

        $dataKosong = $agendas->isEmpty();

        return view('admin.agenda.list-agenda', compact('agendas', 'dataKosong'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'tags' => 'required',
            'lokasi' => 'required',
            'penyelenggara' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $agenda = Agenda::create([
            'judul' => $request-> judul,
            'deskripsi' => $request-> deskripsi,
            'tgl_mulai' => $request-> tgl_mulai,
            'tgl_selesai' => $request-> tgl_selesai,
            'tags' => $request-> tags,
            'lokasi' => $request-> lokasi,
            'penyelenggara' => $request-> penyelenggara,
            'admin_id' => $request-> admin_id
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $agenda);

    }

    public function show($id)
    {
        $agenda = Agenda::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $agenda);

    }

        public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'tags' => 'required',
            'lokasi' => 'required',
            'penyelenggara' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        }
        else{
            $agenda = Agenda::find($id);

            $agenda->update([
                'judul' => $request-> input('judul'),
                'deskripsi' => $request-> input('deskripsi'),
                'tgl_mulai' => $request-> input('tgl_mulai'),
                'tgl_selesai' => $request-> input('tgl_selesai'),
                'tags' => $request-> input('tags'),
                'lokasi' => $request-> input('lokasi'),
                'penyelenggara' => $request-> input('penyelenggara'),
            ]);

            if ($agenda) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $agenda);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }
}
