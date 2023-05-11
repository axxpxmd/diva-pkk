<style>
    .highcharts-root{
        height: 200px !important;
    }

    .highcharts-container {
        height: 200px !important;
    }
</style>
<div class="row">
    <div class="col-sm-6 p-5">
        <p class="text-center fw-bold fs-16 text-black">Jenis Kelamin</p>
        <table class="display nowraptext-black fs-14" style="width:100%;">
            <tr>
                <th class="text-primary">Perempuan</th>
                <td> &nbsp; : &nbsp; </td>
                <td>
                    <span class="text-black fw-bold">200</span> 
                    <sup class="fs-12 text-black-50"><i class="bi bi-arrow-down text-danger"></i> 4%</sup>
                </td>
            </tr>
            <tr>
                <th class="text-warning">Laki - Laki</th>
                <td> &nbsp; : &nbsp; </td>
                <td>
                    <span class="text-black fw-bold">429</span>
                    <sup class="fs-12 text-black-50"><i class="bi bi-arrow-up text-success"></i> 4%</sup>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-sm-6">
        <figure class="highcharts-figure">
            <div id="pieChartJenisKelamin"></div>
        </figure>
    </div>
</div>
@push('script')
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    $('.select2').select2({
        dropdownParent: $('#modalFilter')
    });

    Highcharts.chart('pieChartJenisKelamin', {
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
                fontSize: '75%'
            },
            pointFormat: '<b>{point.name}</b>: <b>{point.y}</b>'
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
                        fontSize: '75%'
                    }
                },
                center: ["50%", "50%"]
            }
        },
        series: [{
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