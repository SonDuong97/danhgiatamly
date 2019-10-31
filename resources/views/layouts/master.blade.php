<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <!-- Basic Page Needs ================================================== -->
    <meta charset="utf-8">
    @yield('title')
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
    @yield('head')
</head>
<body class="activate-appear-animation nav-style-1 header-transparent">
<!-- global-wrapper -->
<div id="global-wrapper">
    <!-- header -->
@include('layouts.header')
<!-- header -->
    <!-- content -->
@yield('content')
<!-- content -->
    <!-- footer -->
@include('layouts.footer')
<!-- / footer -->
</div>
<!-- global wrapper -->
<!-- End Document ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery-ui-1.8.23.custom.min.js')}}"></script>
<!-- external framework plugins -->
<script type="application/javascript" src="{{asset('js/external-plugins.min.js')}}"></script>
<!-- neko framework script -->
<script type="text/javascript" src="{{asset('js/neko-framework.js')}}"></script>
<script src="{{asset('js/readmore.js')}}"></script>
<!-- neko custom script -->
<script src="{{asset('js/custom.js')}}"></script>
@yield('script')
</body>
</html>