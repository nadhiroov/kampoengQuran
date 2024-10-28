<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Username</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan username" name="form[username]" value="<?= $content['username']; ?>">
        <input type="hidden" name="form[id]" value="<?= $content['id']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">password</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan password" name="form[password]">
        <small id="emailHelp" class="form-text text-muted">Kosongkan jika tidak ingin merubah password</small>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Nama lengkap</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nama lengkap" name="form[fullname]" value="<?= $content['fullname']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Jenis Kelamin</label>
    <div class="col-md-9 p-0">
        <select id="basic" name="form[gender]" class="form-control" data-select2-id="basic" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <option value="Pria" <?= $content['gender'] == 'Pria' ? 'selected' : ''; ?>>Pria</option>
            <option value="Wanita" <?= $content['gender'] == 'Wanita' ? 'selected' : ''; ?>>Wanita</option>
        </select>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
    <div class="col-md-9 p-0">
        <input type="email" class="form-control input-full" placeholder="masukkan email" name="form[email]" value="<?= $content['email']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Gambar</label>
    <div class="col-md-9 p-0">
        <div class="input-file input-file-image">
            <img class="img-upload-preview img-circle" id="imgPreview" width="100" height="100" src="<?= base_url('showImg/ustadz/') . $content['image'] ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/profile.jpg';" alt="preview">
            <input type="file" class="form-control form-control-file" id="uploadImg" name="image" accept="image/*">
            <label for="uploadImg" class="btn btn-primary btn-round btn-lg"><i class="fa fa-file-image"></i> Pilih gambar</label>
            <small id="emailHelp" class="form-text text-muted">Biarkan jika tidak ingin merubah gambar</small>
        </div>
    </div>
</div>