<?php require '../app/views/layouts/header.php'; ?>
<?php require '../app/views/layouts/navbar.php'; ?>
<?php require '../app/views/layouts/sidebar.php'; ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Kalender Booking</h1>
    </div>
</section>

<section class="content">
<div class="container-fluid">

<div id="calendar"></div>

</div>
</section>

</div>

<!-- FULLCALENDAR CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',
        height: 650,

        events: "<?= BASEURL; ?>/booking/getEvents",

        eventClick: function(info) {

            alert(
                "Studio: " + info.event.title +
                "\nStatus: " + info.event.extendedProps.status +
                "\nID Booking: " + info.event.extendedProps.id_booking
            );

        }

    });

    calendar.render();
});
</script>

<?php require '../app/views/layouts/footer.php'; ?>