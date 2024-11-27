<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Gambar</label>
    <div class="col-md-9 p-0">
        <div class="input-file input-file-image">
            <img src="<?= base_url() . 'showImg/santri/' . $content['image'] ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/profile.jpg';" alt="preview" class="img-upload-preview img-circle" width="100" height="100" id="imgPreview">
            <input type="file" class="form-control form-control-file" id="uploadImg" name="image" accept="image/*" required="">
            <label for="uploadImg" class="btn btn-primary btn-round btn-lg"><i class="fa fa-file-image"></i> Pilih gambar</label>
        </div>
    </div>
</div>
<input type="hidden" name="form[id]" value="<?= $content['id']; ?>">