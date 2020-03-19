<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Core;

class CoreController extends Controller
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
        $data_core = Core::all();
        return view('Core.dashboard', compact('data_core'));
    }

    public function tablecore()
    {
        return DataTables::of(Core::all())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_core . '" class="hapus-data" style="font-size: 15px"><i style="color:#d9534f" class="fa fa-trash"></i></a>';
                $edit = '<a href="' . route('data_core.edit', $data->id_core) . '" style="font-size: 15px"><i style="color:#5cb85c" class="fa fa-edit"></i></a>';
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
        return view('Core.create');
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
            'jumlah_core' => 'unique:tb_core|required'
        ]);
        Core::create($request->all());
        return redirect()->route('data_core.index')->with(['success' => 'Berhasil Disimpan']);
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
        $core = Core::all()->where('id_core',$id)->first();
        return view('Core.edit', compact('core'));
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
        $core = Core::find($id);
        $core->jumlah_core = $request->get('jumlah_core');
        $core->update();
        return redirect()->route('data_core.index')->with(['success' => 'Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Core::destroy($id);
    }
}
