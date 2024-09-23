<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Hari</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="basic" name="form[hari]" class="form-control select2-hidden-accessible" data-select2-id="basic" tabindex="-1" aria-hidden="true">
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jum'at">Jum'at</option>
            <option value="Sabtu">Sabtu</option>
            <option value="Ahad">Ahad</option>
        </select>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label>Input Time Picker</label>
        <div class="input-group">
            <input type="text" class="form-control" id="timepicker" name="timepicker">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fa fa-clock"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Waktu Awal</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan tahun ajaran" name="form[tahun_ajaran]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Semester</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nama semester" name="form[semester]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Pengajar</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="basic" name="form[id_ustadz]" class="form-control select2-hidden-accessible" data-select2-id="basic" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <?php foreach ($ustadz as $key): ?>
                <option value="<?= $key['id']; ?>"><?= $key['fullname']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>