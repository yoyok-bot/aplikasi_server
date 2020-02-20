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
                    <input type="text" class="form-control" name="nama_perangkat" placeholder="Nama perangkat">
                  </div>
                  <div class="form-group">
                    <label for="tipe_perangkat">Tipe Perangkat</label>
                    <input type="text" class="form-control" name="tipe_perangkat" placeholder="Tipe Perangkat">
                  </div>
                  <div class="form-group">
                    <label for="status_kepemilikan">Satus Kepemilikan</label>
                    <input type="text" class="form-control" name="status_kepemilikan" placeholder="Status Kepemilikan">
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
                    <select class="form-control" name="id_rak">
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