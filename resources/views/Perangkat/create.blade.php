@extends('layouts.master')
@section('header')
    Tambah Data
@endsection
@section('home')
<a href="{{route('data_perangkat.index')}}">Kembali</a>
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
              <form role="form" action="{{route('data_perangkat.store')}}" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_perangkat">Nama Perangkat</label>
                    <input type="text" class="form-control" name="nama_perangkat" value="{{old('nama_perangkat')}}" placeholder="Nama perangkat">
                    @if ($errors->any())
                        {!! $errors->first('nama_perangkat', '<p style="font-size: 12px; color:red">ERROR! input Nama Perangkat Harus Diisi</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="tipe_perangkat">Tipe Perangkat</label>
                    <input type="text" class="form-control" name="tipe_perangkat" value="{{old('tipe_perangkat')}}" placeholder="Tipe Perangkat">
                    @if ($errors->any())
                        {!! $errors->first('tipe_perangkat', '<p style="font-size: 12px; color:red">ERROR! input Tipe Perangkat Harus Diisi</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="status_kepemilikan">Satus Kepemilikan</label>
                    <input type="text" class="form-control" name="status_kepemilikan" value="{{old('status_kepemilikan')}}" placeholder="Status Kepemilikan">
                    @if ($errors->any())
                        {!! $errors->first('status_kepemilikan', '<p style="font-size: 12px; color:red">ERROR! input Status Kepemilikan Harus Diisi</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ip_server">Ip Server (192.168.99.01)</label>
                    <input type="text" class="form-control" name="ip_server" value="{{old('ip_server')}}" placeholder="Ip_Server">
                    @if ($errors->any())
                        {!! $errors->first('ip_server', '<p style="font-size: 12px; color:red">ERROR! input Ip Server Tidak Boleh Sama</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="status" value="Aktif">
                  </div>
                  <div class="form-group">
                    <label for="id_hdd">Ukuran Hdd</label>
                    <select class="form-control" name="id_hdd">
                    <option>Pilih Hdd</option>
                    @foreach ($data_hdd as $hdd)
                    <option value="{{ $hdd->id_hdd }}"> {{ $hdd->ukuran_hdd }} ({{$hdd->keterangan}})</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_ram">Ukuran Ram</label>
                    <select class="form-control" name="id_ram">
                    <option>Pilih Ram</option>
                    @foreach ($data_ram as $ram)
                    <option value="{{ $ram->id_ram }}"> {{ $ram->ukuran_ram }}</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nomer_rak">Nomer Rak</label>
                    <select class="form-control" name="id_rak">
                    <option>Pilih Rak</option>
                    @foreach ($data_rak as $rak)
                    <option value="{{ $rak->id_rak }}"> {{ $rak->nomer_rak }}</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="jumlah_core">Jumlah Core</label>
                    <select class="form-control" name="id_core">
                    <option>Pilih Rak</option>
                    @foreach ($data_core as $core)
                    <option value="{{ $core->id_core }}"> {{ $core->jumlah_core }}</option>
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