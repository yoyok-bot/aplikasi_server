@extends('layouts.master')
@section('header')
    Data Grafik
@endsection
@section('home')
    Home
@endsection
@section('page')
    Data
@endsection
@section('content')
<div class="row">
          <div class="col-md-6">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Grafik Berdasarkan Rak</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="rakChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Grafik Berdasarkan Core</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="coreChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Grafik Berdasarkan Laptop</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <div class="chart">
                <canvas id="namaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Grafik Berdasarkan HDD</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="hddChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Grafik Berdasarkan RAM</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="ramChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- STACKED BAR CHART -->
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
@endsection
@push('script')
<script>
        var rak = document.getElementById('rakChart').getContext('2d');
    var donutData_rak      = {
      labels: [
        @foreach($chart as $value)
                       'Rak {{$value->nomer_rak}}',
                       @endforeach
      ],
      datasets: [
        {
          data: [@foreach($chart as $value)
                       '{{$value->total}}',
                       @endforeach],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    var ram = document.getElementById('ramChart').getContext('2d');
    var donutData_ram        = {
      labels: [
        @foreach($chart_ram as $value)
                       'Kapasitas Ram {{$value->ukuran_ram}} GB',
                       @endforeach
      ],
      datasets: [
        {
          data: [@foreach($chart_ram as $value)
                       '{{$value->total}}',
                       @endforeach],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
      percentace : true,
    }

    var hdd = document.getElementById('hddChart').getContext('2d');
    var areaChartData_hdd = {
      labels  : [@foreach($chart_hdd as $value)
                       'Kapasitas Hdd {{$value->ukuran_hdd}} {{$value->keterangan}}',
                       @endforeach],
      datasets: [
        {
          label               : 'Laptop',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [@foreach($chart_hdd as $value)
                       {{$value->total}},
                       @endforeach]
        },
      ]
    }
    var aplikasi = document.getElementById('namaChart').getContext('2d');
    var areaChartData_aplikasi = {
      labels  : [@foreach($chart_aplikasi as $value)
                       'Laptop {{$value->nama_perangkat}}',
                       @endforeach],
      datasets: [
        {
          label               : 'Laptop',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [@foreach($chart_aplikasi as $value)
                       {{$value->total}},
                       @endforeach]
        },
      ]
    }
    var core = document.getElementById('coreChart').getContext('2d');
    var areaChartData_core = {
      labels  : [@foreach($chart_core as $value)
                       'Jumlah Core {{$value->jumlah_core}}',
                       @endforeach],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [@foreach($chart_core as $value)
                       {{$value->total}},
                       @endforeach]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData_core)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(core, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    var barChartData_hdd = jQuery.extend(true, {}, areaChartData_hdd)
    var temp0 = areaChartData_hdd.datasets[0]
    barChartData_hdd.datasets[0] = temp0
    
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(hdd, {
      type: 'bar', 
      data: barChartData_hdd,
      options: barChartOptions
    })
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(rak, {
      type: 'pie',
      data: donutData_rak,
      options: donutOptions      
    })
    var donutChart = new Chart(ram, {
      type: 'doughnut',
      data: donutData_ram,
      options: donutOptions      
    })
var stackedBarChartData_aplikasi = jQuery.extend(true, {}, areaChartData_aplikasi)
var stackedBarChartOptions = {
  responsive              : true,
  maintainAspectRatio     : false,
  scales: {
    xAxes: [{
      stacked: true,
    }],
    yAxes: [{
      stacked: true
    }]
  }
}

var stackedBarChart = new Chart(aplikasi, {
  type: 'bar', 
  data: stackedBarChartData_aplikasi,
  options: stackedBarChartOptions
})
</script>
@endpush