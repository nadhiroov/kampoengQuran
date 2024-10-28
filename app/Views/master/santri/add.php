<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">NIS</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nis" name="form[nis]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Nama lengkap</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nama lengkap" name="form[fullname]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Angkatan</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan tahun masuk" name="form[angkatan]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Tanggal lahir</label>
    <div class="input-group col-md-9 p-0">
        <input type="text" class="form-control" id="datepicker" name="form[tanggal_lahir]">
        <div class="input-group-append">
            <span class="input-group-text">
                <i class="fa fa-calendar-check"></i>
            </span>
        </div>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Username</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan username" name="form[username]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">password</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan password" name="form[password]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Jenis Kelamin</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="basic" name="basic" class="form-control select2-hidden-accessible" data-select2-id="basic" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <option value="Pria">Pria</option>
            <option value="Wanita">Wanita</option>
        </select>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Email</label>
    <div class="col-md-9 p-0">
        <input type="email" class="form-control input-full" placeholder="masukkan email" name="form[email]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">No Hp</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nomor hp" name="form[phone]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Alamat Asal</label>
    <div class="col-md-9 p-0">
        <textarea name="form[alamat_asal]" class="form-control" rows="2"></textarea>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Alamat Domisili</label>
    <div class="col-md-9 p-0">
        <textarea name="form[alamat_domisili]" class="form-control" rows="2"></textarea>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Gambar</label>
    <div class="col-md-9 p-0">
        <div class="input-file input-file-image">
            <img class="img-upload-preview img-circle" id="imgPreview" width="100" height="100" src="http://placehold.it/100x100" alt="preview">
            <input type="file" class="form-control form-control-file" id="uploadImg" name="image" accept="image/*" required="">
            <label for="uploadImg" class="btn btn-primary btn-round btn-lg"><i class="fa fa-file-image"></i> Pilih gambar</label>
        </div>
    </div>
</div>