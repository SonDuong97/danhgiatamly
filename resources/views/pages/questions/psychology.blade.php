@extends('layouts.master')

@section('title')
    <title>Trắc nghiệm sàng lọc khó khăn tâm lý</title>
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
                        <span class="text-justify">
                            Nhiệm vụ cơ bản của chẩn đoán sàng lọc là phát hiện kịp thời học sinh, sinh viên có rối loạn và tổn thương trong phát triển tâm lý ở các trường học, ở các cơ sở giáo dục chung, bước đầu xác định các vấn đề tâm lý – giáo dục ở giới trẻ.
                            Ngoài ra, chẩn đoán sàng lọc cho phép giải quyết các vấn đề giáo dục có liên quan đến chất lượng dạy và giáo dục trong các cơ sở giáo dục, tức: xác định những hạn chế của quá trình giáo dục trong một cơ sở giáo dục cụ thể, những hạn chế của chương trình giáo dục và dạy học trước đó.
                        </span>
                    </h2>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <form action="#" method="post">
                    {{csrf_field()}}
                    @if(isset($typePsychologies) && !empty($typePsychologies))
                        @foreach($typePsychologies as $typePsychology)
                            <h5>{{$typePsychology->content}}</h5>
                            <table class="table test-question-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <?php $psychologyAnswers = \App\Helpers\Helper::getPsychologyAnswersByTypeId($typePsychology->id)?>
                                    @if(isset($psychologyAnswers))
                                        @foreach($psychologyAnswers as $psychologyAnswer)
                                            <th class="text-center">{{$psychologyAnswer->name}}</th>
                                        @endforeach
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <?php $psychologyQuestions = \App\Helpers\Helper::getPsychologyQuestionsByTypeId($typePsychology->id)?>
                                @if(isset($psychologyQuestions))
                                    @foreach($psychologyQuestions as $key => $psychologyQuestion)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td class="question-content text-justify">{!! $psychologyQuestion->content !!}</td>
                                            @if(isset($psychologyAnswers))
                                                @foreach($psychologyAnswers as $psychologyAnswer)
                                                    <td class="text-center"><input type="radio"
                                                                                   value="{{$psychologyAnswer->score}}"
                                                                                   name="{{$psychologyQuestion->id}}"
                                                                                   required>
                                                    </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        @endforeach
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn small">Đánh giá</button>
                        </div>
                    @endif
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
                $('input:radio[value=2]').prop('checked', true);
            }

            window.test = test;
        });
    </script>
@endsection