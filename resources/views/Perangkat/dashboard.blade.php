@extends('layouts.master')
@section('header')
    Data Perangkat
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
        <a href="{{route('data_perangkat.create')}}" class="btn btn-primary float-right">Tambah Data</a>
    </div>
    <br>
    <br>
<div class="box-body">
    <div class="table-responsive-sm">
        <table id="table1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th >No</th>
                <th >Nama Perangkat</th>
                <th >Status Kepemilikan</th>
                <th >Ip Server</th>
                <th >Aksi</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Perangkat </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table borderless">
                            <tr>
                                <th>Nama Perangkat</th>
                                <td><p id="nama_perangkat" style="text-transform: capitalize"></td>
                            </tr>
                            <tr>
                                <th>Tipe Perangkat</th>
                                <td><p id="tipe_perangkat"></td>
                            </tr>
                            <tr>
                                <th>Jumlah Core</th>
                                <td><p id="jumlah_core"></td>
                            </tr>
                            <tr>
                                <th>Ukuran Ram</th>
                                <td id="ukuran_ram" ></td>
                            </tr>
                            <tr>
                                <th>Ukuran Hdd</th>
                                <td id="ukuran_hdd"></td>
                            </tr>
                            <tr>
                                <th>Ip Server</th>
                                <td id="ip_server"></td>
                            </tr>
                            <tr>
                                <th>Kepemilikan</th>
                                <td id="status_kepemilikan"></td>
                            </tr>
                        </table>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        @endsection
        @push('script')
<script>
            $(document).ready(function () {
                var dt = $('#table1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{route('table.perangkat')}}',
                    "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1)
			},
                    columns: [{
                        data: 'id_perangkat',
                        name: 'id_perangkat'
                    },
                    {
                            data: 'nama_perangkat',
                            name: 'nama_perangkat'
                        },
                        {
                            data: 'status_kepemilikan',
                            name: 'status_kepemilikan'
                        },
                        {
                            data: 'ip_server',
                            name: 'ip_server'
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                    ],
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
                                url: "data_perangkat/" + id+"/delete",
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
            $('#list').change(function () {
                document.location.href = '{{route('index')}}?id=' + $('#list').val();
            });
            $('body').on("click", '.show-detail', function (e) {
            $('#myModal').modal("show");
            $.get("/anyData/" + $(this).attr('data-id'), function (data) {
                console.log(data);
                $('#nama_perangkat').text(': ' +data.nama_perangkat);
                $('#tipe_perangkat').text(': ' +data.tipe_perangkat);
                $('#jumlah_core').text(': ' +data.jumlah_core);
                $('#ukuran_ram').text(': ' +data.ukuran_ram+' GB');
                $('#ukuran_hdd').text(': ' +data.ukuran_hdd+' '+data.keterangan);
                $('#ip_server').text(': ' +data.ip_server);
                $('#status_kepemilikan').text(': ' +data.status_kepemilikan);
            });
        });
        </script>
@endpush