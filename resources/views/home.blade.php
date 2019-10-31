@extends('layouts.master')

@section('title')
    <title>Trắc nghiệm tâm lý</title>
@endsection

@section('content')
    <main id="content">
        <!-- splash screen -->
        <section id="home-carousel" class="dark-color image-background nk-fullscreen responsive">
            <div class="mask opacity-2">
                <div class="container v-align-center">
                    <div class="row">
                        <div class="col-md-12" data-nekoanim="fadeInUp" data-nekodelay="200">
                            <div class="cta-box mb15 text-light">
                                <div class="cta-box-text">
                                    <h1 class="x-large">
                                        Trắc nghiệm tâm lý
                                    </h1>
                                    <h2>
                                        Bạn có thực sự hiểu rõ về bản thân?
                                    </h2>
                                </div>
                                <div class="cta-box-btn">
                                    <a class="btn default large" title="QuickQuiz on CodeCanyon"
                                       href="{{route('question')}}">
                                        Bắt đầu!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / splash screen -->
        <!-- services -->
        <section class="pt-large" id="introduction">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading" data-nekoanim="fadeInUp" data-nekodelay="10">
                        <h1><span>TuvanHoc là gì?</span>Giới thiệu</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-10 pb col-md-push-1">
                        <div class="clearfix">
                            <div class="feature-box media-left" data-nekoanim="fadeInLeft" data-nekodelay="100">
                                <div class="text-center">
                                    <p>
                                        Hệ thống này cho phép người sử dụng kiểm tra được những vấn đề tâm lý mà đang
                                        gặp phải và người được trắc nghiệm sẽ có cơ hội được hiểu rõ về bản thân mình
                                        hơn. Có thể là cảm xúc, tình cảm, nhân cách, năng lực… hoặc là những khó khăn
                                        trong tâm lý của bản thân. Website được thiết kế với mong muốn có thể cung cấp
                                        cho người dùng một số bài trắc nghiệm tâm lí học phổ biến để tử đó có thể đánh
                                        giá một cách khách quan về bản thân.
                                    </p>
                                    <a href="{{route('introduction')}}">Chi tiết >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br><br>
        <div class="row">
            <img class="img-thumbnail" style="border: none; padding: 0; border-radius: 0;"
                 src="{{asset('img/test1.jpeg')}}">
        </div>
        <section class="pt-large" id="features">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading" data-nekoanim="fadeInUp" data-nekodelay="10">
                        <h1><span>Tại sao chọn TuvanHoc</span>Tính năng nổi bật</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 pb">
                        <div class="clearfix">
                            <div class="feature-box media-left" data-nekoanim="fadeInLeft" data-nekodelay="100">
                                <i class="icon-glyph-227 large"></i>
                                <div class="feature-box-content">
                                    <h3>Câu hỏi đa dạng</h3>
                                    <p>
                                        Trắc nghiệm nhân cách NEO, trắc nghiệm hứng thú nghề nghiệp RIASEC, trắc nghiệm
                                        sàng lọc
                                        khó khăn tâm lý...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 pb">
                        <div class="clearfix">
                            <div class="feature-box media-left" data-nekoanim="fadeInRight" data-nekodelay="300">
                                <i class="icon-glyph-207 large"></i>
                                <div class="feature-box-content">
                                    <h3>Nhanh chóng</h3>
                                    <p>
                                        Hiển thị kết quả ngay sau khi làm trắc nghiệm...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 pb">
                        <div class="clearfix">
                            <div class="feature-box media-left" data-nekoanim="fadeInRight" data-nekodelay="500">
                                <i class="icon-glyph-221 large"></i>
                                <div class="feature-box-content">
                                    <h3>Cập nhật thường xuyên</h3>
                                    <p>
                                        Dữ liệu câu hỏi được cập nhật thường xuyên, liên tục...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-large" id="questions">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 heading" data-nekoanim="fadeInUp" data-nekodelay="10">
                        <h1><span>Bạn có thực sự hiểu mình</span>Trắc nghiệm</h1>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 pb">
                        <div class="clearfix">
                            <div class="feature-box media-left" data-nekoanim="fadeInLeft" data-nekodelay="100">
                                <i class="icon-glyph-113 large"></i>
                                <div class="feature-box-content">
                                    <h3>Trắc nghiệm nhân cách NEO</h3>
                                    <p>
                                        Đánh giá toàn diện nhân cách thanh niên và người trưởng thành.
                                    </p>
                                    <a href="{{route('question.neo-test')}}">Bắt đầu >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 pb">
                        <div class="clearfix">
                            <div class="feature-box media-left" data-nekoanim="fadeInRight" data-nekodelay="300">
                                <i class="icon-glyph-115 large"></i>
                                <div class="feature-box-content">
                                    <h3>Trắc nghiệm hứng thú nghề nghiệp RIASEC</h3>
                                    <p>
                                        Bộ trắc nghiệm này giúp cho bạn tự phát hiện được các kiểu người trội nhất
                                        đang tiềm ẩn trong con người mình để tự định hướng khi lựa chọn nghề.
                                    </p>
                                    <a href="{{route('question.riasec-test')}}">Bắt đầu >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 pb">
                        <div class="clearfix">
                            <div class="feature-box media-left" data-nekoanim="fadeInRight" data-nekodelay="500">
                                <i class="icon-glyph-114 large"></i>
                                <div class="feature-box-content">
                                    <h3>Trắc nghiệm sàng lọc khó khăn tâm lý</h3>
                                    <p>
                                        Bài đánh giá giúp bạn đưa ra những khó khăn về trạng thái tâm lý.
                                    </p>
                                    <a href="{{route('question.psychology-test')}}">Bắt đầu >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- services -->
        <br><br><br>
    </main>
@endsection
@section('script')
    <script>
        $(function () {
            $('#home').addClass('active');
        })
    </script>
@endsection