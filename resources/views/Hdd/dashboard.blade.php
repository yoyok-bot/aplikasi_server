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
        <a href="{{route('data_hdd.create')}}" class="btn btn-primary float-right">Tambah Data</a>
    </div>
    <br>
    <br>
<div class="box-body">
    <div class="table-responsive-sm">
        <table id="table1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($data_hdd as $hdd)
                <tr>
                <td>{{$i}}</td>
                <td>{{$hdd->ukuran_hdd}}</td>
                <td>
                    <div class="row">
                    <form action="{{route('data_hdd.edit', $hdd->id_hdd)}}">
                        <button type="submit" class="btn"><i class="fa fa-edit"></i></button>
                    </form>
                    <form action="{{route('data_hdd.destroy', $hdd->id_hdd)}}" method="POST">
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
</div>
@endsection