<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Server;
use App\Perangkat;
use App\Vps;

class ServerController extends Controller
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
        $data_server = DB::table('tb_server')
                    ->join('tb_vps','tb_vps.id_vps','=','tb_server.id_vps')
                    ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_server.id_perangkat')
                    ->select('tb_server.id_server','tb_server.ip_server','tb_server.status'
                    ,'tb_vps.ip_vps','tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
                    ->get();
        return view('Server.dashboard',compact('data_server'));
    }

    public function tableserver()
    {
        return DataTables::of(DB::table('tb_server')
        ->join('tb_vps','tb_vps.id_vps','=','tb_server.id_vps')
        ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_server.id_perangkat')
        ->select('tb_server.id_server','tb_server.ip_server','tb_server.status'
        ,'tb_vps.ip_vps','tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
        ->get())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_server . '" class="hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i> Delete</a>';
                $edit = '<a href="' . route('data_server.edit', $data->id_server) . '" style="font-size: 15px"><i class="fa fa-edit"></i> Edit</a>';
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
        $data_vps = Vps::all();
        return view('Server.create',compact('data_perangkat','data_vps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Server::create($request->all());
        return redirect()->route('data_server.index')->with(['success' => 'Berhasil Disimpan']);
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
        $data_vps = Vps::all();
        $data_server = DB::table('tb_server')
                    ->join('tb_vps','tb_vps.id_vps','=','tb_server.id_vps')
                    ->join('tb_perangkat','tb_perangkat.id_perangkat','=','tb_server.id_perangkat')
                    ->select('tb_server.id_server','tb_server.ip_server','tb_server.status','tb_server.id_perangkat'
                    ,'tb_vps.ip_vps','tb_vps.id_vps','tb_perangkat.nama_perangkat','tb_perangkat.tipe_perangkat','tb_perangkat.status_kepemilikan')
                    ->where('tb_server.id_server',$id)->first();
        return view('Server.edit',compact('data_server','data_perangkat','data_vps'));
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
        $server = Server::find($id);
        $server->ip_server = $request->get('ip_server');
        $server->id_vps = $request->get('id_vps');
        $server->id_perangkat = $request->get('id_perangkat');
        $server->status = $request->get('status');
        $server->update();
        return redirect()->route('data_server.index')->with(['success' => 'Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Server::destroy($id);
    }
}
