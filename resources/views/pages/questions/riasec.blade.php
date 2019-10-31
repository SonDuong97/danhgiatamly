@extends('layouts.master')

@section('title')
    <title>Trắc nghiệm hứng thú nghề nghiệp RIASEC</title>
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
                        <span class="text-justify" style="font-weight: bold">
                            Bộ công cụ này được xây dựng trên cơ sở lý thuyết do chính John Holland dày công tìm hiểu.
                            Lý thuyết này dựa trên 8 luận điểm, trong đó 2 luận điểm đầu là: Hầu như ai cũng có thể được xếp vào 1 trong 6 kiểu người, 6 kiểu người đó là <b>Realistic</b> (Người thực tế, viết tắt là R), <b>Investigative</b> (Người thích nghiên cứu – I), <b>Artistic</b> (Người có tính nghệ sĩ – A), <b>Social</b> (Người có Tính xã hội – S), <b>Enterprising</b> (Người dám nghĩ dám làm – E) và <b>Conventional</b> (Người công chức – C).
                            Có 6 môi trường hoạt động ứng đúng với 6 kiểu người kể trên. Lý thuyết này về sau lấy 6 chữ cái ghép lại thành tên Riasec.
                            Trên cơ sở lý thuyết này, John Holland đã xây dựng một bộ test dành cho người muốn tự tìm hiểu mình.
                            Qua nhiều năm phát triển, bộ trắc nghiệm này giúp chúng ta tự phát hiện được các kiểu người trội nhất đang tiềm ẩn trong con người mình để tự định hướng khi lựa chọn nghề
                        </span>
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
                            <th class="text-center">Hoàn toàn không đúng</th>
                            <th class="text-center">Không đúng</th>
                            <th class="text-center">Đúng một phần</th>
                            <th class="text-center">Đúng</th>
                            <th class="text-center">Hoàn toàn đúng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($questionRIASECs))
                            @foreach($questionRIASECs as $key => $questionRIASEC)
                                <tr>
                                    <td>{!! $key + 1!!}</td>
                                    <td class="question-content text-justify">{!! $questionRIASEC->content !!}</td>
                                    <td class="text-center"><input type="radio"
                                                                   value="{{\App\Helpers\Helper::RIASEC_LEVEL_HOAN_TOAN_KHONG_DUNG}}"
                                                                   name="{{$questionRIASEC->id}}" required></td>
                                    <td class="text-center"><input type="radio"
                                                                   value="{{\App\Helpers\Helper::RIASEC_LEVEL_KHONG_DUNG}}"
                                                                   name="{{$questionRIASEC->id}}" required></td>
                                    <td class="text-center"><input type="radio"
                                                                   value="{{\App\Helpers\Helper::RIASEC_LEVEL_DUNG_MOT_PHAN}}"
                                                                   name="{{$questionRIASEC->id}}" required></td>
                                    <td class="text-center"><input type="radio"
                                                                   value="{{\App\Helpers\Helper::RIASEC_LEVEL_DUNG}}"
                                                                   name="{{$questionRIASEC->id}}" required></td>
                                    <td class="text-center"><input type="radio"
                                                                   value="{{\App\Helpers\Helper::RIASEC_LEVEL_HOAN_TOAN_DUNG}}"
                                                                   name="{{$questionRIASEC->id}}" required></td>
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
                $('input:radio[value=1]').prop('checked', true);
            }

            window.test = test;
        });
    </script>
@endsection