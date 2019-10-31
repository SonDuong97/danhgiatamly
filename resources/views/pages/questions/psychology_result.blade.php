@extends('layouts.master')

@section('head')
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
@endsection

@section('title')
    <title>Psychology Result</title>
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
                    <h2><span>Kết quả đánh giá khó khăn tâm lý của {{Auth::user()->name}}</span></h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <canvas id="myChart" width="400" height="400"></canvas>
                                <br>
                            </div>
                        </div>
                        @if(isset($psychologyResultRules))
                            <div class="read-more">
                                <div class="row">
                                    <div class="row heading">
                                        <h2><span>Dựa vào kết quả phân tích so sánh với bảng dưới đây</span></h2>
                                    </div>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center">Không gặp vấn đề</th>
                                            <th class="text-center">Nguy cơ</th>
                                            <th class="text-center">Nên gặp chuyên gia</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($psychologyResultRules as $psychologyResultRule)
                                            <tr>
                                                <td>
                                                    <b>{{\App\Helpers\Helper::getTypePsychologyById($psychologyResultRule->type_id)->content}}</b>
                                                </td>
                                                <td class="text-center">
                                                    <= {{$psychologyResultRule->average_value + $psychologyResultRule->error_value}}
                                                </td>
                                                <td class="text-center">
                                                    {{$psychologyResultRule->average_value + $psychologyResultRule->error_value}}
                                                    - {{$psychologyResultRule->average_value + 2 * $psychologyResultRule->error_value}}
                                                </td>
                                                <td class="text-center">
                                                    >= {{$psychologyResultRule->average_value + 2 * $psychologyResultRule->error_value}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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

@if(Session::get('result'))
@section('script')
    <script>
        var ctx = document.getElementById("myChart");
        var lables = [];
        var data = [];
        @foreach (Session::get('result') as $value)
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
            $('#question').addClass('active');

            $(".read-more").readmore({
                buttonClasses: "btn btn-primary small",
            });
        });
    </script>
@endsection
@endif