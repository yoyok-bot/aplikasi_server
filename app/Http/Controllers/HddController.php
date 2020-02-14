<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hdd;
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
        return redirect()->route('data_hdd.index');
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
        $hdd->update();
        return redirect()->route('data_hdd.index');
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
        return redirect()->route('data_hdd.index');
    }
}
