@extends('layouts.master')
@section('header')
    Data Detail Perangkat
@section('home')
<a href="{{route('data_perangkat.index')}}">Kembali</a>
@endsection
@section('page')
    Data Detail
@endsection
@section('content')
@php($i=1)
  <div class="row">
    <div class="col-md-6">
      <div class="box-body">
        <div class="table-responsive-sm">
          <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center">{{$detail_perangkat->nama}}</h3>
                <p class="text-muted text-center">{{$detail_perangkat->tipe_perangkat}}</p>
                <p class="text-muted text-center">{{$detail_perangkat->status_kepemilikan}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Ukuran Hdd</b> <a class="float-right">{{$detail_perangkat->ukuran_hdd}} ({{$detail_perangkat->keterangan}})</a>
                  </li>
                  <li class="list-group-item">
                    <b>Ukuran Ram</b> <a class="float-right">{{$detail_perangkat->ukuran_ram}} (GB)</a>
                  </li>
                  <li class="list-group-item">
                    <b>Jumlah Core</b> <a class="float-right">{{$detail_perangkat->jumlah_core}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nomer Rak</b> <a class="float-right">{{$detail_perangkat->nomer_rak}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Ip Server</b> <a class="float-right">{{$detail_perangkat->ip_server}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Status Server</b> <a class="float-right">{{$detail_perangkat->status_server}}</a>
                  </li>
                </ul>
              </div>
            </div>
    </div>
    </div>
    </div>
    </div>
    @php($i++)
    @endsection