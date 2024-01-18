
@extends('layouts.admin')
@section('title')
Dashboard
@endsection
@section('content')
      <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">

    <!--  Main wrapper -->
    <div class="body-wrapper">

      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Produk Terjual Per Bulan {{date('F Y') }}</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Nama Product</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Qty</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($datas as $data)
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $data->name_product }}</h6></td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $data->total }}</p>
                        </td>
                      </tr> 
                      @endforeach

                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Total Produk Terjual Tahun {{date('Y') }}</h5>
                  </div>
                  <div>
                  </div>
                </div>
                <div id="chart"></div>
                {{-- <canvas id="myChart" height="100px"></canvas> --}}
              </div>
            </div>
          </div>
        </div>

        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-6">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Total Produk</h5>
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="fw-semibold mb-3">{{ round($totalProductBulan->total) }} Produk</h4>
                        <div class="d-flex align-items-center mb-3">
                          <p class="text-dark me-1 fs-3 mb-0">Bulan</p>
                          <p class="fs-3 mb-0">{{ date('F') }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>

        
          <div class="col-lg-6">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                  <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Total Produk (Tahun)</h5>
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h4 class="fw-semibold mb-3">{{ round($totalProductTahun->total) }} Produk</h4>
                        <div class="d-flex align-items-center mb-3">
                          <p class="text-dark me-1 fs-3 mb-0">Tahun</p>
                          <p class="fs-3 mb-0">{{ date('Y') }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
         
          
          

        </div>
        
        
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script type="text/javascript">
 var labels =  {{ Js::from($labels) }};
       var users =  {{ Js::from($dataChart) }};
       
  
       const data = {
         labels: labels,
         datasets: [{
           label: 'Grafik Produk',
           backgroundColor: 'rgb(255, 99, 132)',
           borderColor: 'rgb(255, 99, 132)',
           data: users,
         }]
       };
  
       const config = {
         type: 'line',
         data: data,
         options: {}
       };
  
       const myChart = new Chart(
         document.getElementById('myChart'),
         config
       );
</script>  --}}
  
<script>
  $(function () {
    // =====================================
    // Profit
    // =====================================
     var product =  {{ Js::from($labels) }};
      var users =  {{ Js::from($dataChart) }};
       var qty = Object.values(users);
       var product = Object.values(product);

    var chart = {
        series: [
            {
                name: "Total Penjualan:",
                data: qty,
            },
        ],

        chart: {
            type: "bar",
            height: 345,
            offsetX: -15,
            toolbar: { show: true },
            foreColor: "#adb0bb",
            fontFamily: "inherit",
            sparkline: { enabled: false },
        },

        colors: ["#5D87FF", "#49BEFF"],

        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "35%",
                borderRadius: [6],
                borderRadiusApplication: "end",
                borderRadiusWhenStacked: "all",
            },
        },
        markers: { size: 0 },

        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
        },

        grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
                lines: {
                    show: false,
                },
            },
        },

        xaxis: {
            type: "category",
            categories: product,
            labels: {
                style: { cssClass: "grey--text lighten-2--text fill-color" },
            },
        },

        yaxis: {
            show: true,
            min: 0,
            max: 20,
            tickAmount: 4,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                },
            },
        },
        stroke: {
            show: true,
            width: 3,
            lineCap: "butt",
            colors: ["transparent"],
        },

        tooltip: { theme: "light" },

        responsive: [
            {
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        },
                    },
                },
            },
        ],
    };

    var chart = new ApexCharts(document.querySelector("#chart"), chart);
    chart.render();

    // =====================================
    // Breakup
    // =====================================

    var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
    chart.render();

    // =====================================
    // Earning
    // =====================================
    var earning = {
        chart: {
            id: "sparkline3",
            type: "area",
            height: 60,
            sparkline: {
                enabled: true,
            },
            group: "sparklines",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        series: [
            {
                name: "Earnings",
                color: "#49BEFF",
                data: [25, 66, 20, 40, 12, 58, 20],
            },
        ],
        stroke: {
            curve: "smooth",
            width: 2,
        },
        fill: {
            colors: ["#f3feff"],
            type: "solid",
            opacity: 0.05,
        },

        markers: {
            size: 0,
        },
        tooltip: {
            theme: "dark",
            fixed: {
                enabled: true,
                position: "right",
            },
            x: {
                show: false,
            },
        },
    };
    new ApexCharts(document.querySelector("#earning"), earning).render();
});

</script>

@endpush