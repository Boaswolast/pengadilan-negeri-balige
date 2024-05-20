<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\PengadilanChart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function countNotif($notif)
    // {
    //     $count = DB::table('pemblokiran_sertifikat')->where('status_notif', $notif)->count();
    //     return $count === 0 ? null : $count;
    // }


    public function index(PengadilanChart $pengadilanChart)
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $notif3 = collect(DB::select('CALL notifPN_eksekusi()'));
        $total3 = $notif3->sum('jumlah');
        $messages3 = collect($notif3)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2 + $total3;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2, $messages3);

        $eksekusi = DB::table('eksekusi')->where('is_deleted', 0)->count();
        $pemblokiran = DB::table('pemblokiran_sertifikat')->where('is_deleted', 0)->count();
        $peristiwa = DB::table('peristiwa_penting')->where('is_deleted', 0)->count();
        return view('home', [
            'totalNotif' => $totalNotif, 
            'messages' => $messages,
            'pengadilanChart' => $pengadilanChart->build(),
            'eksekusi' => $eksekusi,
            'pemblokiran' => $pemblokiran,
            'peristiwa' => $peristiwa
        ]);
    }

    public function getProfilePictureAttribute()
    {
        $initial = strtoupper(substr($this->name, 0, 1));
        
        $path = 'img/profiles/' . $initial . '.png';
        
        return asset($path);
    }

    // Metode untuk menghitung total data dalam tabel
    public function countData($table)
    {
        // Menggunakan Query Builder untuk menghitung semua hasil dalam tabel
        return DB::table($table)->count();
    }
}