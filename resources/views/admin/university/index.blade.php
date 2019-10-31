@extends('adminlte::page')

@section('title', 'List Explains Question RIASEC ')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('content_header')
    <h1>
        List Universites
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Universites</li>
    </ol>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12" style="padding-bottom: 5px;">
                <a href="{{route('university.create')}}"
                   class="col-xs-2 col-xs-offset-1 btn btn-success btn-lg pull-right"> Create
                    University</a>
            </div>
            <div class="col-xs-4" style="padding-bottom: 5px;">

            </div>
            <div class="col-xs-12">
                @if(count($universities))
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">List University</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Speciality</th>
                                    <th>Created at</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($universities as $key => $university)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {!! $university->name !!}
                                        </td>
                                        <td>
                                            @foreach(json_decode($university->speciality, true) as $speciality)
                                                {{$speciality . ', '}}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$university->created_at->format('H:i:s D, M, Y ')}}
                                        </td>
                                        <td>
                                            <a href="{{route('university.edit',['id' => $university->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('university.delete', ['id' => $university->id])}}"
                                               onclick="return confirm('Are you sure delete university?')"
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
                                {{ $universities->links() }}
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                @else
                    <div><h1> Sorry, no universities </h1></div>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@stop