<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ResponseResource;

class PesanController extends Controller
{
    public function index(Request $request)
    {
        $pesans = Pesan::orderBy('created_at', 'desc');
        $search = $request->input('search');

        if ($search) {
            $pesans->where(function($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%')
                      ->orWhere('isi_pesan', 'like', '%'.$search.'%')
                      ->orWhere('balasan', 'like', '%'.$search.'%');
            });
        }

        $pesans = $pesans->latest()->paginate(4);

        $dataKosong = $pesans->isEmpty();



        return view('admin.pesan.list-pesan', compact('pesans', 'dataKosong'));
    }


    public function countNewMessages(Request $request)
    {
        try {
            $lastCheckTime = $request->input('lastCheckTime');
            $newMessagesCount = Pesan::where('created_at', '>', $lastCheckTime)->count();

            return response()->json([
                'newMessagesCount' => $newMessagesCount
            ]);
        } catch (Exception $e) {
            Log::error('Error counting new messages: ' . $e->getMessage());
            return response()->json([
                'newMessagesCount' => 0,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function store(Request $request, Pesan $pesan)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'isi_pesan' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pesan = Pesan::create([
            'email' => $request-> email,
            'isi_pesan' => $request-> isi_pesan,

        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $pesan);

    }

    public function show($id)
    {
        $pesan = Pesan::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $pesan);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'balasan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $pesan = Pesan::find($id);

            $pesan->update([
                'balasan' => $request-> input('balasan'),
            ]);

            if ($pesan) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $pesan);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }


    //pengguna
    public function pesanPengunjung(Request $request)
    {

        $pesans = Pesan::all();


        return view('pengunjung.dashboard-pengunjung', compact('pesans'));
    }
}
