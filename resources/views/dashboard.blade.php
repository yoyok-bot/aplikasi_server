@extends('layouts.master')
@section('header')
    Data Seluruh
@endsection
@push('css')
<style>
.borderless td, .borderless th {
    padding:0px 20px 0px;
}
</style>
@endpush
@section('home')
    Home
@endsection
@section('page')
    Data
@endsection
@section('content')
@php
    $pilihan = 0;
    if (Request::has('id')){
        $pilihan = Request::get('id');
    }
@endphp
<br>
    <br>
<div class="container-fluid">
<div class="form-group row">
        <h2 class="card-inside-title" style="margin-top: 0px;margin-bottom: 0px">Tampilkan
            berdasarkan Rak :</h2>
    <div class="col-sm-1">
    <td><select name="keterangan" class="form-control show-tick" id="list">
    <option value="0">-</option>
    @foreach($data_rak as $rak)
    <option value="{{ $rak->id_rak }}" {{ $pilihan == $rak->id_rak ? 'selected="selected"' : '' }}> {{ $rak->nomer_rak }}</option>
    @endforeach
    </select></td>
    </div>
    </div>
</div>
<br>
@if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif
    <center>
    @if($pilihan==0)
    <a href="seluruh_rak/cetak_pdf_seluruh" class="btn btn-primary" target="_blank">CETAK PEANGKAT SELURUH</a>
    @else
    <a href="/cetak_rak/cetak_pdf_rak/{{$pilihan}}" class="btn btn-primary" target="_blank">CETAK ERANGKAT PER RAK</a>
    @endif
    </center>
    <br>
    <br>
    <div class="col-sm-12">
<div class="box-body">
    <div class="table-responsive-sm">
        <table id="table1" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th >No</th>
                <th >Nama Perangkat</th>
                <th >Kapasitas RAM</th>
                <th >Kapasitas HDD</th>
                <th >Status kepemilikan</th>
                <th >Status Server</th>
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
            <h5 class="modal-title">Tabel Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
                <div id="printThis" class="modal-body">
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
                                <th>Kapasitas RAM</th>
                                <td id="ukuran_ram" ></td>
                            </tr>
                            <tr>
                                <th>Kapasitas HDD</th>
                                <td id="ukuran_hdd"></td>
                            </tr>
                            <tr>
                                <th>Ip Server</th>
                                <td id="ip_server"></td>
                            </tr>
                            <tr>
                                <th>Ip Vps</th>
                                <td id="ip_vps"></td>
                            </tr>
                            <tr>
                                <th>Ip Public</th>
                                <td id="ip_public"></td>
                            </tr>
                            <tr>
                                <th>Nama Aplikasi</th>
                                <td id="nama_aplikasi"></td>
                            </tr>
                            <tr>
                                <th>Kepemilikan</th>
                                <td id="status_kepemilikan"></td>
                            </tr>
                        </table>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="#" id="print" target="_blank" class="btn btn-danger">Print Detail</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Aplikasi Server </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table borderless">
                            <tbody id="apk">
                            </tbody>
                        </table>
                    </div> 
                </div>
                <div class="modal-footer">
                    <a href="#" id="print2" target="_blank" class="btn btn-danger">Print Server</a>
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
                    ajax: '{{route('table.seluruh')}}?id={{$pilihan}}',
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
                            data: 'nama_aplikasi',
                            name: 'ukuran_ram'
                        },
                        {
                            data: 'ip_server',
                            name: 'ukuran_hdd'
                        },
                        {
                            data: 'status_kepemilikan',
                            name: 'status_kepemilikan'
                        },
                        {
                            data: 'status_server',
                            name: 'status_server'
                        },
                        {data: 'action', name: 'action', orderable: false, searchable: false, align: 'center'},
                    ]
                });
            });
            $('#list').change(function () {
                document.location.href = '{{route('index')}}?id=' + $('#list').val();
            });
            $('body').on("click", '.show-data', function (e) {
            $('#myModal').modal("show");
            $.get("/anyData/" + $(this).attr('data-id'), function (data) {
                console.log(data);
                $('#nama_perangkat').text(': ' +data.nama_perangkat);
                $('#tipe_perangkat').text(': ' +data.tipe_perangkat);
                $('#jumlah_core').text(': ' +data.jumlah_core);
                $('#ukuran_ram').text(': ' +data.ukuran_ram+' GB');
                $('#ukuran_hdd').text(': ' +data.ukuran_hdd+' '+data.keterangan);
                if(data.ip_server == null){
                    $('#ip_server').text(': ' + 'Tidak Diketahui');
                }else{
                    $('#ip_server').text(': ' +data.ip_server);
                }
                if(data.ip_vps == null){
                    $('#ip_vps').text(': ' + 'Tidak Diketahui');
                }else{
                    $('#ip_vps').text(': ' +data.ip_vps);
                }
                if(data.ip_public == null){
                    $('#ip_public').text(': ' + 'Tidak Diketahui');
                }else{
                    $('#ip_public').text(': ' +data.ip_public);
                }
                if(data.nama_aplikasi == null){
                    $('#nama_aplikasi').html(': ' +'Tidak Diketahui');
                }else{
                    $('#nama_aplikasi').html(': ' +'<a href="#" data-id='+data.ip_server+' class="show-nama_aplikasi" style="font-size: 15px">'+data.nama_aplikasi+'</a>');
                }
                $('#status_kepemilikan').text(': ' +data.status_kepemilikan);
                $('#print').attr("href", "/cetakaplikasi/cetak_pdf_aplikasi/"+data.id_aplikasi);
            });
        });
        $('body').on("click", '.show-nama_aplikasi', function (e) {
            var valip='';
            var val ='';
            var val1 ='';
            $('#myModal1').modal("show");
            $('#myModal').modal("hide");
            $.get("/anyDataaplikasi/" + $(this).attr('data-id'), function (data) {
                console.log(data);
                $.each(data, function (index, z) {
                valip = '<center>'+z.ip_server+'</center>';
                val1 = ''+z.ip_server+'';
                val += '<tr><td>'+z.nama_aplikasi+'</td></tr>';
                });
                $('#apk').html(valip + '<br>' + val);
                $('#print2').attr("href", "/cetakserver/cetak_pdf_server/"+val1);
            });
        });
        </script>
@endpush