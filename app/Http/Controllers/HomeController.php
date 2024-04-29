<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


    public function index()
    {
        $notif1 = collect(DB::select('CALL notifPN_sertifikat()'));
        $total1 = $notif1->sum('jumlah');
        $messages1 = collect($notif1)->pluck('notification')->all();

        $notif2 = collect(DB::select('CALL notifPN_peristiwa()'));
        $total2 = $notif2->sum('jumlah');
        $messages2 = collect($notif2)->pluck('notification')->all(); 

        $totalNotif = $total1 + $total2;
        if($totalNotif === 0){
            $totalNotif = null;
        }
        $messages = array_merge($messages1, $messages2);
        return view('home', ['totalNotif' => $totalNotif, 'messages' => $messages]);
    }
}
