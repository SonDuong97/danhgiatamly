@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>
        Edit User
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('user.index') }}"><i class="fa fa-info"></i> List User</a></li>
        <li class="active">Edit Question NEO</li>
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
    @if(isset($user))
        <form class="form" method="POST" action="{{route('user.update', ['id' => $user->id])}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit User</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label>Username:</label>
                        <input name="username" value="{{$user->name}}" class="form-control" placeholder="e.g Customer"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Role:</label>
                        <select class="form-control" name="role" required>
                            @if(isset($roles))
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" @if($user->hasRole($role->name)) {{'selected'}} @endif>{{ucfirst($role->name)}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row">
                        <div class="box-footer">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-lg">Update</button>
                                <a type="button" class="btn btn-primary btn-lg"
                                   href="{{route('user.index')}}">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </form>
    @endif
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