@extends('layouts.master')
@section('header')
    Edit Data
@endsection
@section('home')
<a href="{{route('data_perangkat.index')}}">Kembali</a>
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
              <form role="form" action="{{route('data_server.update',$data_server->id_server)}}" method="POST">
              {{method_field('put')}}
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="ip_server">Ip Server</label>
                    <input type="text" class="form-control" name="ip_server" value="{{$data_server->ip_server}}">
                  </div>
                  <div class="form-group">
                    <label for="id_vps">Ip Vps</label>
                    <select class="form-control" name="id_vps">
                    <option>Pilih Ip Vps</option>
                    @foreach ($data_vps as $vps)
                    <option value="{{ $vps->id_vps }}" {{ $data_server->id_vps == $vps->id_vps ? 'selected="selected"' : '' }}> {{ $vps->ip_vps }}</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="id_perangkat">Nama Perangkat</label>
                    <select class="form-control" name="id_perangkat">
                    <option>Pilih Ip Vps</option>
                    @foreach ($data_perangkat as $perangkat)
                    <option value="{{ $perangkat->id_perangkat }}" {{ $data_server->id_perangkat == $perangkat->id_perangkat ? 'selected="selected"' : '' }}> {{ $perangkat->nama_perangkat }} (Tipe : {{$perangkat->tipe_perangkat}} & Kepemilikan : {{$perangkat->status_kepemilikan}} )</option>
                    @endforeach    
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">Status Server</label>
                    <select class="form-control" name="status">
                    <option value="Aktif" {{ $data_server->status == 'Aktif' ? 'selected="selected"' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ $data_server->status == 'Tidak Aktif' ? 'selected="selected"' : '' }}>Tidak Aktif</option>
                    <option value="Rusak" {{ $data_server->status == 'Rusak' ? 'selected="selected"' : '' }}>Rusak</option>
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