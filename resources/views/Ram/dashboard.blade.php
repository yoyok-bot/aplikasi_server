@extends('layouts.master')
@section('header')
    Data Ram
@endsection
@section('home')
    Home
@endsection
@section('page')
    Data
@endsection
@section('content')
    <div class="col-sm-12">
        <a href="{{route('data_ram.create')}}" class="btn btn-primary float-right">Tambah Data</a>
    </div>
    <br>
    <br>
<div class="box-body">
    <div class="table-responsive-sm">
        <table id="table1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th >No</th>
                <th >Ukuran</th>
                <th >Aksi</th>
            </tr>
            </thead>
            @php($i=1)
            @foreach($data_ram as $ram)
            <tbody>
            <tr>
                <td>{{$i}}</td>
                <td>{{$ram->ukuran_ram}}</td>
                <td>
                    <div class="row">
                    <form action="{{route('data_ram.edit', $ram->id_ram)}}">
                    <button type="submit" class="btn"><i class="fa fa-edit"></i></button>
                    </form>
                    <br>
                    <form action="{{route('data_ram.destroy', $ram->id_ram)}}" method="POST">
                    {{method_field('delete')}}
                    @csrf
                    <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                    </form>
                    </div>
                </td>
            </tr>
            </tbody>
            @php($i++)
            @endforeach
        </table>
    </div>
        @endsection