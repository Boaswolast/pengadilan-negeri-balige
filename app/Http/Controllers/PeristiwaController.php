<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeristiwaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::select('CALL viewAll_peristiwaPenting()');
        $data = collect($data);
        return view('Peristiwa/index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function createPihak()
    {
        //
    }

    public function storePihak()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = DB::select('CALL viewAll_peristiwaPenting_dataDiri(?)', array($id));
        $data = collect($data);
        return view('Peristiwa/detail',['data' => $data]);
    }

    public function showPihak(string $id)
    {
        $data = DB::select('CALL view_peristiwaPenting_dataDiri(?)', array($id));
        $data = collect($data);
        return view('Peristiwa/detailPihak',['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
