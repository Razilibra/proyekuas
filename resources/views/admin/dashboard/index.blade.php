@extends('admin.pages.home') <!-- Assuming you're extending the main layout -->

@section('title', 'Dashboard')

<!-- Include FullCalendar CSS and JS via CDN -->
@section('content')

    <!-- FullCalendar CSS and JS CDN -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.js'></script>

    <div class="col-md-12">
        <h2 >Dashboard</h2>
        <!-- Calendar Placeholder -->
        <div id='calendar'></div>

        @if(session('welcome'))
    <div class="alert alert-success" role="alert">
        {{ session('welcome') }}
    </div>
@endif


    <div class="container">

        <div class="row">
            <!-- Dashboard Content -->

            </div>
        </div>
    </div>

    <!-- Script to initialize FullCalendar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // You can change this to week/day view
                events: [  // Example static events
                    {
                        title: 'Event 1',
                        start: '2024-10-10'
                    },
                    {
                        title: 'Event 2',
                        start: '2024-10-15',
                        end: '2024-10-17'
                    },
                    {
                        title: 'Meeting',
                        start: '2024-10-18T10:30:00',
                        end: '2024-10-18T12:30:00'
                    }
                ]
            });
            calendar.render();
        });
    </script>

    <!-- Custom Styles or other includes -->
    @include('include.style')

@endsection
