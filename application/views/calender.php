<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fullcalendar.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fullcalendar.print.min.css'); ?>" media="print" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <h3>Calendar</h3>
            </div>
            <div class="col-md-9">
                <div class="btn-group">
                    <button class="btn btn-primary" id="today">Today</button>
                    <button class="btn btn-primary" id="prev">Prev</button>
                    <button class="btn btn-primary" id="next">Next</button>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/fullcalendar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/locale-all.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: '',
                    right: 'today,prev,next'
                },
                defaultView: 'month',
                height: 'auto',
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: '<?php echo base_url('calendar/get_events'); ?>',
                        dataType: 'json',
                        data: {
                            start: start.format('YYYY-MM-DD'),
                            end: end.format('YYYY-MM-DD')
                        },
                        success: function(response) {
                            var events = [];
                            $.each(response, function(index, value) {
                                events.push({
                                    title: value.title,
                                    start: value.start,
                                    end: value.end,
                                    url: value.url
                                });
                            });
                            callback(events);
                        }
                    });
                }
            });

            $('#today').click(function() {
                $('#calendar').fullCalendar('today');
            });

            $('#prev').click(function() {
                $('#calendar').fullCalendar('prev');
            });

            $('#next').click(function() {
                $('#calendar').fullCalendar('next');
            });
        });
    </script>
</body>

</html>