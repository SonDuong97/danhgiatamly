@extends('adminlte::page')

@section('title', 'List Psychology Result Rules')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('content_header')
    <h1>
        List Psychology Rules
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Psychology Rules</li>
    </ol>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-7">
                                <h3 class="box-title">List Psychology Result Rules</h3>
                            </div>
                            <div class="col-md-5 text-right">
                                <a href="{{route('psychologyresultrule.create')}}" class="btn btn-success btn-sm">New
                                    Result Rule</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Type</th>
                                <th>Average value</th>
                                <th>Error value</th>
                                <th style="width: 40px">Edit</th>
                                <th style="width: 40px">Delete</th>
                            </tr>
                            @if(isset($psychologyResultRules))
                                @foreach ($psychologyResultRules as $key => $psychologyResultRule)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {!! \App\Helpers\Helper::getTypePsychologyById($psychologyResultRule->type_id)->content !!}
                                        </td>
                                        <td>
                                            {!! $psychologyResultRule->average_value !!}
                                        </td>
                                        <td>
                                            {!! $psychologyResultRule->error_value !!}
                                        </td>
                                        <td>
                                            <a href="{{route('psychologyresultrule.edit',['id' => $psychologyResultRule->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('psychologyresultrule.delete', ['id' => $psychologyResultRule->id])}}"
                                               onclick="return confirm('Are you sure delete psychology rule?')"
                                               class="btn btn-block btn-danger btn-sm">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-7">
                                <h3 class="box-title">List Psychology Answer Rules</h3>
                            </div>
                            <div class="col-md-5 text-right">
                                <a href="{{route('psychologyanswerrule.create')}}" class="btn btn-success btn-sm">New
                                    Answer Rule</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Score</th>
                                <th style="width: 40px">Edit</th>
                                <th style="width: 40px">Delete</th>
                            </tr>
                            @if(isset($psychologyAnswerRules))
                                @foreach ($psychologyAnswerRules as $key => $psychologyAnswerRule)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {!! \App\Helpers\Helper::getTypePsychologyById($psychologyAnswerRule->type_id)->content !!}
                                        </td>
                                        <td>
                                            {!! $psychologyAnswerRule->name !!}
                                        </td>
                                        <td>
                                            {!! $psychologyAnswerRule->score !!}
                                        </td>
                                        <td>
                                            <a href="{{route('psychologyanswerrule.edit',['id' => $psychologyAnswerRule->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('psychologyanswerrule.delete', ['id' => $psychologyAnswerRule->id])}}"
                                               onclick="return confirm('Are you sure delete psychology rule?')"
                                               class="btn btn-block btn-danger btn-sm">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.col -->
    </section>
@stop
@section('scripts')
    <script> console.log('Hi!'); </script>
@stop