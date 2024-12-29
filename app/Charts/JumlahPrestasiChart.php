<?php
namespace App\Charts;

use App\Models\Konten;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class JumlahPrestasiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($jenis_id)
    {
        // Categorize the results by status (assuming 'Dosen' and 'Mahasiswa')
        $labels = ['Dosen', 'Mahasiswa'];
        $values = [
            Konten::where('jenis_id', $jenis_id)->where('tags', 'Dosen')->count(),
            Konten::where('jenis_id', $jenis_id)->where('tags', 'Mahasiswa')->count(),
        ];

        return $this->chart->pieChart()
            ->addData($values)
            ->setLabels($labels)
            ->setHeight(100);
    }
}
