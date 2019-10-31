@extends('layouts.master')

@section('head')
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
@endsection

@section('content')
    <div class="little-neko-preloader little-neko-sk-cube-grid little-neko-preloader-centered"
         data-logo="{{asset('img/logo-black.png')}}"></div>
    <main id="content">
        <img class="img-thumbnail" style="border: none; padding: 0; border-radius: 0"
             src="{{asset('img/clock.jpeg')}}">
        <br><br><br><br>
        <main id="container">
            <div class="container">
                <div class="col-md-offset-1 col-md-10">
                    <div class="row heading">
                        @if(!empty($type) && !empty($history))
                            <h2><span>Lịch sử<br>{{$history->created_at . ' - ' . $type}}</span></h2>
                        @endif
                    </div>
                    <div class="row">
                        @if(!empty($history))
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="myChart" width="400" height="400"></canvas>
                                    <br>
                                </div>
                                <div class="col-md-6 text-center">
                                    @if($type == 'neo')
                                        <h5>Đánh giá các mặt</h5>
                                        @foreach(json_decode($history->result, true) as $value)
                                            <p><b>{{$value['type'] . ': '}}</b> {{$value['level']}}</p>
                                        @endforeach
                                        <div class="row text-center">
                                            <a href="{{route('history.neo.export', ['id' => $history->id])}}"
                                               class="btn btn-primary small"
                                               target="_blank">Tải xuống</a>
                                        </div>
                                    @elseif($type == 'riasec')
                                        <h5>Điểm trung bình các lĩnh vực</h5>
                                        @foreach(json_decode($history->result, true) as $name => $score)
                                            <p><b>{{$name}}: </b>{{$score}}</p>
                                        @endforeach
                                        <div class="row text-center">
                                            <a href="{{route('history.riasec.export', ['id' => $history->id])}}"
                                               class="btn btn-primary small"
                                               target="_blank">Tải xuống</a>
                                        </div>
                                    @elseif($type=='psychology')
                                        <h5>Đánh giá khó khăn tâm lý</h5>
                                        <div class="read-more">
                                            @foreach(json_decode($history->result, true) as $value)
                                                <p><b>Khó
                                                        khăn: </b>{{\App\Helpers\Helper::getTypePsychologyById($value['typeId'])->content}}
                                                </p>
                                                <p><b>Điểm: </b>{{$value['score']}}</p>
                                                <p><b>Mức độ khó khăn tâm lý: </b>{{$value['typeResult']}}</p>
                                                <hr>
                                            @endforeach
                                        </div>
                                        <div class="row text-center">
                                            <a href="{{route('history.psychology.export', ['id' => $history->id])}}"
                                               class="btn btn-primary small"
                                               target="_blank">Tải xuống</a>
                                            <p></p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <br><br>
        </main>
    </main>
@endsection

@if(!empty($history) && !empty($type))
@section('script')
    <script>
        $(function () {
            $('#user').addClass('active');
        });
    </script>
    @if($type == 'neo')
        <script>
            var ctx = document.getElementById("myChart");
            var lables = [];
            var data = [];
            @foreach (json_decode($history->result, true) as $value)
            lables.push('{{$value['type']}}');
            data.push(<?= $value['score']?>);
                    @endforeach
            var myChart = new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: lables,
                        datasets: [{
                            label: '# score',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 102, 102, 1)',
                                'rgba(54, 178, 102, 1)',
                                'rgba(255, 255, 102, 1)',
                                'rgba(178, 255, 102, 1)',
                                'rgba(102, 255, 102, 1)',
                                'rgba(102, 255, 178, 1)',
                                'rgba(102, 255, 255, 1)',
                                'rgba(102, 178, 255, 1)',
                                'rgba(102, 102, 255, 1)',
                                'rgba(178, 102, 255, 1)',
                                'rgba(255, 102, 255, 1)',
                                'rgba(255, 102, 178, 1)',
                                'rgba(192, 192, 192, 1)',
                                'rgba(102, 102, 102, 1)'
                            ],
                            borderColor: [
                                'rgba(255, 102, 102, 1)',
                                'rgba(54, 178, 102, 1)',
                                'rgba(255, 255, 102, 1)',
                                'rgba(178, 255, 102, 1)',
                                'rgba(102, 255, 102, 1)',
                                'rgba(102, 255, 178, 1)',
                                'rgba(102, 255, 255, 1)',
                                'rgba(102, 178, 255, 1)',
                                'rgba(102, 102, 255, 1)',
                                'rgba(178, 102, 255, 1)',
                                'rgba(255, 102, 255, 1)',
                                'rgba(255, 102, 178, 1)',
                                'rgba(192, 192, 192, 1)',
                                'rgba(102, 102, 102, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
        </script>
    @elseif($type == 'riasec')
        <script>
            var ctx = document.getElementById("myChart");
            var lables = [];
            var data = [];
            @foreach (json_decode($history->result, true) as $type => $score)
            lables.push('{{$type}}');
            data.push({{$score}});
                    @endforeach
            var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: lables,
                        datasets: [{
                            label: '# score',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 102, 102, 1)',
                                'rgba(54, 178, 102, 1)',
                                'rgba(255, 255, 102, 1)',
                                'rgba(178, 255, 102, 1)',
                                'rgba(102, 255, 102, 1)',
                                'rgba(102, 255, 178, 1)',
                                'rgba(102, 255, 255, 1)',
                                'rgba(102, 178, 255, 1)',
                                'rgba(102, 102, 255, 1)',
                                'rgba(178, 102, 255, 1)',
                                'rgba(255, 102, 255, 1)',
                                'rgba(255, 102, 178, 1)',
                                'rgba(192, 192, 192, 1)',
                                'rgba(102, 102, 102, 1)'
                            ],
                            borderColor: [
                                'rgba(255, 102, 102, 1)',
                                'rgba(54, 178, 102, 1)',
                                'rgba(255, 255, 102, 1)',
                                'rgba(178, 255, 102, 1)',
                                'rgba(102, 255, 102, 1)',
                                'rgba(102, 255, 178, 1)',
                                'rgba(102, 255, 255, 1)',
                                'rgba(102, 178, 255, 1)',
                                'rgba(102, 102, 255, 1)',
                                'rgba(178, 102, 255, 1)',
                                'rgba(255, 102, 255, 1)',
                                'rgba(255, 102, 178, 1)',
                                'rgba(192, 192, 192, 1)',
                                'rgba(102, 102, 102, 1)'
                            ],
                            borderWidth: 1
                        }]
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
        </script>
    @elseif($type == 'psychology')
        <script>
            var ctx = document.getElementById("myChart");
            var lables = [];
            var data = [];
            @foreach (json_decode($history->result, true) as $value)
            lables.push('<?= \App\Helpers\Helper::getTypePsychologyById($value['typeId'])->content?>');
            data.push(<?= $value['score']?>);
                    @endforeach
            var myChart = new Chart(ctx, {
                    type: 'polarArea',
                    data: {
                        labels: lables,
                        datasets: [{
                            label: '# score',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 102, 102, 1)',
                                'rgba(54, 178, 102, 1)',
                                'rgba(255, 255, 102, 1)',
                                'rgba(178, 255, 102, 1)',
                                'rgba(102, 255, 102, 1)',
                                'rgba(102, 255, 178, 1)',
                                'rgba(102, 255, 255, 1)',
                                'rgba(102, 178, 255, 1)',
                                'rgba(102, 102, 255, 1)',
                                'rgba(178, 102, 255, 1)',
                                'rgba(255, 102, 255, 1)',
                                'rgba(255, 102, 178, 1)',
                                'rgba(192, 192, 192, 1)',
                                'rgba(102, 102, 102, 1)'
                            ],
                            borderColor: [
                                'rgba(255, 102, 102, 1)',
                                'rgba(54, 178, 102, 1)',
                                'rgba(255, 255, 102, 1)',
                                'rgba(178, 255, 102, 1)',
                                'rgba(102, 255, 102, 1)',
                                'rgba(102, 255, 178, 1)',
                                'rgba(102, 255, 255, 1)',
                                'rgba(102, 178, 255, 1)',
                                'rgba(102, 102, 255, 1)',
                                'rgba(178, 102, 255, 1)',
                                'rgba(255, 102, 255, 1)',
                                'rgba(255, 102, 178, 1)',
                                'rgba(192, 192, 192, 1)',
                                'rgba(102, 102, 102, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
                });
        </script>
        <script>
            $(function () {
                $(".read-more").readmore({
                    buttonClasses: "btn btn-primary small",
                });
            });
        </script>
    @endif
@endsection
@endif