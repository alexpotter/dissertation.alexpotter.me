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
    <script type="text/javascript" src="{{ url('assets/js/google.js') }}"></script>
    <!-- CSS-->
    <link rel="stylesheet" href="{{ url('timeline/timeline.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/frontend/timeline.css') }}">

    <script type="text/javascript">
        google.load("visualization", "1");

        // Set callback to run when API is loaded
        google.setOnLoadCallback(drawVisualization);

        var timeline;
        var data;

        function getSelectedRow() {
            var row = undefined;
            var sel = timeline.getSelection();
            if (sel.length) {
                if (sel[0].row != undefined) {
                    row = sel[0].row;
                }
            }
            return row;
        }

        // Called when the Visualization API is loaded.
        function drawVisualization() {
            // Clear local storage
            localStorage.clear();

            // Create a JSON data table
            // Create and populate a data table.
            data = new google.visualization.DataTable();
            data.addColumn('datetime', 'start');
            data.addColumn('string', 'content');
            data.addColumn('string', 'group');
            data.addColumn('string', 'type');
            data.addColumn('string', 'className');

            data.addRows([
                    @foreach($patientData as $data)
                        [new Date({{ $data['start']['year'] }}, {{ $data['start']['month'] - 1 }}, {{ $data['start']['day'] }}, {{ $data['start']['hour'] }}, {{ $data['start']['minute'] }}, {{ $data['start']['second'] }}, 0), '{{ $data['content'] }}', '{{  $data['group'] }}', '{{ $data['type'] }}', '{{  $data['cssClass'] }}'],
                    @endforeach
            ]);

            // specify options
            var options = {
                'width':  '100%',
                'cluster': true,
                'editable': false,
                'groupsOrder': true,
                'stackEvents': true,
                'snapEvents': true,
                'step': true,
                'showNavigation': true,
                'groupsOrder': true,
                'clusterMaxItems': '{{ $timeLineClusterMaxSettings[0]->setting }}'
            };

            // Instantiate our time line object.
            timeline = new links.Timeline(document.getElementById('patientTimeLine'), options);

            // Add event listeners
            google.visualization.events.addListener(timeline, 'select', onSelect);

            // Draw our time line with the created data and options
            timeline.draw(data);
        }

        var onSelect = function (event) {
            // The ID of the time line is the index of the array returned from controller

            var row = getSelectedRow();

            if (row != undefined) {
                console.log("item " + row + " selected");
                // Note: you can retrieve the contents of the selected row with
                //       data.getValue(row, 2);
            }
            else {
                console.log("no item selected");
            }
        };
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