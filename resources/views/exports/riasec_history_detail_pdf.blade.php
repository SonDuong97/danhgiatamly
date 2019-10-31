<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description"
          content="Quick Quiz is a simple and powerful test and/or survey creator which resulting product can be published in an HTML page.">
    <meta name="author" content="ilovemedia-es">
    <meta name="keywords" content="quiz,test,survey,application,javascript,html,questions,multiple choice,pairing,">
    <meta property="fb:admins" content="1534071063"/>
    <!-- Mobile Specific Metas ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS ================================================== -->
    <!-- web font  -->
    <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <!-- Neko framework  -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/custom-icons.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/external-plugins.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/neko-framework-layout.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link type="text/css" rel="stylesheet" id="color" href="{{asset('css/neko-framework-color.css')}}">
    <!-- Favicons ================================================== -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/apple-touch-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/apple-touch-icon-144x144.html')}}">
    <!-- <link rel="stylesheet" href="http://basehold.it/30"> -->
    <script src="{{asset('js/modernizr.custom.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('css/master.css')}}">
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-ui-1.8.23.custom.min.js')}}"></script>
    <!-- external framework plugins -->
    <script type="application/javascript" src="{{asset('js/external-plugins.min.js')}}"></script>
    <!-- neko framework script -->
    <script type="text/javascript" src="{{asset('js/neko-framework.js')}}"></script>
    <script src="{{asset('js/readmore.js')}}"></script>
    <!-- neko custom script -->
    <script src="{{asset('js/custom.js')}}"></script>
</head>
<body>
<div id="content">
    <div class="container">
        <div class="col-md-offset-1 col-md-10">
            <div class="row heading">
                <h2><span>Kết quả đánh giá hứng thú nghề nghiệp của {{$user_name}}</span></h2>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if(!empty($history))
                        <div class="row text-center">
                            <h2><span>{{$history->created_at}}</span></h2>
                            <div>
                                <h5>Điểm trung bình các lĩnh vực</h5>
                                @foreach(json_decode($history->result, true) as $name => $score)
                                    <p><b>{{$name}}: </b>{{$score}}</p>
                                @endforeach
                                @if(!empty($exRiasecQuestions))
                                    <h5>Chi tiết từng lĩnh vực</h5>
                                    @foreach($exRiasecQuestions as $exRiasecQuestion)
                                        <div class="text-justify">
                                            <b>{{$exRiasecQuestion->type}}</b>
                                            {!! $exRiasecQuestion->content !!}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br><br>
</div>
</body>
</html>

<style>
    body {
        font-family: DejaVu Sans !important;
    }
</style>