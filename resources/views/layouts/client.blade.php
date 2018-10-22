<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('css/client.css') }}">
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet" id="bootstrap-css">


    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="{{ URL::asset('css/waitMe.min.css') }}" rel="stylesheet"/>
    <title>Turbado</title>

    <!-- Styles -->

</head>
<body>
<div id="app">
    <div class="container">
        <br>
        <img class="" src="{{ URL::asset('images/logo.png') }}">
        <hr>
        <div class="container">
            <div class="row">
                @if(isset($menu))
                <ul class="nav nav-tabs" role="tablist">


                        @foreach($menu as $menu_items)
                            <li role="presentation" class="nav-item">
                                @if($menu_items['active']==true)
                                    <a class="nav-link active"> {{@$menu_items['menu_title'] }}</a>
                                @else
                                    <a class="nav-link" href="#"
                                       style="color:#e1e1e1;"> {{@$menu_items['menu_title'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    @endif

                </ul>

            </div>
        </div>
    </div>
    <script src="{{ URL::asset('js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/waitMe.min.js') }}"></script>
    <script src="{{ URL::asset('js/client.js') }}"></script>
    <div style="margin-top:20px;">
        @yield('content')
    </div>
</div>


</body>
</html>
