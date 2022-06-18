<!-- Modal Loan Form -->
<div class="modal fade" id="loanModal" tabindex="-1" aria-labelledby="loanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loanModal">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= route_to('insert-loan') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="include_room" value="1" id="include-room">
                            <label class="form-check-label" for="include-room">
                                Pinjam Ruangan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start-time" class="col-form-label">Waktu Mulai</label>
                        <input type="text" class="form-control" name="start_time" id="start-time" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="end-time" class="col-form-label">Waktu Selesai</label>
                        <input type="text" class="form-control" name="end_time" id="end-time" autocomplete="off" readonly>
                    </div>
                    <?php foreach ($tools as $tool) : ?>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tool_id[]" value="<?= $tool['id'] ?>" id="defaultCheck<?= $tool['id'] ?>">
                                <label class="form-check-label" for="defaultCheck<?= $tool['id'] ?>">
                                    <?= $tool['tool_name'] ?>
                                </label>
                            </div>
                            <input type="number" max="<?= $tool['tool_quantity'] ?>" min="0" class="form-control" id="defaultInput<?= $tool['id'] ?>" name="tool_quantity[]" value="0" disabled>
                        </div>
                    <?php endforeach ?>
                    <div class="form-group">
                        <label for="description">Keperluan</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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