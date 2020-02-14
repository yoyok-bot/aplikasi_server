@extends('layouts.master')
@section('header')
    Data Rak
@endsection
@section('home')
    Home
@endsection
@section('page')
    Data
@endsection
@section('content')
    <div class="col-sm-12">
        <a href="{{route('data_rak.create')}}" class="btn btn-primary float-right">Tambah Data</a>
    </div>
    <br>
    <br>
<div class="box-body">
    <div class="table-responsive-sm">
        <table id="table1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomer Rak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($data_rak as $rak)
                <tr>
                <td>{{$i}}</td>
                <td>{{$rak->nomer_rak}}</td>
                <td>
                    <div class="row">
                    <form action="{{route('data_rak.edit', $rak->id_rak)}}">
                        <button type="submit" class="btn"><i class="fa fa-edit"></i></button>
                    </form>
                    <form action="{{route('data_rak.destroy', $rak->id_rak)}}" method="POST">
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