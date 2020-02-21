<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ram;
use Yajra\DataTables\DataTables;

class RamController extends Controller
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
        $data_ram = Ram::all();
        return view('Ram.dashboard', compact('data_ram'));
    }
    public function tableram()
    {
        return DataTables::of(Ram::all())
            ->addColumn('action', function ($data) {
                $del = '<a href="#" data-id="' . $data->id_ram . '" class="hapus-data" style="font-size: 15px"><i class="fa fa-trash"></i> Delete</a>';
                $edit = '<a href="' . route('data_ram.edit', $data->id_ram) . '" style="font-size: 15px"><i class="fa fa-edit"></i> Edit</a>';
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
       return view('Ram.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ram::create($request->all());
        return redirect()->route('data_ram.index')->with(['success' => 'Berhasil Disimpan']);
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
        $ram = ram::all()->where('id_ram',$id)->first();
        return view('Ram.edit', compact('ram'));
        // return $ram;
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
        $ram = Ram::find($id);
        $ram->ukuran_ram = $request->get('ukuran_ram');
        $ram->update();
        return redirect()->route('data_ram.index')->with(['success' => 'Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ram::destroy($id);
    }
}
