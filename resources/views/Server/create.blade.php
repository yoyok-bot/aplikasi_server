@extends('layouts.master')
@section('header')
    Tambah Data
@endsection
@section('home')
<a href="{{route('data_server.index')}}">Kembali</a>
@endsection
@section('page')
    Data Server
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
              <form role="form" action="{{route('data_server.store')}}" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="ip_server">Ip Server</label>
                    <input type="text" class="form-control" name="ip_server" placeholder="Ip Server">
                  </div>
                  <div class="form-group">
                    <label for="id_vps">Ip Vps</label>
                    <select class="form-control" name="id_vps">
                    <option>Pilih Ip Vps</option>
                    @foreach ($data_vps as $vps)
                    <option value="{{ $vps->id_vps }}"> {{ $vps->ip_vps }}</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_perangkat">Nama Perangkat</label>
                    <select class="form-control" name="id_perangkat">
                    <option>Pilih Nama Perangkat</option>
                    @foreach ($data_perangkat as $perangkat)
                    <option value="{{ $perangkat->id_perangkat }}"> {{ $perangkat->nama_perangkat }} (Tipe : {{ $perangkat->tipe_perangkat }} & Kepemilikan : {{ $perangkat->status_kepemilikan }})</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">Status Server</label>
                    <select class="form-control" name="status">
                    <option>Pilih Status Server</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Rusak">Rusak</option>
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