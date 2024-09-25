<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Hari</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="hari" name="form[hari]" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
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
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Waktu Awal</label>
    <div class="col-md-9 p-0">
        <div class="input-group">
            <input type="text" class="form-control" id="timepicker" name="form[jam_awal]" placeholder="pilih waktu awal">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fa fa-clock"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Waktu Akhir</label>
    <div class="col-md-9 p-0">
        <div class="input-group">
            <input type="text" class="form-control" id="timepicker2" name="form[jam_akhir]" placeholder="pilih waktu akhir">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="fa fa-clock"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Ruang</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan ruangan" name="form[lokasi]">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Submateri</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="submateri" name="form[id_submateri]" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <?php foreach ($submateri as $key): ?>
                <option value="<?= $key['id']; ?>"><?= $key['submateri']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Pengajar</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="ustadz" name="form[id_ustadz]" class="form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <?php foreach ($ustadz as $key): ?>
                <option value="<?= $key['id']; ?>"><?= $key['fullname']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<input type="hidden" name="form[id_kelas]" value="<?= $idKelas; ?>">