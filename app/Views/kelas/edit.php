<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Nama Kelas</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nama kelas" name="form[nama_kelas]" value="<?= $content['nama_kelas']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Tahun ajaran</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan tahun ajaran" name="form[tahun_ajaran]" value="<?= $content['tahun_ajaran']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Semester</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="semesterEdit" name="form[semester]" class="form-control select2-hidden-accessible" data-select2-id="semester" tabindex="-1" aria-hidden="true">
            <option value="" disabled >Pilih Semester</option>
            <option <?= $content['semester'] == 1 ? 'selected' : ''; ?> value="1">1</option>
            <option <?= $content['semester'] == 2 ? 'selected' : ''; ?> value="2">2</option>
            <option <?= $content['semester'] == 3 ? 'selected' : ''; ?> value="3">3</option>
            <option <?= $content['semester'] == 4 ? 'selected' : ''; ?> value="4">4</option>
            <option <?= $content['semester'] == 5 ? 'selected' : ''; ?> value="5">5</option>
            <option <?= $content['semester'] == 6 ? 'selected' : ''; ?> value="6">6</option>
            <option <?= $content['semester'] == 7 ? 'selected' : ''; ?> value="7">7</option>
            <option <?= $content['semester'] == 8 ? 'selected' : ''; ?> value="8">8</option>
        </select>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Pengajar</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="ustadzEdit" name="form[id_ustadz]" class="form-control select2-hidden-accessible" data-select2-id="basic" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <?php foreach ($ustadz as $key): ?>
                <option <?= $content['id_ustadz'] == $key['id'] ? 'selected' : ''; ?> value="<?= $key['id']; ?>"><?= $key['fullname']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<input type="hidden" name="form[id]" value="<?= $content['id']; ?>">