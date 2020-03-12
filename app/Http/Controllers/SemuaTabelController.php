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
        return DataTables::of(DB::table('tb_perangkat')
        ->join('tb_ram','tb_perangkat.id_ram','=','tb_ram.id_ram')
        ->join('tb_hdd','tb_perangkat.id_hdd','=','tb_hdd.id_hdd')
        ->join('tb_rak','tb_perangkat.id_rak','=','tb_rak.id_rak')
        ->join('tb_core','tb_perangkat.id_core','=','tb_core.id_core')
        ->leftjoin('tb_daftar_aplikasi','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
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
        ->join('tb_daftar_aplikasi','tb_daftar_aplikasi.id_perangkat','=','tb_perangkat.id_perangkat')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_daftar_aplikasi.ip_vps','tb_daftar_aplikasi.ip_public','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->where('tb_perangkat.id_rak',$request->id)
        ->get())
        ->addColumn('action', function ($data) {
            if($data > 0){
            $show = '<a href="#" data-id="' . $data->id_aplikasi . '" class="show-data" style="font-size: 15px"><i class="fa fa-eye"></i></a>';
            return $show;
            }else{
            $show = '<a href="#" data-id="' . $data->id_perangkat . '" class="show-data" style="font-size: 15px"><i class="fa fa-eye"></i></a>';
            return $show;
            }
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
        ->leftjoin('tb_daftar_aplikasi','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.status_server'
        ,'tb_perangkat.tipe_perangkat','tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_daftar_aplikasi.ip_vps','tb_daftar_aplikasi.ip_public','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_hdd.keterangan','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->get(); 
    	$pdf = PDF::loadview('cetak_seluruh',['pegawai'=>$pegawai]);
    	return $pdf->stream('laporan-pegawai-pdf');
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
        if($id){
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
        }else{
            
        }
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
