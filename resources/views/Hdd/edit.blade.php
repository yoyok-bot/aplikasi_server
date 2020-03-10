@extends('layouts.master')
@section('header')
    Edit Data
@endsection
@section('home')
<a href="{{route('data_hdd.index')}}">Kembali</a>
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
              <form role="form" action="{{ route('data_hdd.update',$hdd->id_hdd)}}" method="POST">
              {{method_field('put')}}
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="ukuran_hdd">Kapasitas Hdd</label>
                    <input type="text" class="form-control" name="ukuran_hdd" value="{{$hdd->ukuran_hdd}}">
                    @if ($errors->any())
                        {!! $errors->first('ukuran_hdd', '<p style="font-size: 12px; color:red">ERROR! input Kapasitas Harus Berupa Angka / Tidak Boleh Sama</p>') !!}
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Keterangan(GB/TERA)</label>
                    <input type="text" class="form-control" name="keterangan" value="{{$hdd->keterangan}}">
                    @if ($errors->any())
                        {!! $errors->first('keterangan', '<p style="font-size: 12px; color:red">ERROR! input Keterangan Harus Disisi</p>') !!}
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