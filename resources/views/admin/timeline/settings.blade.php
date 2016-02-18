@extends('admin/base')

@section('title', 'SBCDS Admin')

@section('content')
    <section id="main">
        <div class="row">
            @include('admin/nav')
            <div class="col-md-10 col-md-offset-2 col-sm-8 col-sm-offset-4 col-xs-12" id="content">
                <div class="col-xs-12">
                    <h1 class="content-heading">Timeline Settings</h1>
                </div>
                <div class="col-xs-12">
                    <h2>Active event types</h2>
                    <table class="table table-hover" id="time-line-settings">
                        <tr>
                            <th>Specialty Code</th>
                            <th>Specialty</th>
                            <th>Enabled</th>
                        </tr>
                        @foreach($eventSpecialties as $eventSpecialty)
                            <tr id="eventRow{{ $eventSpecialty->id }}">
                                <td>{{ $eventSpecialty->specialty_code }}</td>
                                <td>{{ $eventSpecialty->specialty }}</td>
                                <td>
                                    <a href="#" onclick="enableDisableSpecialty({{ $eventSpecialty->id }}, event, this, '{{ url('admin/timeline/specialty/update') }}', '{{ csrf_token() }}')">
                                        {!! ($eventSpecialty->disabled) ? '<i class="fa fa-times red"></i>' : '<i class="fa fa-check green"></i>' !!}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-xs-12">
                    <h2>Timeline views</h2>
                </div>
                <div class="col-xs-12">
                    <div class="col-md-4">
                        <div class="row control-icon-box">
                            <div class="col-xs-3">
                                <i class="fa fa-object-group"></i>
                            </div>
                            <div class="col-xs-9">
                                Cluster Max.
                                <br>
                                <select id="clusterMaxEdit" onchange="updateTimeLineMaxCluster(this.value, event, '{{ url('admin/timeline/cluster-max/update') }}', '{{ csrf_token() }}');" class="form-control" style="width: auto;">
                                    @for($count = 1; $count <= 10; $count ++)
                                        @if ($count == $timeLineClusterMaxSetting[0]->setting)
                                            <option value="{{ $count }}" selected>{{ $count }}</option>
                                        @else
                                            <option value="{{ $count }}">{{ $count }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="col-xs-12">
                                <p class="description">
                                    {{ $timeLineClusterMaxSetting[0]->description }}
                                </p>
                            </div>
                        </div>
                    </div>
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