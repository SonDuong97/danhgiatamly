@extends('adminlte::page')

@section('title', 'Edit NEO Result Rule')

@section('content_header')
    <h1>
        Edit NEO Result Rule
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('neorule.index') }}">NEO Result Rule</a></li>
        <li class="active">Edit NEO Result Rule</li>
    </ol>
@stop

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            Error!<br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form" method="POST"
          action="{{route('neoresultrule.update', ['id' => $neoResultRule->id])}}"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit NEO Result Rule</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label>Type:</label>
                    <select class="form-control" name="type-id" required>
                        @if(isset($typeNeos))
                            @foreach($typeNeos as $typeNeo)
                                <option value="{{$typeNeo->id}}" @if($neoResultRule->type_id == $typeNeo->id) {{'selected'}} @endif>{{$typeNeo->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Sex:</label>
                    <select class="form-control" name="sex" required>
                        <option value="Nam" @if($neoResultRule->sex == 'Nam') {{'selected'}} @endif>Nam</option>
                        <option value="Nữ" @if($neoResultRule->sex == 'Nữ') {{'selected'}} @endif>Nữ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Level:</label>
                    <select class="form-control" name="level" required>
                        <option value="Thấp" @if($neoResultRule->level == 'Thấp') {{'selected'}} @endif>Thấp</option>
                        <option value="Cao" @if($neoResultRule->level == 'Cao') {{'selected'}} @endif>Cao</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Score:</label>
                    <input name="score" value="{{$neoResultRule->score}}" class="form-control"
                           placeholder="e.g 3" required>
                </div>
                <div class="row">
                    <div class="box-footer">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-success btn-lg">Update</button>
                            <a type="button" class="btn btn-primary btn-lg"
                               href="{{route('neorule.index')}}">Cancel</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </form>
@stop

@section('css')
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@stop

@section('js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        CKEDITOR.replace('editor1', {
            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
        });

        $('document').ready(function () {
            $('.add_image').click(function () {
                $('.images').append('<input type="file" name="fImages[]"><br/>');
            });
        })
    </script>
@stop