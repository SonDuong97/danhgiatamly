@extends('layouts.master')

@section('title')
    <title>Trắc nghiệm</title>
@endsection

@section('content')
    <div class="little-neko-preloader little-neko-sk-cube-grid little-neko-preloader-centered"
         data-logo="{{asset('img/logo-black.png')}}"></div>
    <main id="content">
        <img class="img-thumbnail" style="border: none; padding: 0; border-radius: 0"
             src="{{asset('img/question.jpeg')}}">
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center heading">
                    <h2><a href="#"><img style="width: 158px;height: 181px" src="{{asset('/img/logo-dhgd.jpg')}}" alt="QuickQuiz Examples" text-center
                                         class="main-logo"/></a><span>Để hiểu rõ bản thân, hãy làm một số bài trắc nghiệm dưới đây</span>
                        <span>Trắc nghiệm nhân cách NEO, trắc nghiệm hứng thú nghề nghiệp RIASEC, trắc nghiệm sàng lọc khó khăn tâm lý...</span>
                    </h2>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <figure class="example">
                        <a href="#"><img src="{{$label['neo']['image']}}" alt="graded"
                                         class="responsive"></a>
                    </figure>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                    <h3>{{$label['neo']['title']}}</h3>
                    <p>{{$label['neo']['description']}}</p>
                    <p><a href="{{route('question.neo-test')}}">Bắt đầu >></a></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <figure class="example">
                        <a href="#"><img src={{$label['riasec']['image']}} alt="survey"
                                         class="responsive"></a>
                    </figure>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                    <h3>{{$label['riasec']['title']}}</h3>
                    <p>{{$label['riasec']['description']}}</p>
                    <p><a href="{{route('question.riasec-test')}}">Bắt đầu >></a></p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <figure class="example">
                        <a href="#"><img src={{$label['psychology']['image']}} alt="weighted"
                                         class="responsive"></a>
                    </figure>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                    <h3>{{$label['psychology']['title']}}</h3>
                    <p>{{$label['psychology']['description']}}</p>
                    <p><a href="{{route('question.psychology-test')}}">Bắt đầu >></a></p>
                </div>
            </div>
            <hr>
            <br><br>
        </div>
        <br><br>
    </main>
@endsection
@section('script')
    <script>
        $(function () {
            $('#question').addClass('active');
        })
    </script>
@endsection