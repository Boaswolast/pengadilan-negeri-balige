<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class PengadilanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // Ambil bulan dari setiap tabel
        $eksekusi_months = DB::table('eksekusi')
            ->selectRaw('DISTINCT DATE_FORMAT(created_at, "%Y-%m") as month')
            ->where('is_deleted', 0)
            ->orderBy('month')
            ->pluck('month')
            ->toArray();

        $sertifikat_months = DB::table('pemblokiran_sertifikat')
            ->selectRaw('DISTINCT DATE_FORMAT(created_at, "%Y-%m") as month')
            ->where('is_deleted', 0)
            ->orderBy('month')
            ->pluck('month')
            ->toArray();

        $peristiwa_months = DB::table('peristiwa_penting')
            ->selectRaw('DISTINCT DATE_FORMAT(created_at, "%Y-%m") as month')
            ->where('is_deleted', 0)
            ->orderBy('month')
            ->pluck('month')
            ->toArray();

        // Gabungkan semua bulan yang ada dari ketiga tabel
        $months = array_unique(array_merge($eksekusi_months, $sertifikat_months, $peristiwa_months));
        sort($months); // Urutkan bulan secara ascending

        // Ambil data untuk setiap bulan dari setiap tabel
        $data1 = $this->getDataForMonths('eksekusi', $months);
        $data2 = $this->getDataForMonths('pemblokiran_sertifikat', $months);
        $data3 = $this->getDataForMonths('peristiwa_penting', $months);

        return $this->chart->lineChart()
            ->setHeight(350)
            ->addData('Eksekusi Perkara', $data1)
            ->addData('Pemblokiran Sertifikat', $data2)
            ->addData('Peristiwa Penting', $data3)
            ->setXAxis($months);
    }

    // Fungsi untuk mendapatkan data untuk setiap bulan dari tabel tertentu
    private function getDataForMonths($table, $months)
    {
        $data = [];

        foreach ($months as $month) {
            $count = DB::table($table)
                ->where('is_deleted', 0)
                ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$month])
                ->count();
            $data[] = $count;
        }

        return $data;
    }
}
