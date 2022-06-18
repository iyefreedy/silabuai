<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pemakai</h1>
    <a href="#" data-toggle="modal" data-target="#userModal" data-modal-type="insert" data-action="/insert-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50 mr-1"></i>Add New User</a>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>

                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>

                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <?php if ($user['id'] !== $current_user->id) : ?>
                            <tr>

                                <td><?= $user['email'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center flex-wrap">
                                        <a href="#" data-toggle="modal" data-target="#userModal" data-modal-type="show" data-action="" data-id="<?= $user['id'] ?>" data-user-username="<?= $user['username'] ?>" data-user-email="<?= $user['email'] ?>" class="btn btn-info btn-sm m-1"><i class="fas fa-eye fa-xs"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#userModal" data-modal-type="edit" data-action="/edit-user" data-id="<?= $user['id'] ?>" data-user-username="<?= $user['username'] ?>" data-user-email="<?= $user['email'] ?>" class="btn btn-warning btn-sm m-1"><i class="fas fa-pen fa-xs"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#deleteuserModal" data-action="/delete-user" data-id="<?= $user['id'] ?>" data-user-username="<?= $user['username'] ?>" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt fa-xs"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('components/modal_user_form') ?>
<?= $this->endSection() ?>