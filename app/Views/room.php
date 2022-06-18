<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Ruangan</h1>
    <a href="#" data-toggle="modal" data-target="#loanModal" data-modal-type="insert" data-action="/insert-loan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i>Masukkan Jadwal</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <table id="calendar"></table>
    </div>
</div>

<?= view('components/modal_loan_form') ?>

<script src="<?= base_url() ?>/vendor/fullcalendar/main.js"></script>
<script>
    const calendarEl = document.querySelector('#calendar');
    document.addEventListener('DOMContentLoaded', function() {
        let calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            initialView: 'timeGridWeek',
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: false,
            },
            slotMinTime: "07:00:00",
            slotMaxTime: "22:00:00",
            slotDuration: "00:50:00",
            allDaySlot: false,
            themeSystem: 'bootstrap',
            locale: 'id',
            timeZone: 'Asia/Jakarta',
            expandRows: true,
            eventSources: [{
                url: '<?= route_to('api/loan') ?>',
                method: 'GET',
                extraParams: {
                    room_id: '<?= $room['id'] ?>'
                },
                failure: function(e) {
                    console.log(e);
                }
            }],
            events: [{
                    title: 'BCH237',
                    start: '2022-08-12T10:30:00',
                    end: '2022-08-12T11:30:00',
                    extendedProps: {
                        department: 'BioChemistry'
                    },
                    description: 'Lecture'
                }
                // more events ...
            ],
        })

        calendar.render()
    })
</script>


<?= $this->endSection() ?>