<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Hari</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="edithari" name="form[hari]" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <option <?= $content['hari'] == 'Senin' ? 'selected' : ''; ?> value="Senin">Senin</option>
            <option <?= $content['hari'] == 'Selasa' ? 'selected' : ''; ?> value="Selasa">Selasa</option>
            <option <?= $content['hari'] == 'Rabu' ? 'selected' : ''; ?> value="Rabu">Rabu</option>
            <option <?= $content['hari'] == 'Kamis' ? 'selected' : ''; ?> value="Kamis">Kamis</option>
            <option <?= $content['hari'] == 'Jum\'at' ? 'selected' : ''; ?> value="Jum'at">Jum'at</option>
            <option <?= $content['hari'] == 'Sabtu' ? 'selected' : ''; ?> value="Sabtu">Sabtu</option>
            <option <?= $content['hari'] == 'Ahad' ? 'selected' : ''; ?> value="Ahad">Ahad</option>
        </select>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Waktu Awal</label>
    <div class="col-md-9 p-0">
        <div class="input-group">
            <input type="text" class="form-control" id="timepicker" name="form[jam_awal]" placeholder="pilih waktu awal" value="<?= date('H:i', strtotime($content['jam_awal'])); ?>">
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
            <input type="text" class="form-control" id="timepicker2" name="form[jam_akhir]" placeholder="pilih waktu akhir" value="<?= date('H:i', strtotime($content['jam_akhir'])); ?>">
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
        <input type="text" class="form-control input-full" placeholder="masukkan ruangan" name="form[lokasi]" value="<?= $content['lokasi']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Materi</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="editmateri" name="form[id_materi]" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <?php foreach ($materi as $key): ?>
                <option <?= $content['id_materi'] == $key['id'] ? 'selected' : ''; ?> value="<?= $key['id']; ?>"><?= $key['materi']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Pengajar</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="editustadz" name="form[id_ustadz]" class="form-control" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <?php foreach ($ustadz as $key): ?>
                <option <?= $content['id_ustadz'] == $key['id'] ? 'selected' : ''; ?> value="<?= $key['id']; ?>"><?= $key['fullname']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<input type="hidden" name="form[id]" value="<?= $id_edit; ?>">