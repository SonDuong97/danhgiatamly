@extends('adminlte::page')

@section('title', 'NEO Rule Setting')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('content_header')
    <h1>
        NEO Rule Setting
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">NEO Rule Setting</li>
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
                                <h3 class="box-title">NEO Type Rule Table</h3>
                            </div>
                            <div class="col-md-5 text-right">
                                <a href="{{route('neotyperule.create')}}" class="btn btn-success btn-sm">New Type
                                    Rule</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Type</th>
                                <th>Question</th>
                                <th style="width: 40px">Edit</th>
                                <th style="width: 40px">Delete</th>
                            </tr>
                            @if(isset($neoTypeRules))
                                @foreach($neoTypeRules as $key => $neoTypeRule)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{App\Helpers\Helper::getTypeNEOById($neoTypeRule->type_id)->name}}</td>
                                        <td>
                                            @foreach(json_decode($neoTypeRule->content) as $questionId)
                                                {{$questionId . ', '}}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{route('neotyperule.edit',['id' => $neoTypeRule->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('neotyperule.delete', ['id' => $neoTypeRule->id])}}"
                                               onclick="return confirm('Are you sure delete NEO rule?')"
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
                                <h3 class="box-title">NEO Result Rule Table</h3>
                            </div>
                            <div class="col-md-5 text-right">
                                <a href="{{route('neoresultrule.create')}}" class="btn btn-success btn-sm">New Result
                                    Rule</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Sex</th>
                                <th>Level</th>
                                <th>Type</th>
                                <th>Score</th>
                                <th style="width: 40px">Edit</th>
                                <th style="width: 40px">Delete</th>
                            </tr>
                            @if(isset($neoResultRules))
                                @foreach($neoResultRules as $key => $neoResultRule)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$neoResultRule->sex}}</td>
                                        <td>{{$neoResultRule->level}}</td>
                                        <td>{{App\Helpers\Helper::getTypeNEOById($neoResultRule->type_id)->name}}</td>
                                        <td>{{$neoResultRule->score}}</td>
                                        <td>
                                            <a href="{{route('neoresultrule.edit',['id' => $neoResultRule->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('neoresultrule.delete', ['id' => $neoResultRule->id])}}"
                                               onclick="return confirm('Are you sure delete NEO rule?')"
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
    </section>
@stop
@section('scripts')
    <script> console.log('Hi!'); </script>
@stop