<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Agenda;
use App\Models\Alumni;
use App\Models\Kontak;
use App\Models\Konten;
use App\Models\Jenis_konten;
use Illuminate\Http\Request;
use App\Charts\JumlahPrestasiChart;


class DashboardController extends Controller
{

    //admin
    public function index(Request $request, JumlahPrestasiChart $jumlahPrestasiChart)
    {
        $chart1 = $jumlahPrestasiChart->build(1);
        $chart2 = $jumlahPrestasiChart->build(2);
        $jenis1 = 'Foto';

        $agendas = Agenda::orderBy('tgl_mulai', 'desc')->paginate(1);
        $pesans = Pesan::latest()->paginate(2);
        $photos = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->where('jenis_kontens.jenis', $jenis1)
                    ->where('kontens.tags', '=', 'Majalah')
                    ->select('kontens.*')->paginate(5);

        return view('admin.user.dashboard', compact('chart1', 'chart2', 'agendas', 'pesans', 'photos'));
    }




    //pengguna
    public function pengunjung(Request $request)
    {
        $jenis1 = 'Foto';
        $jenis2 = 'Video';
        $jenis3 = 'Berita';
        $jenis4 = 'Prestasi';

        $photos = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->where('jenis_kontens.jenis', $jenis1)
                    ->where('kontens.tags', '=', 'Majalah')
                    ->select('kontens.*')->paginate(5);


        $videos = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->where('jenis_kontens.jenis', $jenis2)
                    ->select('kontens.*')->paginate(5);


        $beritas = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->where('jenis_kontens.jenis', $jenis3)
                    ->select('kontens.*')->paginate(5);


        $prestasis = Konten::join('jenis_kontens', 'kontens.jenis_id', '=', 'jenis_kontens.id')
                    ->where('jenis_kontens.jenis', $jenis4)
                    ->select('kontens.*')->paginate(5);


        $alumnis = Alumni::all();
        $kontaks = Kontak::all();
        $jenis_kontens = Jenis_konten::all();
        $pesans = Pesan::all();

        return view('pengunjung.dashboard-pengunjung', compact('alumnis', 'photos', 'videos', 'beritas','prestasis','jenis_kontens', 'jenis1', 'jenis2', 'jenis3', 'jenis4', 'kontaks', 'pesans'));
    }


}
