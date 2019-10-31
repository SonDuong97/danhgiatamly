@extends('layouts.master')

@section('head')
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
@endsection

@section('title')
    <title>NEO Result</title>
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
                    <h2><span>Kết quả đánh giá mức độ nhân cách của {{Auth::user()->name}}</span></h2>
                </div>
                <div class="row">
                    @if(Session::get('result'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <canvas id="myChart" width="400" height="400"></canvas>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="read-more">
                                    <div class="row heading">
                                        <h2><span>Kết quả chi tiết</span></h2>
                                    </div>
                                    @foreach(Session::get('result') as $value)
                                        <div class="text-justify">
                                            <h4>{{$value['type'] . ': ' . $value['level']}}</h4>
                                            {!! App\Helpers\Helper::getExQuestionNEOByTypeAndLevel($value['type'], $value['level'])->content !!}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <br><br>
    </main>
@endsection

@if(Session::get('result'))
@section('script')
    <script>
        var ctx = document.getElementById("myChart");
        var lables = [];
        var data = [];
        @foreach (Session::get('result') as $value)
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