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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<div id="timeLine"></div>
<!-- JavaScript-->
<script src="{{ url('timeline/js/timeline.js') }}"></script>
<script>
    options = {
        script_path:                "",
        height:                     400,
        layout:                     "landscape",    // portrait or landscape
        timenav_position:           "bottom",       // timeline on top or bottom
        optimal_tick_width:         30,            // optimal distance (in pixels) between ticks on axis
        base_class:                 "",
        timenav_height:             300,
        timenav_height_percentage:  30,             // Overrides timenav height as a percentage of the screen
        timenav_height_min:         300,            // Minimum timenav height
        marker_height_min:          30,             // Minimum Marker Height
        marker_width_min:           40,            // Minimum Marker Width
        marker_padding:             10,              // Top Bottom Marker Padding
        start_at_slide:             0,
        menubar_height:             0,
        skinny_size:                20,
        relative_date:              false,          // Use momentjs to show a relative date from the slide.text.date.created_time field
        use_bc:                     false,          // Use declared suffix on dates earlier than 0
        // animation
        duration:                   500,
        ease:                       TL.Ease.easeInOutQuint,
        // interaction
        dragging:                   true,
        trackResize:                true,
        map_type:                   "stamen:toner-lite",
        slide_padding_lr:           100,            // padding on slide of slide
        slide_default_fade:         "0%",           // landscape fade
        language:                   "en"
    };

    // Will need to make a post or at least add patient ID to get particular patient record
    $.get( "{{ url('timeline/test-data.json') }}", function( data ) {
        var timeline = new TL.Timeline('timeLine', data, options);
        window.onresize = function(event) {
            timeline.updateDisplay();
        }
    });


</script>
</body>
</html>