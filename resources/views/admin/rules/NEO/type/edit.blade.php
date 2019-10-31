@extends('adminlte::page')

@section('title', 'Edit NEO Type Rule')

@section('content_header')
    <h1>
        Edit NEO Type Rule
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('neorule.index') }}">NEO Type Rule</a></li>
        <li class="active">Edit NEO Type Rule</li>
    </ol>users
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
    @if(!empty($neoTypeRule))
        <form class="form" method="POST" action="{{route('neotyperule.update', ['id' => $neoTypeRule->id])}}"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit NEO Type Rule</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label>Type:</label>
                        <select class="form-control" name="type-id" required>
                            @if(isset($typeNeos))
                                @foreach($typeNeos as $typeNeo)
                                    <option value="{{$typeNeo->id}}" @if($neoTypeRule->type_id == $typeNeo->id) {{'selected'}} @endif>{{$typeNeo->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Question:</label>
                        <select class="form-control form-select-query" name="questionId[]" multiple required>
                            @if(isset($questionNEOs))
                                @foreach($questionNEOs as $questionNEO)
                                    <option value="{{$questionNEO->id}}" @foreach(json_decode($neoTypeRule->content, true) as $questionId) @if($questionId == $questionNEO->id) {{'selected'}} @endif @endforeach>
                                        {{$questionNEO->id}}. {!! $questionNEO->content !!}
                                    </option>
                                @endforeach
                            @endif
                        </select>
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
    @endif
@stop

@section('css')
    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.form-select-query').select2();
        });
    </script>
@stop