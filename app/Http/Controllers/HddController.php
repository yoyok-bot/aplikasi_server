<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hdd;
use Yajra\DataTables\DataTables;

class HddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_hdd = Hdd::all();
        return view('Hdd.dashboard', compact('data_hdd'));
    }

    public function tablehdd()
    {
        return DataTables::of(Hdd::all())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_hdd . '" class="hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i> Delete</a>';
                $edit = '<a href="' . route('data_hdd.edit', $data->id_hdd) . '" style="font-size: 15px"><i class="fa fa-edit"></i> Edit</a>';
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
        return view('Hdd.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Hdd::create($request->all());
        return redirect()->route('data_hdd.index')->with(['success' => 'Berhasil Disimpan']);
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
        $hdd = Hdd::all()->where('id_hdd',$id)->first();
        return view('Hdd.edit', compact('hdd'));
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
        $hdd = Hdd::find($id);
        $hdd->ukuran_hdd = $request->get('ukuran_hdd');
        $hdd->keterangan = $request->get('keterangan');
        $hdd->update();
        return redirect()->route('data_hdd.index')->with(['success' => 'Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hdd::destroy($id);
    }
}
