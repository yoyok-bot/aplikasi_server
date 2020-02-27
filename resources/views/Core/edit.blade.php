@extends('layouts.master')
@section('header')
    Edit Data
@endsection
@section('home')
<a href="{{route('data_core.index')}}">Kembali</a>
@endsection
@section('page')
    Data Core
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
              <form role="form" action="{{ route('data_core.update',$core->id_core)}}" method="POST">
              {{method_field('put')}}
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="jumlah_core">Jumlah Core</label>
                    <input type="text" class="form-control" name="jumlah_core" value="{{$core->jumlah_core}}">
                    @if ($errors->any())
                        {!! $errors->first('jumlah_core', '<p style="font-size: 12px; color:red">ERROR! input Jumlah Core Harus Berupa Angka</p>') !!}
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