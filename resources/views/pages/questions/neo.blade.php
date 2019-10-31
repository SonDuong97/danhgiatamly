@extends('layouts.master')

@section('title')
    <title>Trắc nghiệm nhân cách NEO</title>
@endsection

@section('content')
    <div class="little-neko-preloader little-neko-sk-cube-grid little-neko-preloader-centered"
         data-logo="{{asset('img/logo-black.png')}}"></div>
    <main id="content">
        <img class="img-thumbnail" style="border: none; padding: 0; border-radius: 0"
             src="{{asset('img/test.jpeg')}}">
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8 text-center heading">
                    <h2>
                        <a href="#">
                            <img src="{{asset('img/logo-black.png')}}" alt="QuickQuiz Examples" text-center
                                 class="main-logo"/>
                        </a>
                        <span>Đánh giá toàn diện nhân cách thanh niên và người trưởng thành</span>
                        <span>Dựa trên Mô hình 5 yếu tố (FFM) của nhân cách</span>
                        <span>Neuroticism - Nhiễu tâm</span>
                        <span>Extraversion - Hướng ngoại</span>
                        <span>Openness - Cởi mở</span>
                        <span>Agreeableness - Dễ chấp nhận</span>
                        <span>Conscientiousness - Tận tâm</span>
                    </h2>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <form action="#" method="post">
                    {{csrf_field()}}
                    <table class="table test-question-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-center">Hoàn toàn sai</th>
                            <th class="text-center">Sai</th>
                            <th class="text-center">Không đúng cũng không sai</th>
                            <th class="text-center">Đúng</th>
                            <th class="text-center">Hoàn toàn đúng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($questionNEOs))
                            @foreach($questionNEOs as $key => $questionNEO)
                                <tr>
                                    <td>{!! $key + 1!!}</td>
                                    <td class="question-content text-justify">{!! $questionNEO->content !!}</td>
                                    @php($scoreSet = $questionNEO->reverse_score ? array_reverse($scores): $scores)
                                    @foreach($scoreSet as $score )
                                        <td class="text-center"><input type="radio" value={{$score}}
                                                    name="{{$questionNEO->id}}" required></td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn small">Đánh giá</button>
                    </div>
                </form>
            </div>
        </div>
        <br><br>
    </main>
@endsection

@section('script')
    <script>
        $(function () {
            $('#question').addClass('active');

            function test() {
                $('input:radio[value=4]').prop('checked', true);
            }

            window.test = test;
        });
    </script>
@endsection