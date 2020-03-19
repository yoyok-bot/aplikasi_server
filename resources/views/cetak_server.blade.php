<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
 
	<div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <h3 class="profile-username text-center">{{$server1->ip_server}}</h3>
                <br>
                      @foreach($server as $s)
                  <li class="list-group-item">
                    <b>{{$s->nama_aplikasi}}</b>
                  </li>
                  <br>
                  @endforeach
              </div>
              <!-- /.card-body -->
            </div>
 
</body>
</html>