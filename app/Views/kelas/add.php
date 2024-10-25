<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Nama Kelas</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nama kelas" name="form[nama_kelas]">
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
    <div class="col-md-9 p-0 select2-input">
        <select id="semester" name="form[semester]" class="form-control">
            <option value="" disabled selected>Pilih Semester</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Pengajar</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="basic" name="form[id_ustadz]" class="form-control">
            <option value="" disabled selected>Pilih pengajar</option>
            <?php foreach ($ustadz as $key): ?>
                <option value="<?= $key['id']; ?>"><?= $key['fullname']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
