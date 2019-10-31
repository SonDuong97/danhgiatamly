@extends('adminlte::page')

@section('title', 'Edit Question Psychology')

@section('content_header')
    <h1>
        Edit Question Psychology
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('psychology.index') }}"><i class="fa fa-info"></i> List Question Psychology</a></li>
        <li class="active">Edit Question Psychology</li>
    </ol>
@stop

@section('content')
    <form class="form" method="POST" action="{{route('psychology.update',['id' => $question->id])}}"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Question Psychology</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="form-group">
                    <label>Type :</label>
                    <select class="form-control" name="type_psychology_id">
                        @foreach($types as $type)
                            @if($question->type_psychology_id == $type->id)
                                <option value="{{$type->id}}" selected>{{$type->content}}</option>
                            @else
                                <option value="{{$type->id}}">{{$type->content}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- text input -->
                <div class="form-group">
                    <label>Content:</label>
                    <textarea name="content" class="form-control " id="editor1"> {!! $question->content !!}</textarea>
                </div>
                <div class="row">
                    <div class="box-footer">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-success btn-lg">Update</button>
                            <a type="button" class="btn btn-primary btn-lg"
                               href="{{route('psychology.index')}}">Cancel</a>
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