@extends('layouts.master')

@section('title')
    <title>Profile</title>
@endsection

@section('content')
    <div class="little-neko-preloader little-neko-sk-cube-grid little-neko-preloader-centered"
         data-logo="{{asset('img/logo-black.png')}}"></div>
    <main id="content">
        <img class="img-thumbnail" style="border: none; padding: 0; border-radius: 0"
             src="{{asset('img/info.jpeg')}}">
        <br><br><br><br>
        @if(isset($user) && isset($profile))
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 text-center heading">
                        @if(!empty($message))
                            <div class="alert alert-danger">
                                <p>{{$message}}</p>
                            </div>
                        @endif
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
                        @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        <img src="{{asset($profile->avatar_path)}}" class="main-logo img-circle" style="width: 150px"/>
                        <h2>
                            <span><b>{{$user->name}}</b></span>
                            <span>Họ tên: {{$profile->fullname}}</span>
                            <span>Trường: {{$profile->university}}</span>
                            <span>Chuyên ngành: {{$profile->speciality}}</span>
                            <span>Email: {{$user->email}}</span>
                            <span>Số điện thoại: {{$profile->phone_number}}</span>
                            <span>Giới tính: {{$profile->sex}}</span>
                            <span>Ngày sinh: {{$profile->birthday}}</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Chỉnh sửa
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Cập nhật thông tin cá nhân</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row required">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Tên tài khoản:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input name="username" type="text" class="form-control" value="{{$user->name}}"
                                               required>
                                    </div>
                                </div>
                                <br>
                                <div class="row required">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Họ tên đầy đủ:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input name="fullname" type="text" class="form-control"
                                               placeholder="e.g Nguyen Van A"
                                               value="{{$profile->fullname}}"
                                               minlength="5"
                                               required>
                                    </div>
                                </div>
                                <br>
                                <div class="row required">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Trường:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input type="text" name="universityName" id="university" list="universityId" url="{{route('speciality')}}" class="form-control" placeholder="Chọn trường..." value="{{$profile->university}}">
                                        <datalist id="universityId">
                                            @if(!empty($universities))
                                                @foreach($universities as $university)
                                                    <option value="{{$university->name}}"></option>
                                                @endforeach
                                            @endif
                                        </datalist>
                                    </div>
                                </div>
                                <br>
                                <div class="row required">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Chuyên ngành:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input type="text" name="speciality" id="speciality" list="specialityId" class="form-control" placeholder="Chọn chuyên ngành..." value="{{$profile->speciality}}" required>
                                        <datalist id="specialityId">
                                            @if(!empty($profile->university) && json_decode(\App\Helpers\Helper::getUniversityByName($profile->university)))
                                                @foreach(json_decode(\App\Helpers\Helper::getUniversityByName($profile->university)->speciality, true) as $speciality)
                                                    <option value="{{$speciality}}"></option>
                                                @endforeach
                                            @endif
                                        </datalist>
                                    </div>
                                </div>
                                <br>
                                <div class="row required">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Số điện thoại:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input name="phone-number" type="text" class="form-control"
                                               placeholder="e.g 0123456798"
                                               value="{{$profile->phone_number}}" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row required">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Giới tính:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <select class="form-control" name="sex" required>
                                            <option value="Nam" @if($profile->sex == 'Nam') {{'selected'}} @endif>
                                                Nam
                                            </option>
                                            <option value="Nữ" @if($profile->sex == 'Nữ') {{'selected'}} @endif>
                                                Nữ
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row required">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Ngày sinh:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input name="birthday" type="date" class="form-control"
                                               placeholder="e.g 2000-01-31"
                                               value="{{$profile->birthday}}" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-5 control-label"><b>Ảnh đại diện:</b></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input type="file" class="form-control" name="avatar" onchange="loadImg(event)">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col-sm-5 col-xs-5"></div>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <div class="text-center">
                                            <img id="img-output" style="width: 200px"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button type="Submit" class="btn btn-default">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <br><br>
    </main>
@endsection
@section('script')
    <script>
        var loadImg = function (event) {
            var imgOutput = document.getElementById('img-output');
            imgOutput.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        $(function () {
            $('#user').addClass('active');

            $('#university').change(function () {
                // $('#speciality').find('option').remove().end().append('<option value="">Chọn chuyên ngành...</option>');
                $('#speciality').val("");
                var universityName = $(this).val();
                var url = $(this).attr('url');
                if (universityName != '') {
                    $.ajax({
                        url: url,
                        data: {
                            universityName: universityName
                        },
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            $('#specialityId').empty();
                            if (response != "") {
                                $.each(response, function (index, value) {
                                    $('#specialityId').append($('<option>', {
                                        value: value,
                                        text: value
                                    }));
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection