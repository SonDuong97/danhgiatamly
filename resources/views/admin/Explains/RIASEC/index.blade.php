@extends('adminlte::page')

@section('title', 'List Explains Question RIASEC ')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('content_header')
    <h1>
        List Explains Question RIASEC
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Explains Question RIASEC</li>
    </ol>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12" style="padding-bottom: 5px;">
                <a href="{{route('explainriasec.create')}}" class="col-xs-2 btn btn-success btn-lg pull-right"> Create
                    Explain </a>
            </div>
            <div class="col-xs-12">
                @if(count($exQuestionRIASECs) > 0)
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">List Explain Question RIASEC</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Type</th>
                                    <th>Content</th>
                                    <th>Created at</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($exQuestionRIASECs as $key => $exQuestionRIASEC)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {!! $exQuestionRIASEC->type !!}
                                        </td>
                                        <td>
                                            {!! $exQuestionRIASEC->content !!}
                                        </td>
                                        <td>
                                            {{$exQuestionRIASEC->created_at->format('H:i:s D, M, Y ')}}
                                        </td>
                                        <td>
                                            <a href="{{route('explainriasec.edit',['id' => $exQuestionRIASEC->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('explainriasec.delete', ['id' => $exQuestionRIASEC->id])}}"
                                               onclick="return confirm('Are you sure delete explain question RIASEC?')"
                                               class="btn btn-block btn-danger btn-sm">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="box-footer">
                            <div class="col-lg-offset-4">
                                {{ $exQuestionRIASECs->links() }}
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                @else
                    <div><h1> Sorry, no rules </h1></div>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@stop
@section('scripts')
    <script> console.log('Hi!'); </script>
@stop