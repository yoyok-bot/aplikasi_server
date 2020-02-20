<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rak;
use Yajra\DataTables\DataTables;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Rak.dashboard');
    }
    public function tablerak()
    {
        return DataTables::of(Rak::all())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_rak . '" class="hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i> Delete</a>';
                $edit = '<a href="' . route('data_rak.edit', $data->id_rak) . '" style="font-size: 15px"><i class="fa fa-edit"></i> Edit</a>';
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
        return view('Rak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Rak::create($request->all());
        return redirect()->route('data_rak.index')->with(['success' => 'Berhasil Disimpan']);
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
        $rak = Rak::all()->where('id_rak',$id)->first();
        return view('Rak.edit', compact('rak'));
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
        $rak = Rak::find($id);
        $rak->nomer_rak = $request->get('nomer_rak');
        $rak->update();
        return redirect()->route('data_rak.index')->with(['success' => 'Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rak::destroy($id);
    }
}
