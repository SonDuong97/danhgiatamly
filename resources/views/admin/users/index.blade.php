@extends('adminlte::page')

@section('title', 'List Explains Question RIASEC ')
@section('css')
    <link rel="stylesheet" href="{{asset('css/admin_custom.css')}}">
@stop

@section('content_header')
    <h1>
        List Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">List Users</li>
    </ol>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12" style="padding-bottom: 5px;">
                <a href="{{route('user.create')}}" class="col-xs-2 col-xs-offset-1 btn btn-success btn-lg pull-right">
                    Create
                    User </a>
                <a href="{{route('user.export')}}" class="col-xs-2 btn btn-lg btn-danger pull-right"><i
                            class="fa fa-download"> Export </i> </a>
            </div>
            <div class="col-xs-4" style="padding-bottom: 5px;">

            </div>
            <div class="col-xs-12">
                @if(count($users) > 0)
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">List User</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{route('user.search')}}" method="get">
                                    {{--{{csrf_field()}}--}}
                                    <div class="input-group margin">
                                        <input value="{{app('request')->input('search-val')}}" type="text" name="search-val" class="form-control">
                                        <span class="input-group-btn"><button type="submit"
                                                                              class="btn btn-info btn-flat">Search</button></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Edit</th>
                                    <th>Block</th>
                                    <th>Delete</th>
                                    <th>History</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>
                                            {{$key + 1}}
                                        </td>
                                        <td>
                                            {!! $user->name !!}
                                        </td>
                                        <td>
                                            {!! $user->email !!}
                                        </td>
                                        <td>
                                            {{$user->created_at->format('H:i:s D, M, Y ')}}
                                        </td>
                                        <td>
                                            <a href="{{route('user.edit',['id' => $user->id])}}"
                                               class="btn btn-block btn-info btn-sm">
                                                <i class="fa fa-edit"></i>Edit
                                            </a>
                                        </td>
                                        <td>
                                            @if($user->status == 1)
                                                <a href="{{route('user.block', ['id' => $user->id])}}"
                                                   onclick="return confirm('Are you sure block user?')"
                                                   class="btn btn-block btn-warning btn-sm">
                                                    <i class="fa fa-unlock"></i>
                                                </a>
                                            @else
                                                <a href="{{route('user.unblock', ['id' => $user->id])}}"
                                                   onclick="return confirm('Are you sure unblock user?')"
                                                   class="btn btn-block btn-warning btn-sm">
                                                    <i class="fa fa-lock"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('user.delete', ['id' => $user->id])}}"
                                               onclick="return confirm('Are you sure delete user?')"
                                               class="btn btn-block btn-danger btn-sm">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('user.history', ['id' => $user->id])}}"
                                               class="btn btn-block btn-success btn-sm">
                                                <i class="fa fa-line-chart"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="col-lg-offset-4">
                                {{ $users->appends(['search-val' =>  app('request')->input('search-val')])->links() }}
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                @else
                    <div><h1> Sorry, no users </h1></div>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@stop