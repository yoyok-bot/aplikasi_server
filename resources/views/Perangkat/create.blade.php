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
                    <label for="status_kepemilikan">Status Kepemilikan</label>
                    <select class="form-control" name="status_kepemilikan" id="status_kepemilikan">
                    <option value=" ">Pilih</option>
                    <option value="1">KOMINFO</option>
                    <option value="2">COLOCATION</option>
                    </select>
                    @if ($errors->any())
                        {!! $errors->first('status_kepemilikan', '<p style="font-size: 12px; color:red">ERROR! Harus Dipilih Salah satu</p>') !!}
                    @endif
                    <div id="div-co" style="display:none" class="form-group">
                    <label for="nama_instansi">INSTANSI</label>
                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi">
                  </div>
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
                    <label for="id_hdd">Kapasitas HDD</label>
                    <select id="hdd" class="form-control" name="id_hdd">
                    <option value=" ">Pilih Hdd</option>
                    @foreach ($data_hdd as $hdd)
                    <option value="{{ $hdd->id_hdd }}" {{ old('id_hdd') == $hdd->id_hdd ? 'selected="selected"' : '' }}> {{ $hdd->ukuran_hdd }} ({{$hdd->keterangan}})</option>
                    @endforeach    
                    </select>
                    @if ($errors->any())
                        {!! $errors->first('id_hdd', '<p style="font-size: 12px; color:red">ERROR! Harus Dipilih Salah satu</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="id_ram">Kapasitas RAM</label>
                    <select id="ram" class="form-control" name="id_ram">
                    <option value=" ">Pilih Ram</option>
                    @foreach ($data_ram as $ram)
                    <option value="{{ $ram->id_ram }}" {{ old('id_ram') == $ram->id_ram ? 'selected="selected"' : '' }}> {{ $ram->ukuran_ram }} (GB)</option>
                    @endforeach    
                    </select>
                    @if ($errors->any())
                        {!! $errors->first('id_ram', '<p style="font-size: 12px; color:red">ERROR! Harus Dipilih Salah satu</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="nomer_rak">Nomer Rak</label>
                    <select id="rak" class="form-control" name="id_rak">
                    <option value=" ">Pilih Rak</option>
                    @foreach ($data_rak as $rak)
                    <option value="{{ $rak->id_rak }}" {{ old('id_rak') == $rak->id_rak ? 'selected="selected"' : '' }}> {{ $rak->nomer_rak }}</option>
                    @endforeach    
                    </select>
                    @if ($errors->any())
                        {!! $errors->first('id_rak', '<p style="font-size: 12px; color:red">ERROR! Harus Dipilih Salah satu</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="jumlah_core">Jumlah Core</label>
                    <select id="core" class="form-control" name="id_core">
                    <option value=" ">Pilih Core</option>
                    @foreach ($data_core as $core)
                    <option value="{{ $core->id_core }}" {{ old('id_core') == $core->id_core ? 'selected="selected"' : '' }}> {{ $core->jumlah_core }}</option>
                    @endforeach    
                    </select>
                    @if ($errors->any())
                        {!! $errors->first('id_core', '<p style="font-size: 12px; color:red">ERROR! Harus Dipilih Salah satu</p>') !!}
                    @endif
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
  $("#status_kepemilikan").change(function(){
    var id = $(this).val();
    if(id==2){
      $('#div-co').show();
      $('#nama_instansi').val("COLOCATION/");
    } else {
      $('#div-co').hide();
      $('#nama_instansi').val("");
    }
  });
  $(document).ready(function() {
    $('#hdd').select2();
    $('#ram').select2();
    $('#rak').select2();
    $('#core').select2();
});
  </script>
@endpush