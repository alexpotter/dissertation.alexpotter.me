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
    <script type="text/javascript" src="{{ url('assets/js/google.js') }}"></script><!-- Scripts -->
    <script src="{{ url( 'assets/js/bootstrap.js' ) }}"></script>
    <!-- CSS-->
    <link rel="stylesheet" href="{{ url('timeline/timeline.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/frontend/timeline.css') }}">
    <link href="{{ url('assets/css/app.css') }}" rel="stylesheet">

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
                'clusterMaxItems': {{ $timeLineClusterMaxSettings->setting }}
            };

            // Instantiate our time line object.
            timeline = new links.Timeline(document.getElementById('patientTimeLine'), options);

            // Add event listeners
            google.visualization.events.addListener(timeline, 'select', onSelect);

            // Draw our time line with the created data and options
            timeline.draw(data);
        }

        function onSelect() {
            var sel = timeline.getSelection();

            if (sel.length) {
                if (sel[0].row != undefined) {
                    var row = sel[0].row;
                    console.log("event " + row + " selected");
                    localStorage.setItem("eventType", "row");
                    localStorage.setItem("eventId", row);
                }
            }
            if (sel[0].cluster || sel[0].cluster != undefined) {
                console.log("cluster " + sel[0].cluster + " selected");
                localStorage.setItem("eventType", "cluster");
                localStorage.setItem("eventId", sel[0].cluster);
            }

            $('#patientNotesHiddenButton').trigger('click');
        }

        $(function() {
            // Bootstrap modal
            $('#patientNotes').on('show.bs.modal', function (event) {
                var typeClicked = localStorage.eventType;
                var eventId = localStorage.eventId; // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Event ' + eventId);
                modal.find('.modal-body input').val(eventId);
                modal.find('#eventInputFromButton').html(typeClicked + ' clicked: ' + eventId
                        + '<br>Now fire AJAX request to get notes. Map time line ID to event ID. Local storage?');
            });
        });
    </script>
</head>
<body onload="drawVisualization();">
<div id="patient_data">
    <h1 style="text-align: center">Patient Data here</h1>
    <h2 style="text-align: center">{{ $patientId }}</h2>
</div>
<div id="patientTimeLine"></div>
{{--Modal--}}
<button type="button" id="patientNotesHiddenButton" class="btn btn-primary" data-toggle="modal" data-target="#patientNotes" style="display: none;"></button>
<div class="modal fade" id="patientNotes" tabindex="-1" role="dialog" aria-labelledby="patientNotesLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">
                <div id="eventInputFromButton"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>