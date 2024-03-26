@extends('layouts.layout')

@section('content')
    <div id="calendar"></div>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                defaultView: 'month',
                events: [
                        @foreach($list as $task)
                    {
                        title: '{{$task->title}}',
                        start: '{{$task->date}}'
                    },
                    @endforeach
                ],
                dayClick: function(info) {
                    window.location.href = "{{ route('calendar', ':date') }}".replace(':date', info._d.getFullYear()+'-'+(info._d.getMonth()+1)+'-'+info._d.getDate());
                }
            });
        });
    </script>
@endsection
