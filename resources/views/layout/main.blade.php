<html lang="pl">
    <head>
        <title>
            @yield('title', $applicationName)
        </title>
    </head>
    <body>
        <h1>{{ $applicationName }}</h1>

        <div class="sidebar">
            @section('sidebar')
                <ul>
                    <li><a href="#">...</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">...</a></li>
                </ul>
            @show
        </div>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
