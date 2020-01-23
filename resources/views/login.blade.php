<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kohort') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('Semantic-UI-CSS-master/semantic.min.css') }}">
    <script src="{{ asset('Semantic-UI-CSS-master/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('Semantic-UI-CSS-master/semantic.min.js') }}"></script>
    <title>@yield('title')</title>
</head>

<body>
    <div class="ui four column centered grid">
        <div class="column">
            <div class="ui raised segment">
                {{-- <h2 class="ui teal image header"> --}}
                {{-- <img src="assets/images/logo.png" class="image"> --}}
                {{-- <div class="content"> --}}
                {{-- bristi. --}}
                {{-- </div> --}}
                {{-- </h2> --}}

                <h2 class="ui center aligned icon header">
                    <i class="circular users teal inverted icon"></i>
                    bristi.
                </h2>

                <form class="ui large form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="ui  segment">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="text" name="email" placeholder="E-mail address" value="{{ old('email') }}">
                            </div>

                            @if ($errors->has('email'))
                            <span class="ui pointing red basic label">
                                {{ $errors->first('email') }}
                            </span>

                            @endif


                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Password">
                            </div>

                            @if ($errors->has('password'))
                            <span class="ui pointing red basic label">
                                {{ $errors->first('password') }}
                            </span>

                            @endif



                        </div>

                    </div>
                    <br>
                    <br>
                    <input class="fluid ui teal submit button" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<style type="text/css">
    body {
        background-color: #DADADA;
    }

    .ui.grid {
        height: 100%;
        /* margin-top: 50px; */
        padding-top: 7%;
    }

    /* body>.grid {
        height: 100%;
    }

    .image {
        margin-top: -100px;
    }

    .column {
        max-width: 450px;
    } */
</style>