<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<?= dd($loans) ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Ruangan</h1>
    <a href="#" data-toggle="modal" data-target="#roomModal" data-modal-type="insert" data-action="/admin/insert-room" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i>Add New Room</a>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($loans as $loan) : ?>
                        <tr>
                            <td><?= $loan['start_time'] ?></td>
                            <td><?= $loan['end_time'] ?></td>
                            <td><?= $loan['status'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('components/modal_room_form') ?>
<?= $this->endSection() ?>