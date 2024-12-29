<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use App\Models\Pesan;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::join('users', 'faqs.admin_id', '=', 'users.id')
                    ->select('faqs.*');

        if ($request->has('search')) {
            $query->where('faqs.pertanyaan', 'like', '%'.$request->search.'%')
            ->orWhere('faqs.jawaban', 'like', '%'.$request->search.'%');
        }

        $faqs = $query->paginate(5);
        $dataKosong = $faqs->isEmpty();

        $users = User::all();

        return view('admin.faq.list-faq', compact('faqs','users', 'dataKosong'));
    }

    public function store(Request $request, Faq $faq)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            'admin_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $faq = Faq::create([
            'pertanyaan' => $request-> pertanyaan,
            'jawaban' => $request-> jawaban,
            'admin_id' => $request-> admin_id,
        ]);

        return new ResponseResource(true, 'Data Berhasil Ditambahkan!', $faq);

    }

    public function show($id)
    {
        $faq = Faq::whereId($id)->first();

        return new ResponseResource(true, 'Data Berhasil ditemukan!', $faq);

    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 401);
        } else{
            $faq = Faq::find($id);

            $faq->update([
                'pertanyaan' => $request-> input('pertanyaan'),
                'jawaban' => $request-> input('jawaban'),
            ]);

            if ($faq) {
                return new ResponseResource(true, 'Data Berhasil diedit!', $faq);
            } else {
                return response()->json($validator->errors(), 401);
            }
        }
    }



     //pengguna
     public function faqPengunjung(Request $request)
     {

         $faqs = Faq::all();
         $kontaks = Kontak::all();
         $pesans = Pesan::all();

         return view('pengunjung.faq-pengunjung', compact('faqs', 'kontaks', 'pesans'));
     }
}
