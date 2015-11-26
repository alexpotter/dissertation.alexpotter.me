<!DOCTYPE html>
<html lang="en">
<head>
    <title>Southampton Breast Cancer Data System</title>
    <meta charset="utf-8">
    <meta name="description" content="TimelineJS Embed">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- CSS-->
    <link rel="stylesheet" href="{{ url('timeline/css/timeline.css') }}">
    <!-- Style-->
    <style>
        html, body {
            height:100%;
            width:100%;
            padding: 0px;
            margin: 0px;
        }
        #timeLine {
            height:600px;
            width:100%;
        }


    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML elements-->
    <!--if lt IE 9
    script(src='https://html5shim.googlecode.com/svn/trunk/html5.js')

    -->
</head>
<body>
<div id="timeLine"></div>
<!-- JavaScript-->
<script src="{{ url('timeline/js/timeline.js') }}"></script>
<script>
    var timeLine = new TL.Timeline('timeLine', '{{ url('timeline/test-data.json') }}');
</script>
</body>
</html>