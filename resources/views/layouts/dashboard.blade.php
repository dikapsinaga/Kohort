<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kohort') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('Semantic-UI-CSS-master/semantic.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Semantic-UI-CSS-master/calendar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.semanticui.min.css')}}">
    <script src="{{ asset('Semantic-UI-CSS-master/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('Semantic-UI-CSS-master/semantic.min.js') }}"></script>
    <script src="{{ asset('Semantic-UI-CSS-master/calendar.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.semanticui.min.js')}}"></script>
    {{-- <script src="{{ asset('js/Chart.bundle.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" charset="utf-8"></script> --}}


    <title>App Name - @yield('title')</title>
</head>

<body>
    <side-bar class="ui visible inverted left vertical sidebar menu">
        <a class="item header ui" href="{{ url('/home') }}">
            <h3 class="ui inverted header">
                <i class="circular inverted user teal icon"></i>
                <div class="content">
                    {{ Auth::user()->name}}
                    @if (Auth::user()->role == 0)
                        <div class="sub header">Admin Puskesmas {{ Auth::user()->load('puskesmas')->puskesmas->nama}}</div>
                    @elseif (Auth::user()->role == 2)
                        <div class="sub header">Super Admin</div>
                    @else
                        <div class="sub header">Bidan Desa {{ Auth::user()->load('desa')->desa->nama}}</div>
                    @endif

                </div>
            </h3>

        </a>
        <a class="item" href="{{url('/home')}}">
            <i class="home icon"></i>Home
        </a>

        @if (Auth::user()->role == 1)
        <a class="item" href="{{url('/data')}}">
                <i class="bar chart icon"></i>Data
            </a>
            <a class="item" href="{{url('/pasien')}}">
                <i class="users icon"></i>Pasien
            </a>

        @endif

        @if (Auth::user()->role ==0)
            <a class="item" href="{{url('/admin/data')}}">
                <i class="bar chart icon"></i>Data
            </a>
            <a class="item" href="{{url('/admin/pasien')}}">
                <i class="users icon"></i>Pasien
            </a>
            <a class="item" href="{{url('/admin/users')}}">
                <i class="user plus icon"></i>Pengguna
            </a>
        @endif


        @if (Auth::user()->role == 2)
            <a class="item" href="{{url('/superAdmin/data')}}">
                <i class="bar chart icon"></i>Data
            </a>

            <a class="item" href="{{url('/superAdmin/pasien')}}">
                <i class="users icon"></i>Pasien
            </a>
        @endif

        {{-- <div class="ui simple dropdown item">
            <i class="sitemap icon"></i>
            Projects
            <div class="menu">
                <!-- ngRepeat: project in ProjectList --><a class="item ng-binding ng-scope"
                    ng-repeat="project in ProjectList" href="http://somename.com/projects/projectA">Project A <i
                        class="icon grey external"></i></a><!-- end ngRepeat: project in ProjectList --><a
                    class="item ng-binding ng-scope" ng-repeat="project in ProjectList"
                    href="http://somename.com/projects/projectB">Project B <i class="icon grey external"></i></a>
                <!-- end ngRepeat: project in ProjectList --><a class="item ng-binding ng-scope"
                    ng-repeat="project in ProjectList" href="http://somename.com/projects/projectC">Project C <i
                        class="icon grey external"></i></a><!-- end ngRepeat: project in ProjectList --><a
                    class="item ng-binding ng-scope" ng-repeat="project in ProjectList"
                    href="http://somename.com/projects/projectD">Project D <i class="icon grey external"></i></a>
                <!-- end ngRepeat: project in ProjectList --><a class="item ng-binding ng-scope"
                    ng-repeat="project in ProjectList" href="http://somename.com/projects/projectE">Project E <i
                        class="icon grey external"></i></a><!-- end ngRepeat: project in ProjectList --><a
                    class="item ng-binding ng-scope" ng-repeat="project in ProjectList"
                    href="http://somename.com/projects/projectF">Project F <i class="icon grey external"></i></a>
                <!-- end ngRepeat: project in ProjectList -->
            </div>
        </div> --}}
        <a class="item" href="{{route('logout')}}"
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="sign out icon"></i>Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </side-bar>


    <div class="pusher">
        <div class="ui bottom attachment segment pushable">
            <div class="ui header segment">
                @yield('nav')

            </div>
            <div class="pusher" id="main-content">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>

<style>
    .ui.header.segment {
        margin: 0;
        padding: 2em 2em;
        border: 0;
        border-radius: 0;
        box-shadow: 0;

    }

    #main-content {
        padding: 20px 40px;
        /* padding-bottom: 0; */
        width: 80%;
        /* height: 500px; */
        background-color: rgba(204, 204, 204, 0.25);
        /* background-color: white; */

    }

    .pushable {
        /* padding: 0 !important; */
    }
</style>