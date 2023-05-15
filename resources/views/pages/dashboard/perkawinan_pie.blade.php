<style>
    .highcharts-root {
        height: 200px !important;
    }

    .highcharts-container {
        height: 200px !important;
    }

    .highcharts-background {
        height: 430px !important;
    }
</style>
<div class="row">
    <figure class="highcharts-figure">
        <div id="pieChartStatusPerkawinan"></div>
    </figure>
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

        Highcharts.chart('pieChartStatusPerkawinan', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
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
                    name: 'Lajang',
                    y: {{ $totalLajang }},
                    color: '#FC4B6C',
                }, {
                    name: 'Menikah',
                    y: {{ $totalMenikah }},
                    color: '#39CB7F',
                    sliced: true
                }, {
                    name: 'Janda',
                    y: {{ $totalJanda }},
                    color: '#4e73df',
                }, {
                    name: 'Duda',
                    y: {{ $totalDuda }},
                    color: '#FDC90F',
                }]
            }]
        });
    </script>
@endpush
