@extends('layouts.master')

@section('title')
    <title>Introduction</title>
@endsection

@section('content')
    <div class="little-neko-preloader little-neko-sk-cube-grid little-neko-preloader-centered"
         data-logo="{{asset('img/logo-black.png')}}"></div>
    <main id="content">
        <img class="img-thumbnail" style="border: none; padding: 0; border-radius: 0"
             src="{{asset('img/introduction.jpeg')}}">
        <br><br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center heading">
                    <h2><a href="#"><img src="{{asset('img/logo-black.png')}}" alt="QuickQuiz Examples" text-center
                                         class="main-logo"/></a>
                    </h2>
                </div>
            </div>
            <div class="container text-justify">
                <div class="row">
                    <div class="col-md-8 col-md-push-2">
                        <h3>Bạn có biết?</h3>
                        <p>
                            Ngày nay sự phát triển của kinh tế, xã hội và công nghệ thông tin, sức khỏe thể chất cũng
                            như tinh thần của mọi người nói chung và trẻ em nói riêng ngày càng được nâng cao và chú
                            trọng hơn. Liên quan đến sức khỏe tâm lý có rất nhiều vấn đề mà học sinh, sinh viên gặp
                            phải: các vấn đề về mặt cảm xúc – hành vi, khó khăn liên quan đến học tập, định hướng nghề
                            nghiệp, các mối quan hệ, v.v.
                        </p>
                        <p>
                            Một bài nghiên cứu trước đó đã chỉ ra: có 71,1% tổng số khách thể nghiên cứu đã chọn mức
                            “rất cần thiết” khi được hỏi về nhu cầu tham vấn trong học tập; 35,8% trong lĩnh vực về bản
                            thân và 29,2% trong mối quan hệ với bạn bè, v.v. Khi được khảo sát về mong muốn nhà trường
                            có phòng tư vấn tâm lý, 56,7% tổng số khách thể đã lựa chọn “thường xuyên đến xin ý kiến
                            chuyên gia về các vấn đề của mình”.
                        </p>
                        <p>
                            Trong một nghiên cứu tại Úc khảo sát thái độ của cộng đồng trong việc sử dụng điện thoại di
                            động để theo dõi và quản lý trầm cảm, lo âu và stress; kết quả chỉ ra rằng: 76% khách thể
                            báo cáo rằng họ quan tâm đến việc sử dụng điện thoại di động để theo dõi sức khỏe tâm thần
                            và tự quản lý nếu dịch vụ này miễn phí, đảm bảo các quy định về riêng tư và an toàn.
                        </p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8 col-md-push-2">
                        <h3>TuvanHoc giúp gì cho bạn?</h3>
                        <p>
                            Hệ thống này cho phép người sử dụng kiểm tra được những vấn đề tâm lý mà đang gặp phải và
                            người được trắc nghiệm sẽ có cơ hội được hiểu rõ về bản thân mình hơn. Có thể là cảm xúc,
                            tình cảm, nhân cách, năng lực… hoặc là những khó khăn trong tâm lý của bản thân.
                        </p>
                        <p>
                            Chúng ta phải công nhận với nhau một điều là tâm lý con người hết sức trừu tượng và ta không
                            thể dễ dàng nắm bắt, sờ mó như một cái ghế hay một cái bàn. “Dò sông, dò biển dễ dò. Ai đời
                            lấy thước mà đo lòng người.” Ông bà ta có câu nói như thế âu cũng là vì lẽ này. Tuy nhiên
                            ông bà không ngờ rằng con cháu bây giờ có thế lấy thước mà đo lòng người được cơ chứ. Đúng
                            là “hậu sinh khả úy”! Vâng và cây thước để đo lòng người ấy không phải cái gì khác mà chính
                            là Test tâm lý mà nãy giờ chúng ta đang tìm hiểu. Bởi lẽ thông qua những kết quả giải chúng,
                            một số đặc điểm hay phẩm chất tâm lý của người tham gia trắc nghiệm sẽ được bộc lộ và nhờ
                            đó, người sử dụng công cụ này sẽ đo, đếm được những hiện tượng mà chúng ta không thể sờ mó
                            trực tiếp như đối với một số đối tượng, sự vật khác được. Vì thế trắc nghiệm có vai trò rất
                            lớn trong việc xét tuyển đầu vào của các trường học, hoặc là việc xét tuyển nhân sự ở các
                            công ty, xí nghiệp, cũng như trong việc chẩn đoán và điều trị ở các bệnh viện… Ngoài ra, qua
                            trắc nghiệm tâm lý, người được trắc nghiệm sẽ có cơ hội được hiểu rõ về bản thân mình hơn.
                            Có thể là trí tuệ, hay là cảm xúc, tình cảm, nhân cách, năng lực… của bản thân mà lâu nay nó
                            vẫn còn mầm mờ sau bức rèm đen mà ta hằng muốn nhìn mặt. Và chính vì điều này mà trắc nghiệm
                            có những ảnh hưởng rất tinh tế và sâu sắc trên đời sống và thậm chí là có thể thay đổi cả
                            cuộc đời của người được trắc nghiệm. Ví dụ như một người có khả năng về hội họa mà xưa nay
                            người đó không biết. Và vì không biết nên người đó không dám tự tin hoặc là không để ý đến
                            lĩnh vực mà ông trời vốn đã giành cho mình. Nhưng khi được trắc nghiệm và được cho biết là
                            người đó có khả năng để trở thành một người họa sĩ tài ba nếu biết trau dồi, gọt dũa tài
                            năng, thì từ đó có thể xuất hiện một người họa sĩ tài ba dần dần dẫn dắt nhân loại đến với
                            cái chân – thiện – mỹ.
                        <p>
                            Có rất nhiều loại trắc nghiệm khác nhau và ngày càng nhiều thêm dưới sự nghiên cứu của các
                            chuyên gia soạn thảo trắc nghiệm. Website được thiết kế với mong muốn có thể cung cấp cho
                            người dùng một số bài trắc nghiệm tâm lí học phổ biến để tử đó có thể đánh giá một cách
                            khách quan về bản thân.
                        </p>
                        </p>
                    </div>
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
            $('#introduction').addClass('active');
        })
    </script>
@endsection