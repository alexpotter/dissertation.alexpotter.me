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
    <link rel="stylesheet" href="{{ url('timeline/timeline.css') }}">
    {{--<link rel="stylesheet" href="{{ url('dist/frontend/css/timeline.css') }}">--}}
    <!-- Style-->
    <style>
        html, body {
            height:100%;
            width:100%;
            padding: 0px;
            margin: 0px;
        }
        #patient_data {
            height: 300px;
            display: block;
            position: relative;
        }
        #timeLine {
            height:600px;
            width:100%;
            display: block;
            position: relative;
            float: left;
        }


    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML elements-->
    <!--if lt IE 9
    script(src='https://html5shim.googlecode.com/svn/trunk/html5.js')

    -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- JavaScript-->
    <script src="{{ url('timeline/timeline.js') }}"></script>

    <script type="text/javascript">
        var timeline;
        var data;

        // Called when the Visualization API is loaded.
        function drawVisualization() {
            // Create a JSON data table
            data = [];

            @foreach($patientData as $data)
                var date = new Date({{ $data['start']['year'] }}, {{ $data['start']['month'] }}, {{ $data['start']['day'] }});
                date.setMonth(date.getMonth() + 1);
                data.push({
                    "start": new Date(date),
                    "content": '{{ $data['content'] }}',
                    "group": '{{ $data['group'] }}',
                    "type": '{{ $data['type'] }}'
                });
            @endforeach

            // specify options
            var options = {
                'width':  '100%',
                'height': '500px',
                'start': new Date(1982, 0, 1),
                'end': new Date(2012, 11, 31),
                'cluster': true,
                'editable': false
            };

            // Instantiate our timeline object.
            timeline = new links.Timeline(document.getElementById('mytimeline'), options);

            // Draw our timeline with the created data and options
            timeline.draw(data);
        }
        console.log(new Date(2012, 11, 31));
    </script>
</head>
<body onload="drawVisualization();">
<div id="patient_data">
    <h1 style="text-align: center">Patient Data here</h1>
    <h2 style="text-align: center">{{ $patientId }}</h2>
</div>
<div id="mytimeline"></div>
</body>
</html>