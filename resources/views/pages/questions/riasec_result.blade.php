@extends('layouts.master')

@section('head')
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
@endsection

@section('title')
    <title>RIASEC Result</title>
@endsection

@section('content')
    <div class="little-neko-preloader little-neko-sk-cube-grid little-neko-preloader-centered"
         data-logo="{{asset('img/logo-black.png')}}"></div>
    <main id="content">
        <img class="img-thumbnail" style="border: none; padding: 0; border-radius: 0"
             src="{{asset('img/test.jpeg')}}">
        <br><br><br><br>
        <div class="container">
            <div class="col-md-offset-1 col-md-10">
                <div class="row heading">
                    <h2><span>Kết quả đánh giá hứng thú nghề nghiệp của {{Auth::user()->name}}</span></h2>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @if(Session::get('riasecResult'))
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <canvas id="myChart" width="400" height="400"></canvas>
                                    <br>
                                </div>
                            </div>
                            <div class="row text-justify">
                                <div>
                                    <h2 class="text-center">
                                    <span>Theo kết quả đánh giá {{Auth::user()->name}}
                                        trội ở lĩnh vực <b>{{key(Session::get('riasecResult'))}}</b></span>
                                    </h2>
                                    <div class="read-more" style="color: black;">
                                        {!! App\Helpers\Helper::getExQuestionRIASECByType(key(Session::get('riasecResult')))->content !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </main>
@endsection

@if(Session::get('riasecResult'))
@section('script')
    <script>
        var ctx = document.getElementById("myChart");
        var lables = [];
        var data = [];
        @foreach (Session::get('riasecResult') as $type => $score)
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
                        borderWidth: 1,
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
    <script>
        $(function () {
            $('#question').addClass('active');

            $(".read-more").readmore({
                buttonClasses: "btn btn-primary small",
            });
        });
    </script>
@endsection
@endif