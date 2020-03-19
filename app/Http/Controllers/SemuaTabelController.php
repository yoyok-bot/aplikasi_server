<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Rak;
use PDF;

class SemuaTabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_rak = Rak::all();
        return view('dashboard',compact('data_rak'));
    }
    public function tableseluruh(Request $request)
    {
        if ($request->id == 0) {
        return DataTables::of(DB::table('tb_daftar_aplikasi')
        ->rightjoin('tb_perangkat','tb_daftar_aplikasi.id_perangkat','=','tb_perangkat.id_perangkat')
        ->join('tb_ram','tb_perangkat.id_ram','=','tb_ram.id_ram')
        ->join('tb_hdd','tb_perangkat.id_hdd','=','tb_hdd.id_hdd')
        ->join('tb_rak','tb_perangkat.id_rak','=','tb_rak.id_rak')
        ->join('tb_core','tb_perangkat.id_core','=','tb_core.id_core')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_daftar_aplikasi.ip_vps','tb_daftar_aplikasi.ip_public','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->get())
        ->addColumn('action', function ($data) {
            $show = '<a href="#" data-id="' . $data->id_aplikasi . '" class="show-data" style="font-size: 15px"><i class="fa fa-eye"></i></a>';
            return $show;
        })
        ->make(true);
    } else {
        return DataTables::of(DB::table('tb_perangkat')
        ->join('tb_ram','tb_ram.id_ram','=','tb_perangkat.id_ram')
        ->join('tb_hdd','tb_hdd.id_hdd','=','tb_perangkat.id_hdd')
        ->join('tb_rak','tb_rak.id_rak','=','tb_perangkat.id_rak')
        ->join('tb_core','tb_core.id_core','=','tb_perangkat.id_core')
        ->leftjoin('tb_daftar_aplikasi','tb_daftar_aplikasi.id_perangkat','=','tb_perangkat.id_perangkat')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_daftar_aplikasi.ip_vps','tb_daftar_aplikasi.ip_public','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->where('tb_perangkat.id_rak',$request->id)
        ->get())
        ->addColumn('action', function ($data) {
            $show = '<a href="#" data-id="' . $data->id_aplikasi . '" class="show-data" style="font-size: 15px"><i class="fa fa-eye"></i></a>';
            return $show;
        })
        ->make(true);
    }
    }
    public function cetak_pdf_seluruh()
    {
    	$pegawai = DB::table('tb_perangkat')
        ->join('tb_ram','tb_perangkat.id_ram','=','tb_ram.id_ram')
        ->join('tb_hdd','tb_perangkat.id_hdd','=','tb_hdd.id_hdd')
        ->join('tb_rak','tb_perangkat.id_rak','=','tb_rak.id_rak')
        ->join('tb_core','tb_perangkat.id_core','=','tb_core.id_core')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_hdd.keterangan','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->get(); 
    	$pdf = PDF::loadview('cetak_seluruh',['pegawai'=>$pegawai]);
    	return $pdf->stream('laporan-pegawai-pdf');
    }
    public function cetak_pdf_rak($id)
    {
    	$pegawai = DB::table('tb_perangkat')
        ->join('tb_ram','tb_perangkat.id_ram','=','tb_ram.id_ram')
        ->join('tb_hdd','tb_perangkat.id_hdd','=','tb_hdd.id_hdd')
        ->join('tb_rak','tb_perangkat.id_rak','=','tb_rak.id_rak')
        ->join('tb_core','tb_perangkat.id_core','=','tb_core.id_core')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_hdd.keterangan','tb_perangkat.id_rak','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->where('tb_perangkat.id_rak',$id)
        ->get();
    	$pdf = PDF::loadview('cetak_rak',compact('pegawai'));
    	return $pdf->stream('laporan-pegawai-pdf');
    }
    public function cetak_pdf_aplikasi($id)
    {
    	$aplikasi = DB::table('tb_perangkat')
        ->join('tb_ram','tb_ram.id_ram','=','tb_perangkat.id_ram')
        ->join('tb_hdd','tb_hdd.id_hdd','=','tb_perangkat.id_hdd')
        ->join('tb_rak','tb_rak.id_rak','=','tb_perangkat.id_rak')
        ->join('tb_core','tb_core.id_core','=','tb_perangkat.id_core')
        ->leftjoin('tb_daftar_aplikasi','tb_daftar_aplikasi.id_perangkat','=','tb_perangkat.id_perangkat')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_daftar_aplikasi.ip_vps','tb_daftar_aplikasi.ip_public','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_hdd.keterangan','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->where('tb_daftar_aplikasi.id_aplikasi',$id)->first();
    	$pdf = PDF::loadview('cetak_aplikasi',compact('aplikasi'));
        return $pdf->stream('laporan-pegawai-pdf');
        // return response()->json($aplikasi);
    }
    public function cetak_pdf_server($id)
    {
    	$server = DB::table('tb_perangkat')
        ->leftjoin('tb_daftar_aplikasi','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
        ->select('tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_perangkat.ip_server')
        ->where('tb_perangkat.ip_server',$id)
        ->get();
        $server1 = DB::table('tb_perangkat')
        ->leftjoin('tb_daftar_aplikasi','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
        ->select('tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_perangkat.ip_server')
        ->where('tb_perangkat.ip_server',$id)->first();
    	$pdf = PDF::loadview('cetak_server',compact('server','server1'));
        return $pdf->stream('laporan-pegawai-pdf');
        // return response()->json($aplikasi);
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
    public function anyData($id)
    {
        $detail_perangkat = DB::table('tb_perangkat')
        ->join('tb_ram','tb_perangkat.id_ram','=','tb_ram.id_ram')
        ->join('tb_hdd','tb_perangkat.id_hdd','=','tb_hdd.id_hdd')
        ->join('tb_rak','tb_perangkat.id_rak','=','tb_rak.id_rak')
        ->join('tb_core','tb_perangkat.id_core','=','tb_core.id_core')
        ->leftjoin('tb_daftar_aplikasi','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_daftar_aplikasi.ip_vps','tb_daftar_aplikasi.ip_public','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_hdd.keterangan','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->where('tb_daftar_aplikasi.id_aplikasi',$id)->first();
            return response()->json($detail_perangkat);
    }
    public function anyDataaplikasi($id)
    {
        $detail_perangkat = DB::table('tb_perangkat')
        ->leftjoin('tb_daftar_aplikasi','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
        ->select('tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_perangkat.ip_server')
        ->where('tb_perangkat.ip_server',$id)
        ->get();
            return response()->json($detail_perangkat);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
