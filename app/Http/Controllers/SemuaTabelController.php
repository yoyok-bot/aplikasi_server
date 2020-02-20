<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class SemuaTabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_perangkat = DB::table('tb_perangkat')
                    ->join('tb_ram','tb_ram.id_ram','=','tb_perangkat.id_ram')
                    ->join('tb_hdd','tb_hdd.id_hdd','=','tb_perangkat.id_hdd')
                    ->join('tb_rak','tb_rak.id_rak','=','tb_perangkat.id_rak')
                    ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat'
                    ,'tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan'
                    ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_rak.nomer_rak')
                    ->get();
        return view('dashboard',compact('data_perangkat'));
    }
    public function tableseluruh()
    {
        return DataTables::of(DB::table('tb_perangkat')
        ->join('tb_ram','tb_ram.id_ram','=','tb_perangkat.id_ram')
        ->join('tb_hdd','tb_hdd.id_hdd','=','tb_perangkat.id_hdd')
        ->join('tb_rak','tb_rak.id_rak','=','tb_perangkat.id_rak')
        ->join('tb_daftar_aplikasi','tb_daftar_aplikasi.id_perangkat','=','tb_perangkat.id_perangkat')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat'
        ,'tb_perangkat.tipe_perangkat','tb_daftar_aplikasi.nama_aplikasi','tb_perangkat.status_kepemilikan'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_rak.nomer_rak')
        ->get())
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
