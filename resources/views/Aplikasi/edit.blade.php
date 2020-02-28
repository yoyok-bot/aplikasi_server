@extends('layouts.master')
@section('header')
    Edit Data
@endsection
@section('home')
<a href="{{route('data_aplikasi.index')}}">Kembali</a>
@endsection
@section('page')
    Data Aplikasi
@endsection
@section('content')
<div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('data_aplikasi.update',$data_aplikasi->id_aplikasi)}}" method="POST">
              {{method_field('put')}}
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_aplikasi">Nama Aplikasi</label>
                    <input type="text" class="form-control" name="nama_aplikasi" value="{{$data_aplikasi->nama_aplikasi}}">
                    @if ($errors->any())
                        {!! $errors->first('nama_aplikasi', '<p style="font-size: 12px; color:red">ERROR! input Nama Aplikasi Harus Diisi</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ip_vps">Ip Vps</label>
                    <input type="text" class="form-control" name="ip_vps" value="{{$data_aplikasi->ip_vps}}">
                    @if ($errors->any())
                        {!! $errors->first('ip_vps', '<p style="font-size: 12px; color:red">ERROR! input Ip Vps Harus Diisi</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ip_public">Ip Public</label>
                    <input type="text" class="form-control" name="ip_public" value="{{$data_aplikasi->ip_public}}">
                    @if ($errors->any())
                        {!! $errors->first('ip_public', '<p style="font-size: 12px; color:red">ERROR! input Ip Public Harus Diisi</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="id_perangkat">Nama Perangkat</label>
                    <select class="form-control" name="id_perangkat">
                    <option>Pilih Nama Perangkat</option>
                    @foreach ($data_perangkat as $perangkat)
                    <option value="{{ $perangkat->id_perangkat }}" {{ $perangkat->id_perangkat == $data_aplikasi->id_perangkat ? 'selected="selected"' : '' }}> {{ $perangkat->nama_perangkat }} (Tipe : {{ $perangkat->tipe_perangkat }} & Kepemilikan : {{ $perangkat->status_kepemilikan }})</option>
                    @endforeach    
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection