<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Fashohah</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nilai fashohah" name="form[fashohah]" value="<?= $content['fashohah']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Tajwid</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nilai tajwid" name="form[tajwid]" value="<?= $content['tajwid']; ?>">
    </div>
</div>
<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Kelancaran</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan nilai kelancaran" name="form[kelancaran]" value="<?= $content['kelancaran']; ?>">
    </div>
</div>
<input type="hidden" name="form[id_kelas]" value="<?= $content['id_kelas']; ?>">
<input type="hidden" name="form[id_santri]" value="<?= $content['id_santri']; ?>">
<?= $content['id_nilai_tahsin'] != null ? '<input type="hidden" name="form[id]" value="' . $content['id_nilai_tahsin'] . '">' : ''; ?>