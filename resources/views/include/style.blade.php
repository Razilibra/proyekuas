<link rel="stylesheet" href="{{ '/vendors/feather/feather.css' }}">
<link rel="stylesheet" href="{{ '/vendors/ti-icons/css/themify-icons.css' }}">
<link rel="stylesheet" href="{{ '/vendors/css/vendor.bundle.base.css' }}">
<!-- endinject -->
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{'/vendors/datatables.net-bs4/dataTables.bootstrap4.css'}}">
<link rel="stylesheet" href="{{ '/vendors/ti-icons/css/themify-icons.css' }}">
<link rel="stylesheet" type="text/css" href=""{{ 'js/select.dataTables.min.css' }}>
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="{{ '/css/vertical-layout-light/style.css' }}">
<!-- endinject -->
<link rel="shortcut icon" href="{{ '/images/favicon.png' }}" />


 <!-- plugins:js -->
 <script src="vendors/js/vendor.bundle.base.js"></script>
 <!-- endinject -->
 <!-- Plugin js for this page -->
 <script src="vendors/chart.js/Chart.min.js"></script>
 <script src="vendors/datatables.net/jquery.dataTables.js"></script>
 <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
 <script src="js/dataTables.select.min.js"></script>

 <!-- End plugin js for this page -->
 <!-- inject:js -->
 <script src="js/off-canvas.js"></script>
 <script src="js/hoverable-collapse.js"></script>
 <script src="js/template.js"></script>
 <script src="js/settings.js"></script>
 <script src="js/todolist.js"></script>
 <!-- endinject -->
 <!-- Custom js for this page-->
 <script src="js/dashboard.js"></script>
 <script src="js/Chart.roundedBarCharts.js"></script>
 <!-- End custom js for this page-->

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">







 <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // The type of view: month, week, day
                events: [  // Example events
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



