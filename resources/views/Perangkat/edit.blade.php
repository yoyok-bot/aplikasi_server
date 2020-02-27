@extends('layouts.master')
@section('header')
    Edit Data
@endsection
@section('home')
<a href="{{route('data_perangkat.index')}}">Kembali</a>
@endsection
@section('page')
    Data Ram
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
              <form role="form" action="{{route('data_perangkat.update', $data_perangkat->id_perangkat)}}" method="POST">
              {{method_field('put')}}
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_perangkat">Nama Perangkat</label>
                    <input type="text" class="form-control" name="nama_perangkat" value="{{$data_perangkat->nama_perangkat}}">
                  </div>
                  <div class="form-group">
                    <label for="tipe_perangkat">Tipe Perangkat</label>
                    <input type="text" class="form-control" name="tipe_perangkat" value="{{$data_perangkat->tipe_perangkat}}">
                  </div>
                  <div class="form-group">
                    <label for="status_kepemilikan">Status Kepemilikan</label>
                    <input type="text" class="form-control" name="status_kepemilikan" value="{{$data_perangkat->status_kepemilikan}}">
                  </div>
                  <div class="form-group">
                    <label for="ip_server">Ip Server</label>
                    <input type="text" class="form-control" name="ip_server" value="{{$data_perangkat->ip_server}}">
                    @if ($errors->any())
                        {!! $errors->first('ip_server', '<p style="font-size: 12px; color:red">ERROR! input Ip Server Harus Berupa Angka / Tidak Boleh Sama</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="status_server">Status Server</label>
                    <select class="form-control" name="status_server">
                    <option>Pilih Status Server</option>
                    <option value="Aktif" {{ $data_perangkat->status_server == 'Aktif' ? 'selected="selected"' : '' }}> Aktif</option>
                    <option value="Tidak Aktif" {{ $data_perangkat->status_server == 'Tidak Aktif' ? 'selected="selected"' : '' }}> Tidak Aktif</option>
                    <option value="Rusak" {{ $data_perangkat->status_server == 'Rusak' ? 'selected="selected"' : '' }}> Rusak</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_hdd">Ukuran Hdd</label>
                    <select class="form-control" name="id_hdd">
                    <option>Pilih Ukuran Hdd</option>
                    @foreach ($data_hdd as $hdd)
                    <option value="{{ $hdd->id_hdd }}" {{ $data_perangkat->id_hdd == $hdd->id_hdd ? 'selected="selected"' : '' }}> {{ $hdd->ukuran_hdd }} ({{$hdd->keterangan}})</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_ram">Ukuran Ram</label>
                    <select class="form-control" name="id_ram">
                    <option>Pilih Ukuran Ram</option>
                    @foreach ($data_ram as $ram)
                    <option value="{{ $ram->id_ram }}" {{ $data_perangkat->id_ram == $ram->id_ram ? 'selected="selected"' : '' }}> {{ $ram->ukuran_ram }} (GB)</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_rak">Nomer Rak</label>
                    <select class="form-control" name="id_rak">
                    <option>Pilih Nomer Rak</option>
                    @foreach ($data_rak as $rak)
                    <option value="{{ $rak->id_rak }}" {{ $data_perangkat->id_rak == $rak->id_rak ? 'selected="selected"' : '' }}> {{ $rak->nomer_rak }}</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_core">Jumlah Core</label>
                    <select class="form-control" name="id_core">
                    <option>Pilih Jumlah Core</option>
                    @foreach ($data_core as $core)
                    <option value="{{ $core->id_core }}" {{ $data_perangkat->id_core == $core->id_core ? 'selected="selected"' : '' }}> {{ $core->jumlah_core }}</option>
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