<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <h3 class="profile-username text-center">{{$aplikasi->nama_perangkat}}</h3>

                <p class="text-muted text-center">{{$aplikasi->tipe_perangkat}}</p>

                  <li class="list-group-item">
                    <b>Jumlah Core</b> <a class="float-right">{{$aplikasi->jumlah_core}}</a>
                  </li>
                  <br>
                  <li class="list-group-item">
                    <b>Kapasitas RAM</b> <a class="float-right">{{$aplikasi->ukuran_ram}}</a>
                  </li>
                  <br>
                  <li class="list-group-item">
                    <b>Kapasitas HDD</b> <a class="float-right">{{$aplikasi->ukuran_hdd}} {{$aplikasi->keterangan}}</a>
                  </li>
                  <br>
                  @if($aplikasi->ip_server==null)
                  <li class="list-group-item">
                    <b>Ip Server</b> <a class="float-right">Tidak Diketahui</a>
                  </li>
                  @else
                  <li class="list-group-item">
                    <b>Ip Server</b> <a class="float-right">{{$aplikasi->ip_server}}</a>
                  </li>
                  @endif
                  <br>
                  @if($aplikasi->ip_vps==null)
                  <li class="list-group-item">
                    <b>Ip VPS</b> <a class="float-right">Tidak Diketahui</a>
                  </li>
                  @else
                  <li class="list-group-item">
                    <b>Ip VPS</b> <a class="float-right">{{$aplikasi->ip_vps}}</a>
                  </li>
                  @endif
                  <br>
                  @if($aplikasi->ip_public==null)
                  <li class="list-group-item">
                    <b>Ip Public</b> <a class="float-right">Tidak Diketahui</a>
                  </li>
                  @else
                  <li class="list-group-item">
                    <b>Ip Public</b> <a class="float-right">{{$aplikasi->ip_public}}</a>
                  </li>
                  @endif
                  <br>
                  @if($aplikasi->nama_aplikasi==null)
                  <li class="list-group-item">
                    <b>Nama Aplikasi</b> <a class="float-right">Tidak Diketahui</a>
                  </li>
                  @else
                  <li class="list-group-item">
                    <b>Nama Aplikasi</b> <a class="float-right">{{$aplikasi->nama_aplikasi}}</a>
                  </li>
                  @endif
                  <br>
                  <li class="list-group-item">
                    <b>Kepemilikan</b> <a class="float-right">{{$aplikasi->status_kepemilikan}}</a>
                  </li>
              </div>
              <!-- /.card-body -->
            </div>
 
</body>
</html>