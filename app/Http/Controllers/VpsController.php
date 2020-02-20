<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Vps;
use App\Perangkat;

class VpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_vps = DB::table('tb_vps')
                    ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_vps.id_perangkat')
                    ->select('tb_vps.id_vps','tb_vps.ip_vps','tb_vps.ip_public'
                    ,'tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
                    ->get();
        return view('Vps.dashboard',compact('data_vps'));
    }

    public function tablevps()
    {
        return DataTables::of(DB::table('tb_vps')
        ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_vps.id_perangkat')
        ->select('tb_vps.id_vps','tb_vps.ip_vps','tb_vps.ip_public'
        ,'tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
        ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_vps . '" class="hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i> Delete</a>';
                $edit = '<a href="' . route('data_vps.edit', $data->id_vps) . '" style="font-size: 15px"><i class="fa fa-edit"></i> Edit</a>';
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
        return view('Vps.create',compact('data_perangkat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vps::create($request->all());
        return redirect()->route('data_vps.index')->with(['success' => 'Berhasil Disimpan']);
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
        $data_vps = DB::table('tb_vps')
                    ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_vps.id_perangkat')
                    ->select('tb_vps.id_vps','tb_vps.ip_vps','tb_vps.ip_public','tb_vps.id_perangkat'
                    ,'tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
                    ->where('tb_vps.id_vps',$id)->first();
        return view('Vps.edit',compact('data_vps','data_perangkat'));
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
        $vps = Vps::find($id);
        $vps->ip_vps = $request->get('ip_vps');
        $vps->ip_public = $request->get('ip_public');
        $vps->id_perangkat = $request->get('id_perangkat');
        $vps->update();
        return redirect()->route('data_vps.index')->with(['success' => 'Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vps::destroy($id);
    }
}
