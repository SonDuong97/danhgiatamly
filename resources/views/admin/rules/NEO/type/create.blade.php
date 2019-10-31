@extends('adminlte::page')

@section('title', 'Create Explain Question RIASEC')

@section('content_header')
    <h1>
        NEO Type Rule
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        {{--<li><a href="{{ route('rules.index') }}"><i class="fa fa-info"></i> List Explain Question RIASEC</a></li>--}}
        <li class="active">Create NEO Type Rule</li>
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
    <form class="form" method="POST" action="{{route('neotyperule.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Create Explain Question Content RIASEC</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label>Type: </label>
                    <select class="form-control" name="type" required>
                        @if(isset($typeNeos))
                            @foreach($typeNeos as $typeNeo)
                                <option value="{{$typeNeo->id}}">{{$typeNeo->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label>Questions</label>
                    <select multiple class="form-control" name="question[]" required>
                        @if(isset($questionNeos))
                            @foreach($questionNeos as $questionNeo)
                                <option value="{{$questionNeo->id}}">{!! $questionNeo->content !!}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="row">
                    <div class="box-footer">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-success btn-lg">Create</button>
                            <a type="button" class="btn btn-primary btn-lg" href="{{route('neorule.index')}}">Cancel</a>
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