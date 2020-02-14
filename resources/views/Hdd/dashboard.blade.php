@extends('layouts.master')
@section('header')
    Data Hdd
@endsection
@section('home')
    Home
@endsection
@section('page')
    Data
@endsection
@section('content')
    <div class="col-sm-12">
        <a href="" class="btn btn-primary float-right">Tambah Data</a>
    </div>
    <br>
    <br>
<div class="box-body">
    <div class="table-responsive-sm">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ukuran</th>
                    <th>Sunting</th>
                </tr>
            </thead>
            @php($i=1)
            @foreach($data_hdd as $hdd)
            <tbody>
                <tr>
                    <td >{{$i}}</td>
                    <td>{{}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection