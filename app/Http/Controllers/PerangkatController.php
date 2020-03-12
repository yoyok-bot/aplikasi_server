<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Perangkat;
use App\Ram;
use App\Hdd;
use App\Rak;
use App\Core;

class PerangkatController extends Controller
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
        $data_perangkat = Perangkat::all();
        return view('Perangkat.dashboard',compact('data_perangkat'));
    }

    public function tableperangkat()
    {
        return DataTables::of(Perangkat::all())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_perangkat . '" class="hapus-data" style="font-size: 15px"><i style="color:#d9534f" class="fa fa-trash"></i></a>';
                $edit = '<a href="' . route('data_perangkat.edit', $data->id_perangkat) . '" style="font-size: 15px"><i style="color:#5cb85c" class="fa fa-edit"></i></a>';
                $show = '<a href="#" data-id="' . $data->id_perangkat . '" class="show-detail" style="font-size: 15px"><i class="fa fa-eye"></i></a>';
                return $show . '&nbsp' . ' | ' . '&nbsp' . $edit . '&nbsp' . ' | ' . '&nbsp' . $del;
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_hdd = Hdd::all();
        $data_ram = Ram::all();
        $data_rak = Rak::all();
        $data_core = Core::all();
        return view('Perangkat.create',compact('data_hdd','data_ram','data_rak','data_core'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_perangkat' => 'required',
            'tipe_perangkat' => 'required',
            'status_kepemilikan' => 'required',
            'ip_server' => 'nullable|unique:tb_perangkat',
            'id_hdd' => 'required',
            'id_ram' => 'required',
            'id_rak' => 'required',
            'id_core' => 'required'
        ]);
        $nama_perangkat = $request->get('nama_perangkat');
        $tipe_perangkat = $request->get('tipe_perangkat');
        if($request->get('status_kepemilikan')==1){
            $status_kepemilikan = 'KOMINFO';
        } else {
            $status_kepemilikan = $request->get('nama_instansi');
        }
        $ip_server = $request->get('ip_server');
        $status = $request->get('status');
        $id_hdd = $request->get('id_hdd');
        $id_ram = $request->get('id_ram');
        $id_rak = $request->get('id_rak');
        $id_core = $request->get('id_core');
        $data = new Perangkat();
        $data->nama_perangkat=$nama_perangkat;
        $data->tipe_perangkat=$tipe_perangkat;
        $data->status_kepemilikan=$status_kepemilikan;
        $data->ip_server=$ip_server;
        $data->status_server=$status;
        $data->id_hdd=$id_hdd;
        $data->id_ram=$id_ram;
        $data->id_rak=$id_rak;
        $data->id_core=$id_core;
        $data->save();
        return redirect()->route('data_perangkat.index')->with(['success' => 'Berhasil Disimpan']);
    }
    public function anyData1($id)
    {
        $detail_perangkat = DB::table('tb_perangkat')
        ->join('tb_ram','tb_ram.id_ram','=','tb_perangkat.id_ram')
        ->join('tb_hdd','tb_hdd.id_hdd','=','tb_perangkat.id_hdd')
        ->join('tb_rak','tb_rak.id_rak','=','tb_perangkat.id_rak')
        ->join('tb_core','tb_core.id_core','=','tb_perangkat.id_core')
        ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat'
        ,'tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server','tb_perangkat.status_server'
        ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_hdd.keterangan','tb_rak.nomer_rak','tb_core.jumlah_core')
        ->where('tb_perangkat.id_perangkat',$id)->first();
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
        // show the view and pass the nerd to it
        $detail_perangkat = DB::table('tb_perangkat')
                    ->join('tb_ram','tb_ram.id_ram','=','tb_perangkat.id_ram')
                    ->join('tb_hdd','tb_hdd.id_hdd','=','tb_perangkat.id_hdd')
                    ->join('tb_rak','tb_rak.id_rak','=','tb_perangkat.id_rak')
                    ->join('tb_core','tb_core.id_core','=','tb_perangkat.id_core')
                    ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat as nama'
                    ,'tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server','tb_perangkat.status_server'
                    ,'tb_ram.ukuran_ram','tb_hdd.ukuran_hdd','tb_hdd.keterangan','tb_rak.nomer_rak','tb_core.jumlah_core')
                    ->where('tb_perangkat.id_perangkat',$id)->first();
        return view('Perangkat.detail',compact('detail_perangkat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_hdd = Hdd::all();
        $data_ram = Ram::all();
        $data_rak = Rak::all();
        $data_core = Core::all();
        $data_perangkat = DB::table('tb_perangkat')
                    ->join('tb_ram','tb_ram.id_ram','=','tb_perangkat.id_ram')
                    ->join('tb_hdd','tb_hdd.id_hdd','=','tb_perangkat.id_hdd')
                    ->join('tb_rak','tb_rak.id_rak','=','tb_perangkat.id_rak')
                    ->join('tb_core','tb_core.id_core','=','tb_perangkat.id_core')
                    ->select('tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat'
                    ,'tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan','tb_perangkat.ip_server','tb_perangkat.status_server'
                    ,'tb_ram.id_ram','tb_ram.ukuran_ram','tb_hdd.id_hdd','tb_hdd.ukuran_hdd','tb_rak.id_rak','tb_rak.nomer_rak','tb_core.id_core','tb_core.jumlah_core')
                    ->where('tb_perangkat.id_perangkat',$id)->first();
        return view('Perangkat.edit',compact('data_perangkat','data_hdd','data_ram','data_rak','data_core'));
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
        $request->validate([
            'nama_perangkat' => 'required',
            'tipe_perangkat' => 'required',
            'status_kepemilikan' => 'required',
            'ip_server' => 'nullable'
        ]);
        $perangkat = Perangkat::find($id);
        $perangkat->nama_perangkat = $request->get('nama_perangkat');
        $perangkat->tipe_perangkat = $request->get('tipe_perangkat');
        $perangkat->status_kepemilikan = $request->get('status_kepemilikan');
        $perangkat->ip_server = $request->get('ip_server');
        $perangkat->status_server = $request->get('status_server');
        $perangkat->id_hdd = $request->get('id_hdd');
        $perangkat->id_ram = $request->get('id_ram');
        $perangkat->id_rak = $request->get('id_rak');
        $perangkat->id_core = $request->get('id_core');
        $perangkat->update();
        return redirect()->route('data_perangkat.index')->with(['success' => 'Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Perangkat::destroy($id);
    }
}
