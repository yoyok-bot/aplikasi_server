@extends('layouts.master')
@section('header')
    Tambah Data
@endsection
@section('home')
<a href="{{route('data_ram.index')}}">Kembali</a>
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
              <form role="form" action="{{route('data_ram.store')}}" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="ukuran_ram">Ukuran Ram</label>
                    <input type="text" class="form-control" name="ukuran_ram" value="{{old('ukuran_ram')}}" placeholder="Ukuran Ram">
                    @if ($errors->any())
                        {!! $errors->first('ukuran_ram', '<p style="font-size: 12px; color:red">ERROR! input Ukuran Ram Harus Berupa Angka / Tidak Boleh Sama</p>') !!}
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