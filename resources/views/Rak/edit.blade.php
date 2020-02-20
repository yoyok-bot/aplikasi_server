@extends('layouts.master')
@section('header')
    Edit Data
@endsection
@section('home')
<a href="{{route('data_rak.index')}}">Kembali</a>
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
              <form role="form" action="{{ route('data_rak.update',$rak->id_rak)}}" method="POST">
              {{method_field('put')}}
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nomer_rak">Nomer Rak</label>
                    <input type="number" class="form-control" name="nomer_rak" value="{{$rak->nomer_rak}}">
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