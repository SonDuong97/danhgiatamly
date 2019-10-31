@extends('adminlte::page')

@section('title', 'Charts')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('content_header')
    <h1>
        Chart
        @if(!empty($userId))
            {{' - ' . ucfirst(\App\Helpers\Helper::getUserById($userId)->name)}}
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Charts</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Chart</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="daily-chart" style="height:300px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">User</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Psychology Chart</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            @if(empty($userId))
                                <div class="col-md-12">
                                    <a href="{{route('psychologyreport.export')}}" class="btn btn-danger pull-left"><i
                                                class="fa fa-download"> Export</i></a>
                                    <a href="{{route('psychologyreport.exportdetail')}}"
                                       class="btn btn-success pull-right"><i
                                                class="fa fa-download"> Export Detail</i></a>
                                </div>
                            @endif
                            <div class="chart">
                                <canvas id="psychology-chart" style="height:300px"></canvas>
                            </div>
                            <div class="container">
                                <div id="psychology-chart-type">
                                    <label>
                                        <input type="radio" value="bar" name="psychology-chart-type" class="flat-red">
                                        Bar
                                    </label>
                                    <label>
                                        <input type="radio" value="pie" name="psychology-chart-type" class="flat-red">
                                        Pie
                                    </label>
                                    <label>
                                        <input type="radio" value="line" name="psychology-chart-type" class="flat-red"
                                               checked>
                                        Line
                                    </label>
                                    <label>
                                        <input type="radio" value="doughnut" name="psychology-chart-type"
                                               class="flat-red">
                                        Doughnut
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">NEO Chart</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    @if(empty($userId))
                        <div class="col-md-12">
                            <a href="{{route('neoreport.export')}}" class="btn btn-danger pull-left"><i
                                        class="fa fa-download"> Export</i></a>
                            <a href="{{route('neoreport.exportdetail')}}" class="btn btn-success pull-right"><i
                                        class="fa fa-download"> Export Detail</i></a>
                        </div>
                    @endif
                    <div class="chart">
                        <canvas id="neo-chart" style="height:300px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">RIASEC Chart</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    @if(empty($userId))
                        <div class="col-md-12">
                            <a href="{{route('riasecreport.export')}}" class="btn btn-danger pull-left"><i
                                        class="fa fa-download"> Export</i></a>
                            <a href="{{route('riasecreport.exportdetail')}}" class="btn btn-success pull-right"><i
                                        class="fa fa-download"> Export Detail</i></a>
                        </div>
                    @endif
                    <div class="chart">
                        <canvas id="riasec-chart" style="height:300px"></canvas>
                    </div>
                </div>
                <div class="container">
                    <div id="riasec-chart-type">
                        <label>
                            <input type="radio" value="bar" name="riasec-chart-type" class="flat-red">
                            Bar
                        </label>
                        <label>
                            <input type="radio" value="pie" name="riasec-chart-type" class="flat-red">
                            Pie
                        </label>
                        <label>
                            <input type="radio" value="line" name="riasec-chart-type" class="flat-red">
                            Line
                        </label>
                        <label>
                            <input type="radio" value="doughnut" name="riasec-chart-type" class="flat-red" checked>
                            Doughnut
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script>
        $(function () {
            var questionData = [];
            questionData.push({{count(\App\Helpers\Data::getReportDataByType('neo', $userId))}});
            questionData.push({{count(\App\Helpers\Data::getReportDataByType('riasec', $userId))}});
            questionData.push({{count(\App\Helpers\Data::getReportDataByType('psychology', $userId))}});
            var dailyCtx = document.getElementById("daily-chart");

            var neoLables = [];
            var lowData = [];
            var mediumData = [];
            var highData = [];
            @foreach(\App\Helpers\Data::getNeoTypes() as $neoType)
            neoLables.push('{{$neoType->name}}');
            lowData.push({{count(\App\Helpers\Data::getLowLevelDataNEO($neoType->id, $userId))}});
            mediumData.push({{count(\App\Helpers\Data::getMediumLevelDataNEO($neoType->id, $userId))}});
            highData.push({{count(\App\Helpers\Data::getHighLevelDataNEO($neoType->id, $userId))}});
                    @endforeach
            var neoCtx = document.getElementById("neo-chart");

            var riasecLables = [];
            var riasecData = [];
            @foreach(\App\Helpers\Data::getRiasecTypes() as $riasecType)
            riasecLables.push('{{$riasecType->name}}');
            riasecData.push({{count(\App\Helpers\Data::getRiasecDataByTypeName($riasecType->name, $userId))}});
                    @endforeach
            var riasecCtx = document.getElementById("riasec-chart");

            var psychologyData = [];
            var psychologyLables = [];
            @foreach(\App\Helpers\Data::getPsychologyTypes() as $psychologyType)
            psychologyLables.push('{{$psychologyType->content}}');
            psychologyData.push({{\App\Helpers\Data::getAveragePsychologyScoreByTypeId($psychologyType->id, $userId)}});
                    @endforeach
            var psychologyCtx = document.getElementById("psychology-chart");

            var neoChart;
            var riasecChart;
            var psychologyChart;

            function loadRiasecChart(chartType) {
                riasecChart = new Chart(riasecCtx, {
                    type: chartType,
                    data: {
                        labels: riasecLables,
                        datasets: [
                            {
                                label: '# Số lượng người trội trong lĩnh vực',
                                data: riasecData,
                                backgroundColor: [
                                    '#f16954',
                                    '#39a65a',
                                    '#f39c14',
                                    '#53c0ef',
                                    '#3d8dbb',
                                    '#d2d6de'
                                ],
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

            function loadChart() {
                var dailyChart = new Chart(dailyCtx, {
                    type: 'bar',
                    data: {
                        labels: ["NEO", "RIASEC", "PSYCHOLOGY"],
                        datasets: [
                            {
                                label: '# Số bài trắc nghiệm đã làm',
                                data: questionData,
                                backgroundColor: [
                                    '#9CB380',
                                    '#506C64',
                                    '#522A27'
                                ]
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

            function loadNeoChart(chartType) {
                neoChart = new Chart(neoCtx, {
                    type: chartType,
                    data: {
                        labels: neoLables,
                        datasets: [
                            {
                                label: '# Thấp',
                                data: lowData,
                                backgroundColor: [
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)'
                                ],
                                borderColor: [
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)',
                                    'rgba(60, 200, 158, 1)'
                                ],
                                borderWidth: 1
                            },
                            {
                                label: '# Trung bình',
                                data: mediumData,
                                backgroundColor: [
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)'
                                ],
                                borderColor: [
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)',
                                    'rgba(60, 170, 158, 1)'
                                ],
                                borderWidth: 1
                            },
                            {
                                label: '# Cao',
                                data: highData,
                                backgroundColor: [
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)'
                                ],
                                borderColor: [
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)',
                                    'rgba(60, 150, 188, 1)'
                                ],
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

            function loadPsychologyChart(chartType) {
                psychologyChart = new Chart(psychologyCtx, {
                    type: chartType,
                    data: {
                        labels: psychologyLables,
                        datasets: [
                            {
                                label: '# Khó khăn tâm lý',
                                data: psychologyData,
                                backgroundColor: [
                                    '#3d8dbb',
                                    '#161621',
                                    '#AFAFAF',
                                    '#191D32',
                                    '#356473',
                                    '#603230',
                                    '#67597A',
                                    '#544E61',
                                    '#6E8894',
                                    '#CACAAA',
                                    '#6F6A3B',
                                    '#E4FDE1',
                                    '#456990',
                                    '#FF5C51',
                                ],
                                borderColor: [
                                    '#3d8dbb',
                                    '#161621',
                                    '#AFAFAF',
                                    '#191D32',
                                    '#356473',
                                    '#603230',
                                    '#67597A',
                                    '#544E61',
                                    '#6E8894',
                                    '#CACAAA',
                                    '#6F6A3B',
                                    '#E4FDE1',
                                    '#456990',
                                    '#FF5C51',
                                ],
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }

            loadChart();
            loadNeoChart('bar');
            loadPsychologyChart('line');
            loadRiasecChart('doughnut');

            $('input:radio[name=riasec-chart-type]').change(function () {
                var chartType = $(this).val();
                riasecChart.destroy();
                loadRiasecChart(chartType);
            });

            $('input:radio[name=psychology-chart-type]').change(function () {
                var chartType = $(this).val();
                psychologyChart.destroy();
                loadPsychologyChart(chartType);
            });
        });
    </script>
@stop