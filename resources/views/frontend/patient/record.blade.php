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

    <!-- HTML5 shim, for IE6-8 support of HTML elements-->
    <!--if lt IE 9
    script(src='https://html5shim.googlecode.com/svn/trunk/html5.js')

    -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- JavaScript-->
    <script src="{{ url('timeline/timeline.js') }}"></script>
    <!-- CSS-->
    <link rel="stylesheet" href="{{ url('timeline/timeline.css') }}">

    <script type="text/javascript">
        var timeline;
        var data;

        // Called when the Visualization API is loaded.
        function drawVisualization() {
            // Create a JSON data table
            data = [];

            @foreach($patientData as $data)
                var date = new Date({{ $data['start']['year'] }}, {{ $data['start']['month'] }}, {{ $data['start']['day'] }}, {{ $data['start']['hour'] }}, {{ $data['start']['minute'] }}, {{ $data['start']['second'] }}, 0);
                date.setMonth(date.getMonth() - 1);
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
                'cluster': true,
                'editable': false,
                'groupsOrder': false,
                'stackEvents': false,
                'snapEvents': true,
                'step': true,
                'showNavigation': true,
                'groupsOrder': true,
                'clusterMaxItems': 1
            };

            // Instantiate our timeline object.
            timeline = new links.Timeline(document.getElementById('patientTimeLine'), options);

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
<div id="patientTimeLine"></div>
</body>
</html>