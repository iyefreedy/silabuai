<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

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
                        <th>Foto</th>
                        <th>Nama Ruangan</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Ruangan</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($rooms as $room) : ?>
                        <tr>
                            <td><img class="img-thumbnail" width="150" src="<?= base_url() ?>/uploads/images/rooms/<?= $room['image'] ?>" alt="<?= $room['room_slug'] ?>"></td>
                            <td><?= $room['room_name'] ?></td>
                            <td><?= $room['room_description'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center flex-wrap">
                                    <!-- Show modal -->
                                    <a href="#" data-toggle="modal" data-target="#roomModal" data-modal-type="show" data-action="" data-id="<?= $room['id'] ?>" data-room-name="<?= $room['room_name'] ?>" data-room-description="<?= $room['room_description'] ?>" data-room-image="<?= $room['image'] ?>" class="btn btn-info btn-sm m-1"><i class="fas fa-eye fa-xs"></i></a>
                                    <!-- Edit modal -->
                                    <a href="#" data-toggle="modal" data-target="#roomModal" data-modal-type="edit" data-action="/admin/edit-room" data-id="<?= $room['id'] ?>" data-room-name="<?= $room['room_name'] ?>" data-room-description="<?= $room['room_description'] ?>" data-room-image="<?= $room['image'] ?>" class="btn btn-warning btn-sm m-1"><i class="fas fa-pen fa-xs"></i></a>
                                    <!-- Delete modal -->
                                    <a href="#" data-toggle="modal" data-target="#deleteRoomModal" data-action="/admin/delete-room" data-id="<?= $room['id'] ?>" data-room-name="<?= $room['room_name'] ?>" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt fa-xs"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('components/modal_room_form') ?>
<?= $this->endSection() ?>