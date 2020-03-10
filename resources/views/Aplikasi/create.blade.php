@extends('layouts.master')
@section('header')
    Tambah Data
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
              <form role="form" action="{{route('data_aplikasi.store')}}" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_aplikasi">Nama Aplikasi</label>
                    <input type="text" class="form-control" name="nama_aplikasi" value="{{old('nama_aplikasi')}}" placeholder="Nama Aplikasi">
                    @if ($errors->any())
                        {!! $errors->first('nama_aplikasi', '<p style="font-size: 12px; color:red">ERROR! input Nama Aplikasi Harus Diisi </p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ip_vps">Ip Vps</label>
                    <input type="text" class="form-control" name="ip_vps" value="{{old('id_vps')}}" placeholder="Ip Vps">
                    @if ($errors->any())
                        {!! $errors->first('ip_vps', '<p style="font-size: 12px; color:red">ERROR! input Ip Server Tidak Boleh Sama</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="ip_public">Ip Public</label>
                    <input type="text" class="form-control" name="ip_public" value="{{old('ip_public')}}" placeholder="Ip Public">
                    @if ($errors->any())
                        {!! $errors->first('ip_public', '<p style="font-size: 12px; color:red">ERROR! input Ip Public Tidak Boleh Sama</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="id_perangkat">Nama Perangkat</label>
                    <select id="perangkat" class="form-control" name="id_perangkat">
                    <option>Pilih Nama Perangkat</option>
                    @foreach ($data_perangkat as $perangkat)
                    <option value="{{ $perangkat->id_perangkat }}" {{ old('id_perangkat') == $perangkat->id_perangkat ? 'selected="selected"' : '' }}> Nama Perangkat : {{ $perangkat->nama_perangkat }} || Ip Server : {{ $perangkat->ip_server }}</option>
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
@push('script')
<script>
  $(document).ready(function() {
    $('#perangkat').select2();
});
</script>
@endpush