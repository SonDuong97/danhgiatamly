@extends('adminlte::page')

@section('title', 'Timeline')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('content_header')
    <h1>
        Timeline
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Timeline</li>
    </ol>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if(count($history) > 0)
                    <ul class="timeline">
                        @foreach($history as $value)
                            @if($value->title == 'Trắc nghiệm nhân cách NEO')
                                <li class="time-label">
                                    <span class="bg-blue">{{$value->created_at}}</span>
                                </li>
                                <li>
                                    <i class="fa fa-codepen bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{$value->created_at}}</span>
                                        <h3 class="timeline-header"><a href="#">{{$value->title}}</a> {{$user->name}}
                                        </h3>
                                        <div class="timeline-body">
                                            @foreach(json_decode($value->result, true) as $result)
                                                <p><b>{{$result['type'] . ': '}}</b> {{$result['level']}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @elseif($value->title == 'Trắc nghiệm hứng thú nghề nghiệp RIASEC')
                                <li class="time-label">
                                    <span class="bg-blue">{{$value->created_at}}</span>
                                </li>
                                <li>
                                    <i class="fa fa-dribbble bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{$value->created_at}}</span>
                                        <h3 class="timeline-header"><a href="#">{{$value->title}}</a> {{$user->name}}
                                        </h3>
                                        <div class="timeline-body">
                                            @foreach(json_decode($value->result, true) as $name => $score)
                                                <p><b>{{$name}}: </b>{{$score}}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @elseif($value->title == 'Trắc nghiệm sàng lọc tâm lý')
                                <li class="time-label">
                                    <span class="bg-blue">{{$value->created_at}}</span>
                                </li>
                                <li>
                                    <i class="fa fa-dashcube bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> {{$value->created_at}}</span>
                                        <h3 class="timeline-header"><a href="#">{{$value->title}}</a> {{$user->name}}
                                        </h3>
                                        <div class="timeline-body">
                                            <div class="read-more">
                                                @foreach(json_decode($value->result, true) as $result)
                                                    <p><b>Khó
                                                            khăn: </b>{{\App\Helpers\Helper::getTypePsychologyById($result['typeId'])->content}}
                                                    </p>
                                                    <p><b>Điểm: </b>{{$result['score']}}</p>
                                                    <p><b>Mức độ khó khăn tâm lý: </b>{{$result['typeResult']}}</p>
                                                    <hr>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <div><h1> Sorry, no history </h1></div>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@stop

@section('js')
    <script src="{{asset('js/readmore.js')}}"></script>
    <script>
        $(function () {
            $(".read-more").readmore({
                buttonClasses: "btn btn-light",
            });
        });
    </script>
@endsection