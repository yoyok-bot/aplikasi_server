@extends('layouts.master')
@section('header')
    Data Vps
@endsection
@section('home')
    Home
@endsection
@section('page')
    Data
@endsection
@section('content')
@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="col-sm-12">
        <a href="{{route('data_vps.create')}}" class="btn btn-primary float-right">Tambah Data</a>
    </div>
    <br>
    <br>
<div class="box-body">
    <div class="table-responsive-sm">
        <table id="table1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ip Vps</th>
                    <th>Ip Public</th>
                    <th>Nama Perangkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection
@push('script')
<script>
            $(document).ready(function () {
                var dt = $('#table1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{route('table.vps')}}',
                    columns: [{
                            data: 'id_vps',
                            name: 'id_vps(hai)'
                    },
                    {
                        data: 'ip_vps',
                        name: 'ip_vps'
                    },
                    {
                            data: 'ip_public',
                            name: 'ip_public'
                        },
                        {
                            data: 'nama_perangkat',
                            name: 'nama_perangkat'
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                    ]
                });
                var del = function (id) {
                    swal({
                        title: "Apakah anda yakin?",
                        text: "Anda tidak dapat mengembalikan data yang sudah terhapus!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Iya!",
                        cancelButtonText: "Tidak!",
                    }).then(
                        function (result) {
                            $.ajax({
                                url: "data_vps/" + id+"/delete",
                                method: "DELETE",
                            }).done(function (msg) {
                                dt.ajax.reload();
                                swal("Deleted!", "Data sudah terhapus.", "success");
                            }).fail(function (textStatus) {
                                alert("Request failed: " + textStatus);
                            });
                        }, function (dismiss) {
                            // dismiss can be 'cancel', 'overlay', 'esc' or 'timer'
                            swal("Cancelled", "Data batal dihapus", "error");
                        });
                };
                $('body').on('click', '.hapus-data', function () {
                    del($(this).attr('data-id'));
                });
            });
        </script>
@endpush