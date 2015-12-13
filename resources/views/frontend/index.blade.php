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

    <!-- Bootstrap -->
    <link href="{{ url('/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ url('/dist/frontend/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <button id="openForm" class="btn btn-lg btn-primary"><h1 style="margin: 30px;">Search for patient</h1></button>
    </div>
</div>
<div id="search">
    <button type="button" class="close">×</button>
    <form id="patientSearchForm" name="patientSearch" method="post" action="{{ url('/patient/search') }}">
        <input name="patientName" id="patientName" type="search" value="" placeholder="Patient ID..." autocomplete="off">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
<script type="text/javascript">
    $(function () {
        $('#openForm').on('click', function(event) {
            event.preventDefault();
            $('#search').addClass('open');
            $('#search > form > input[type="search"]').focus();
        });

        $('#search, #search button.close').on('click keyup', function(event) {
            if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                $(this).removeClass('open');
            }
        });


        //Do not include! This prevents the form from submitting for DEMO purposes only!
        $('#patientSearchForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                        type: "POST",
                        url: '{{ url('patient/search') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            patientName: $('#patientName').val()
                        },
                        dataType: 'json'
                    })
                    .done(function(data) {
                        // Check if url returned or patients
                        window.location.href = data.url;
                    })
                    .fail(function(jqXHR, status, thrownError) {
                        var response = (jQuery.parseJSON(jqXHR.responseText));
                        alert(response.msg);
                    });
        })
    });
</script>
<script src="{{ url('/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>