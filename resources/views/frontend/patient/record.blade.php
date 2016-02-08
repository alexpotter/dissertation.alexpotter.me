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
    <script src="{{ url('assets/js/all.js') }}"></script>
    <!-- CSS-->
    <link rel="stylesheet" href="{{ url('timeline/timeline.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/frontend/timeline.css') }}">
    <link href="{{ url('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/pnotify.css') }}" rel='stylesheet'>


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
                    localStorage.setItem("eventId", row);

                    var data = timeline.getData(row).Gf[0].c;
                    localStorage.setItem("eventData", JSON.stringify(data));
                    $('#patientNotesHiddenButton').trigger('click');
                }
            }
            if (sel[0].cluster || sel[0].cluster != undefined) {
                console.log("cluster " + sel[0].cluster + " selected");
                localStorage.setItem("eventId", sel[0].cluster);

                var data = timeline.getCluster(sel[0].cluster);
                var items = data.items;
                localStorage.setItem("clusterData", JSON.stringify(items));

                $('#clusterEventsHiddenButton').trigger('click');
            }
        }

        $(function() {
            // Bootstrap modal
            $('#patientNotes').on('show.bs.modal', function (event) {
                var eventId = localStorage.eventId; // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

                $.ajax({
                    url: '{{ url('patient/get/event') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "data": JSON.parse(localStorage.getItem('eventData'))
                    }
                }).done(function(data) {
                    pNotifyMessage('Success', 'Patient notes successfully gathered', 'success');
                }).fail(function(jqXHR, status, thrownError) {
                    var responseText = jQuery.parseJSON(jqXHR.responseText);
                    pNotifyMessage('Something went wrong', responseText['error'], 'error');
                });

                var modal = $(this)
                modal.find('.modal-title').text('Event ' + eventId);
                modal.find('.modal-body input').val(eventId);
                modal.find(
                        '#eventInputFromButton').html('Row clicked: ' + eventId
                        + '<br>Now fire AJAX request to get notes. Map time line ID to event ID. Local storage?'
                );
            });

            // Bootstrap modal
            $('#clusterEvents').on('show.bs.modal', function (event) {var typeClicked = localStorage.eventType;
                var eventId = localStorage.eventId; // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

                var events = JSON.parse(localStorage.getItem('clusterData'));
                console.log(events);

                var modal = $(this)
                modal.find('.modal-title').text('Event ' + eventId);
                modal.find('.modal-body input').val(eventId);
                modal.find(
                        '#eventInputFromButton').html('Cluster clicked: ' + eventId
                        + '<br>Now fire AJAX request to get notes. Map time line ID to event ID. Local storage?'
                );
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
<button type="button" id="clusterEventsHiddenButton" class="btn btn-primary" data-toggle="modal" data-target="#clusterEvents" style="display: none;"></button>
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
<div class="modal fade" id="clusterEvents" tabindex="-1" role="dialog" aria-labelledby="patientNotesLabel">
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