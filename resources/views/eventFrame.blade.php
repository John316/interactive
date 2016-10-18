<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Interactive</title>
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/app.js"></script>
        @yield('head')
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="active"><a href="/">Home</a></li>
                        <li role="presentation"><a href="{{ action("PagesController@about") }}">About</a></li>
                        <li role="presentation"><a href="{{ action("PagesController@contact") }}">Contact</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">Interactive</h3>
            </div>

            @yield('content')

            <footer class="footer">
                <p>&copy; 2016 Company, Inc.</p>
            </footer>
        </div> <!-- /container -->

    </body>
</html>