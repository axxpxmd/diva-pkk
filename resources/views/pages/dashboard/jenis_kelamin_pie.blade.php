<div class="row">
    <div class="col-sm-6 p-5">
        <p class="text-center fw-bold fs-16 text-black">Jenis Kelamin</p>
        <table class="display nowraptext-black fs-14" style="width:100%;">
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
@push('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
    $('.select2').select2({
        dropdownParent: $('#modalFilter')
    });

    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    console.log(window.innerWidth)

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
                fontSize: screen.width > 768 ? '180%' : '100%'
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
                        fontSize: screen.width > 768 ? '180%' : '100%'
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