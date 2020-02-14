@extends('layouts.master')
@section('header')
    Tambah Data
@endsection
@section('home')
    home
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
              <form role="form" action="{{route('data_hdd.store')}}" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="ukuran_hdd">Ukuran Hdd</label>
                    <input type="number" class="form-control" name="ukuran_hdd" placeholder="Ukuran Hdd">
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