<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="{{ URL::to('css/bootstrap.css') }}" rel="stylesheet">
    {{-- <link href="{{ URL::to('css/styles.css') }}" rel="stylesheet"> --}}
    <title>Application</title>
</head>
    <body>
        @include('navs.navbar')
        <div class="container">
            @yield('adminContent')
            @yield('content')
        </div>
    </body>
</html>