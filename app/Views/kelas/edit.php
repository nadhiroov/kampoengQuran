<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Nama Kelas</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nama kelas" name="form[nama_kelas]" value="phpp">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Tahun ajaran</label>
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