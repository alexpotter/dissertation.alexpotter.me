<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- jQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link href="{{ url('assets/css/app.css') }}" rel="stylesheet">

    <!-- CSS -->
    <link href="{{ url('assets/css/admin/style.css') }}" rel="stylesheet">

    <!--  Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!--  Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

    <!--pNotify-->
    <link href="{{ url('assets/css/pnotify.css') }}" rel='stylesheet'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div id="container">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ url( 'assets/js/bootstrap.js' ) }}"></script>
<script src="{{ url('assets/js/all.js') }}"></script>
<script src="{{ url('assets/js/admin/functions.js') }}"></script>

</body>
</html>