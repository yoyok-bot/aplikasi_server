<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\DaftarAplikasi;
use App\Perangkat;

class DaftarAplikasiController extends Controller
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
        $data_aplikasi = DB::table('tb_daftar_aplikasi')
                    ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
                    ->select('tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi'
                    ,'tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
                    ->get();
        return view('Aplikasi.dashboard',compact('data_aplikasi'));
    }

    public function tableaplikasi()
    {
        return DataTables::of(DB::table('tb_daftar_aplikasi')
        ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
        ->select('tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi'
        ,'tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
        ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_aplikasi . '" class="hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i> Delete</a>';
                $edit = '<a href="' . route('data_aplikasi.edit', $data->id_aplikasi) . '" style="font-size: 15px"><i class="fa fa-edit"></i> Edit</a>';
                return $edit . '&nbsp' . ' | ' . '&nbsp' . $del;
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
        $data_perangkat = Perangkat::all();
        return view('Aplikasi.create',compact('data_perangkat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DaftarAplikasi::create($request->all());
        return redirect()->route('data_aplikasi.index')->with(['success' => 'Berhasil Disimpan']);
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
        $data_perangkat = Perangkat::all();
        $data_aplikasi = DB::table('tb_daftar_aplikasi')
                    ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_daftar_aplikasi.id_perangkat')
                    ->select('tb_daftar_aplikasi.id_aplikasi','tb_daftar_aplikasi.nama_aplikasi','tb_daftar_aplikasi.id_perangkat'
                    ,'tb_perangkat.id_perangkat','tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
                    ->where('tb_daftar_aplikasi.id_aplikasi',$id)->first();
        return view('Aplikasi.edit',compact('data_aplikasi','data_perangkat'));
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
        $aplikasi = DaftarAplikasi::find($id);
        $aplikasi->nama_aplikasi = $request->get('nama_aplikasi');
        $aplikasi->id_perangkat = $request->get('id_perangkat');
        $aplikasi->update();
        return redirect()->route('data_aplikasi.index')->with(['success' => 'Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DaftarAplikasi::destroy($id);
    }
}
