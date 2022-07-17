<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Alat</h1>
    <a href="#" data-toggle="modal" data-target="#toolModal" data-modal-type="insert" data-action="/admin/insert-tool" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i>Add New Tool</a>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Alat</th>
                        <th>Ruangan</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Alat</th>
                        <th>Ruangan</th>
                        <th>Deskripsi</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($tools as $tool) : ?>
                        <tr>
                            <td><img class="img-thumbnail" width="150" src="<?= base_url() ?>/uploads/images/tools/<?= $tool['image'] ?>" alt="<?= $tool['tool_name'] ?>"></td>
                            <td><?= $tool['tool_name'] ?></td>
                            <td><?= $tool['room_name'] ?></td>
                            <td><?= $tool['tool_description'] ?></td>
                            <td><?= $tool['tool_quantity'] ?></td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <!-- Show buton -->
                                    <a href="#" data-toggle="modal" data-target="#toolModal" data-modal-type="show" data-action="" data-id="<?= $tool['id'] ?>" data-room-id="<?= $tool['room_id'] ?>" data-tool-name="<?= $tool['tool_name'] ?>" data-tool-description="<?= $tool['tool_description'] ?>" data-tool-quantity="<?= $tool['tool_quantity'] ?>" data-tool-image="<?= $tool['image'] ?>" class="btn btn-info btn-sm m-1"><i class="fas fa-eye fa-xs"></i></a>
                                    <!-- Edit button -->
                                    <a href="#" data-toggle="modal" data-target="#toolModal" data-modal-type="edit" data-action="/admin/edit-tool" data-id="<?= $tool['id'] ?>" data-room-id="<?= $tool['room_id'] ?>" data-tool-name="<?= $tool['tool_name'] ?>" data-tool-description="<?= $tool['tool_description'] ?>" data-tool-quantity="<?= $tool['tool_quantity'] ?>" data-tool-image="<?= $tool['image'] ?>" class="btn btn-warning btn-sm m-1"><i class="fas fa-pen fa-xs"></i></a>
                                    <!-- Delete  button -->
                                    <a href="#" data-toggle="modal" data-target="#deleteToolModal" data-id="<?= $tool['id'] ?>" data-tool-name="<?= $tool['tool_name'] ?>" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt fa-xs"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?= view('components/modal_tool_form') ?>

<?= $this->endSection() ?>