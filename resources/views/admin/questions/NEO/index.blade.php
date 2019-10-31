@extends('adminlte::page')

@section('title', 'List Question NEO ')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">


@stop

@section('content_header')
    <h1>
        List Question NEO
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Question NEO</li>
    </ol>
@stop

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12" style="padding-bottom: 5px;">
                <a href="{{route('neo.create')}}" class="col-xs-2 col-xs-offset-1 btn btn-success btn-lg pull-right"> Create Question</a>
                <a href="{{route('neo.export')}}" class="col-xs-2 btn btn-lg btn-danger pull-right"><i class="fa fa-download"> Export </i>  </a>
            </div>
            <div class="col-xs-12">
                @if(count($questions) > 0)
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">List Question NEO</h3>
                            <br>
                            <br>
                            <i>Những câu bôi đen là những câu đảo đáp án tính điểm</i>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Content</th>
                                    <th>Created at</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($questions as $key => $question)
                                    <tr class="{{$question->reverse_score ? 'reverse-question' : ''}}">
                                        <td>
                                            {{$question->id}}
                                        </td>
                                        <td>
                                            {!! $question->content  !!}
                                        </td>
                                        <td>
                                            {{$question->created_at->format('H:i:s D, M, Y ')}}
                                        </td>
                                        <td>
                                            <a href="{{route('neo.edit',['id' => $question->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('neo.delete', ['id' => $question->id])}}"
                                               onclick="return confirm('Are you sure delete question NEO?')"
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
                                {{ $questions->links() }}
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