@extends('adminlte::page')

@section('title', 'Create Explain Question RIASEC')

@section('content_header')
    <h1>
        New University
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        {{--<li><a href="{{ route('rules.index') }}"><i class="fa fa-info"></i> List Explain Question RIASEC</a></li>--}}
        <li class="active">Create University</li>
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
    <form class="form" method="POST" action="{{route('university.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Create University</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <label>University:</label>
                    <input name="university" class="form-control" placeholder="e.g Bách khoa Hà Nội" required>
                </div>
                <div class="form-group">
                    <label>Speciality:</label>
                    <div class="text-left">
                        <button type="button" class="btn btn-default" id="addButton"><span
                                    class="fa fa-plus-square"></span></button>
                        <button type="button" class="btn btn-default" id="removeButton"><span
                                    class="fa fa-minus-square"></span></button>
                    </div>
                </div>
                <div class="speciality-container">
                    <div class="speciality-row">
                        <div class="form-group">
                            <input type="text" class="form-control" name="speciality[]"
                                   placeholder="e.g Công nghệ thông tin" required/>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-success btn-lg">Create</button>
                        <a type="button" class="btn btn-primary btn-lg" href="{{route('university.index')}}">Cancel</a>
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
        var $container = $('.speciality-container');
        var $row = $('.speciality-row');
        var $add = $('#addButton');
        var $remove = $('#removeButton');
        var $focused;

        $container.on('click', 'input', function () {
            $focused = $(this);
        });

        $add.on('click', function () {
            var $newRow = $row.clone().insertAfter('.speciality-row:last');
            $newRow.find('input').each(function () {
                this.value = '';
            });
        });

        $remove.on('click', function () {
            if (!$focused) {
                alert('Select a row to delete');
                return;
            }

            var $currentRow = $focused.closest('.speciality-row');
            if ($currentRow.index() === 0) {
                alert("You can't remove first row");
            } else {
                $currentRow.remove();
                $focused = null;
            }
        });
    </script>
@stop