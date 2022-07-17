<!-- Modal Room Form -->
<div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="mb-3">
                        <img class="img-thumbnail img-preview" alt="...">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="room_image" id="customFile" onchange="previewImage()">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" name="room_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Deskripsi</label>
                        <textarea class="form-control" name="room_description"></textarea>
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

<!-- Delete Room Modal -->
<div class="modal fade" id="deleteRoomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/delete-room">
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

<script>
    function previewImage() {
        let imageLabel = document.querySelector('.custom-file-label');
        let imageInput = document.querySelector('.custom-file-input');
        let imageElement = document.querySelector('.img-thumbnail.img-preview');

        const fileReader = new FileReader();
        imageLabel.textContent = imageInput.files[0].name;
        fileReader.readAsDataURL(imageInput.files[0]);

        fileReader.onload = function(e) {
            imageElement.src = e.target.result;
        }
    }
</script>