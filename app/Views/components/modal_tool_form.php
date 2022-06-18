<!-- Modal Tool Form -->
<div class="modal fade" id="toolModal" tabindex="-1" aria-labelledby="toolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="toolModalLabel">Tambah Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for=""></label>
                        <select name="room_id" class="form-control">
                            <?php foreach ($rooms as $room) : ?>
                                <option value="<?= $room['id'] ?>"><?= $room['room_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Alat</label>
                        <input type="text" class="form-control" name="tool_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Kuantitas</label>
                        <input type="number" class="form-control" name="tool_quantity">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Deskripsi</label>
                        <textarea class="form-control" name="tool_description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete tool Modal -->
<div class="modal fade" id="deleteToolModal" tabindex="-1" aria-labelledby="toolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="toolModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/admin/delete-tool">
                <?= csrf_field() ?>
                <input type="hidden" name="id">
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>