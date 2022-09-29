@extends('layouts.app')
@section('content')
<style>
    .highcharts-root{
        height: 200px !important;
    }

    .highcharts-container {
        height: 200px !important;
    }
</style>
<div class="page-heading">
    <h3>{{ $title }}</h3>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="col-12">
        <div style="margin-bottom: -15px !important">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-auto">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalFilter" class="btn btn-sm btn-outline-success fs-14">Pilih Filter<i class="bi bi-filter m-l-8"></i></a>
                        </div>
                        <div class="col-auto">
                            {{-- <ul class="nav m-0 nav-tabs fs-14" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="warga-tab" data-bs-toggle="tab" href="#warga" role="tab" aria-controls="warga" aria-selected="true">Warga</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="rumah-tab" data-bs-toggle="tab" href="#rumah" role="tab" aria-controls="rumah" aria-selected="false">Rumah</a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #FDC90F !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-warning mb-1">Jumlah RW</div>
                                    <div class="fw-bold fs-18 text-black">50 <span class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</span></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-clipboard-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #39CB7F !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-success mb-1">Jumlah RT</div>
                                    <div class="fw-bold fs-18 text-black">120 <span class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</span></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-clipboard-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #FC4B6C !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-danger mb-1">Jumlah Rumah</div>
                                    <div class="fw-bold fs-18 text-black">304 <span class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</span></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-house-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #0BB2FB !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-info mb-1">Jumlah KK</div>
                                    <div class="fw-bold fs-18 text-black">505 <span class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</span></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-file-earmark-text-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm" style="margin-bottom: -15px !important">
                    <div class="card" style="border-left: 0.35rem solid #4e73df !important">
                        <div class="card-body fs-14 fw-bold">
                            <div class="row">
                                <div class="col">
                                    <div class="fw-bold fs-14 text-primary mb-1">Jumlah Warga</div>
                                    <div class="fw-bold fs-18 text-black">932 <span class="fs-12 text-black-50"><i class="fw-bold bi bi-arrow-up text-success"></i> 10%</span></div>
                                </div>
                                <div class="col-auto fs-20">
                                    <i class="bi bi-people-fill text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="warga" role="tabpanel" aria-labelledby="warga-tab">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="card">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-sm-6 p-5">
                                        <p class="text-center fw-bold fs-16 text-black">Jenis Kelamin</p>
                                        <table class="text-black fs-14">
                                            <tr>
                                                <th class="text-primary">Perempuan</th>
                                                <td> &nbsp; : &nbsp; </td>
                                                <td>200</td>
                                                <td>&nbsp;&nbsp;&nbsp; <i class="bi bi-arrow-down text-danger"></i> 4%</td>
                                            </tr>
                                            <tr>
                                                <th class="text-warning">Laki - Laki</th>
                                                <td> &nbsp; : &nbsp; </td>
                                                <td>429</td>
                                                <td>&nbsp;&nbsp;&nbsp; <i class="bi bi-arrow-up text-success"></i> 10%</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-6">
                                        <figure class="highcharts-figure">
                                            <div id="pieChart"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="rumah" role="tabpanel" aria-labelledby="rumah-tab">
                Rumah
            </div>
        </div>
    </div>
</section>
@include('pages.dashboard.filter_dashboard')
@endsection
@push('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    $('.select2').select2({
        dropdownParent: $('#modalFilter')
    });

    var year =  new Date().getFullYear();

    Highcharts.chart('pieChart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        credits: {
            enabled: false
        },
        exporting: { enabled: false },
        title: false,
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            style: {
                fontSize: 20
            },
            pointFormat: '<b>{series.name}</b>: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                size: '100%',
                cursor: 'pointer',
                dataLabels: {
                    crop: false,
                    distance: 25,
                    overflow: "none",
                    format: '{point.percentage:.1f} %',
                    style: {
                        fontSize: 25
                    }
                },
                center: ["50%", "50%"]
            }
        },
        series: [{
            name: 'Jumlah',
            colorByPoint: true,
            data: [{
                name: 'Laki - Laki',
                y: 429,
                color: '#FDC90F',
            }, {
                name: 'Perempuan',
                y: 200,
                color: '#4e73df',
                sliced: true
            }]
        }]
    });


</script>
@endpush
