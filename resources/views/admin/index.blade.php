@extends('admin/base')

@section('title', 'SBCDS Admin')

@section('content')
    <section id="main">
        <div class="row">
            @include('admin/nav')
            <div class="col-md-10 col-md-offset-2 col-sm-8 col-sm-offset-4 col-xs-12" id="content">
                <div class="table-row">
                    <h1 class="initial-greeting">Welcome, {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h1>
                </div>
            </div>
        </div>
    </section>
    {{--Login messages--}}
    @if (session('message-with-error'))
        <script type="text/javascript">
            $(function() {
                pNotifyMessage("Something went wrong", "{{ session('message-with-error') }}", "error");
            });
        </script>
    @endif
    @if (session('message-with-warning'))
        <script type="text/javascript">
            $(function() {
                pNotifyMessage("Warning", "{{ session('message-with-warning') }}", null)
            });
        </script>
    @endif
    @if (session('message-with-success'))
        <script type="text/javascript">
            $(function() {
                pNotifyMessage('Welcome', '{{ session('message-with-success') }}', 'success');
            });
        </script>
    @endif
@endsection