<header class="menu-header navbar-fixed-top">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- hamburger button -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- / hamburger button -->
                <!-- Logo -->
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('img/logo-black.png')}}" alt="TuvanHoc" class="main-logo"/>
                    <img src="{{asset('img/logo-white.png')}}" alt="TuvanHoc" class="main-logo-light"/>
                </a>
                <!-- /Logo -->
            </div>
            <div class="collapse navbar-collapse">
                <!-- Main navigation -->
                <ul class="nav navbar-nav navbar-right">
                    <li id="home">
                        <a href="{{route('home')}}">Trang chủ</a>
                    </li>
                    <li id="question">
                        <a href="{{route('question')}}" class="has-sub-menu">Trắc nghiệm</a>
                    </li>
                    <li id="introduction">
                        <a href="{{route('introduction')}}">Giới thiệu</a>
                    </li>
                    @if(Auth::check())
                        <li id="user">
                            <a href="#" class="has-sub-menu">{{Auth::user()->name}}</a>
                            <ul class="sub-menu">
                                @role('superadministrator|administrator|technicaladministrator')
                                    <li><a href="{{route('admin.index')}}">Trang quản trị</a></li>
                                @endrole
                                <li><a href="{{route('profile')}}">Trang cá nhân</a></li>
                                <li><a href="{{route('history')}}">Lịch sử</a></li>
                            </ul>
                        </li>
                        <li class="menu-action">
                            <a href="{{route('logout')}}" class="btn btn-primary btn small">Đăng xuất</a>
                        </li>
                    @else
                        <li><a href="{{route('register')}}">Đăng ký</a></li>
                        <li class="menu-action"><a href="{{route('login')}}" class="btn btn-primary btn small">Đăng
                                nhập</a>
                        </li>
                    @endif
                </ul>
                <!-- / End main navigation -->
            </div>
        </nav>
    </div>
</header>