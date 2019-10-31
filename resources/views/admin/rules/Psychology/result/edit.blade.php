@extends('adminlte::page')

@section('title', 'Edit Psychology Result Rule')

@section('content_header')
    <h1>
        Edit Psychology Result Rule
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('psychologyrule.index') }}">Psychology Result Rule</a></li>
        <li class="active">Edit Psychology Result Rule</li>
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
          action="{{route('psychologyresultrule.update',['id' => $psychologyResultRule->id])}}"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Psychology Result Rule</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label>Type:</label>
                    <select class="form-control" name="type-id" required>
                        @if(isset($typePsychologies))
                            @foreach($typePsychologies as $typePsychology)
                                <option value="{{$typePsychology->id}}" @if($psychologyResultRule->type_id == $typePsychology->id) {{'selected'}} @endif>{{$typePsychology->content}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Average value:</label>
                    <input name="average-value" value="{{$psychologyResultRule->average_value}}" class="form-control"
                           placeholder="e.g 7.178" required>
                </div>
                <div class="form-group">
                    <label>Error value:</label>
                    <input name="error-value" value="{{$psychologyResultRule->error_value}}" class="form-control"
                           placeholder="e.g 3.178" required>
                </div>
                <div class="row">
                    <div class="box-footer">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-success btn-lg">Update</button>
                            <a type="button" class="btn btn-primary btn-lg"
                               href="{{route('psychologyrule.index')}}">Cancel</a>
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