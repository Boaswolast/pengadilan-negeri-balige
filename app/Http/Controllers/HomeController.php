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

    public function countNotif($notif)
    {
        $count = DB::table('pemblokiran_sertifikat')->where('status_notif', $notif)->count();
        return $count === 0 ? null : $count;
    }


    public function index()
    {
        $statusCount = $this->countNotif('1');
        return view('home', ['statusNotif' => $statusCount]);
    }
}
