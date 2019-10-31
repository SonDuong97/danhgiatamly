
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Hệ thống tư vấn tâm lý trực tuyến</h1>
@stop

@section('content')
    <p>Trang quản lí câu hỏi và người dùng.</p>
@stop

@section('css')
    <link rel="stylesheet" href="{{URL::asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop