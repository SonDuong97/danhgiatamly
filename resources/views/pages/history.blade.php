@extends('layouts.master')

@section('head')
    <link type="text/css" rel="stylesheet" href="{{asset('css/history.css')}}">
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
                <div class="col-md-8 col-md-offset-2">
                    @if(count($history))
                        <header>
                            <h1>Trắc nghiệm đã làm</h1>
                        </header>
                        <ul class="timeline">
                            <!-- Item 1 -->
                            @foreach($history as $value)
                                @if($value->title == 'Trắc nghiệm nhân cách NEO')
                                    <li>
                                        <div class="direction-r">
                                            <div class="flag-wrapper neo-history">
                                                <span class="hexa"></span>
                                                <a href="{{route('history.detail', ['type' => 'neo', 'id' => $value->id])}}"
                                                   class="flag history-time"
                                                   style="color: white; background-color: #4685f2;">{{$value->created_at->format('H:i:s D, M, Y ')}}</a>
                                                <span class="time-wrapper"><span
                                                            class="time">{{$value->title}}</span></span>
                                            </div>
                                        </div>
                                    </li>
                                @elseif($value->title == 'Trắc nghiệm hứng thú nghề nghiệp RIASEC')
                                    <li>
                                        <div class="direction-l">
                                            <div class="flag-wrapper riasec-history">
                                                <span class="hexa"></span>
                                                <a href="{{route('history.detail', ['type' => 'riasec', 'id' => $value->id])}}"
                                                   class="flag history-time"
                                                   style="background-color: #4685f2; color: white;">{{$value->created_at->format('H:i:s D, M, Y ')}}</a>
                                                <span class="time-wrapper"><span
                                                            class="time">{{$value->title}}</span></span>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li>
                                        <div class="direction-r">
                                            <div class="flag-wrapper psychology-history">
                                                <span class="hexa"></span>
                                                <a href="{{route('history.detail', ['type' => 'psychology', 'id' => $value->id])}}"
                                                   class="flag history-time"
                                                   style="color: white; background-color: #4685f2;">{{$value->created_at->format('H:i:s D, M, Y ')}}</a>
                                                <span class="time-wrapper"><span
                                                            class="time">{{$value->title}}</span></span>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <header>
                            <h1>Bạn chưa làm trắc nghiệm</h1>
                        </header>
                    @endif
                </div>
            </div>
            <br><br>
        </main>
    </main>
@endsection
@section('script')
    <script>
        $(function () {
            $('#user').addClass('active');
        })
    </script>
@endsection
<style>
    a {
        text-decoration: none !important;
    }

    a:hover {
        transition-duration: 0.3s;
    }

    .psychology-history .time {
        background-color: #e94335;
    }

    .neo-history .time {
        background-color: #39a854;
    }

    .riasec-history .time {
        background: #f5bb05;
    }

    .history-time:hover {
        background-color: #4685f2d6 !important;
    }

    .direction-l:hover {
        transform: translateX(10px);
        transition-duration: 0.3s;
    }

    .direction-r:hover {
        transform: translateX(-10px);
        transition-duration: 0.3s;
    }
</style>
