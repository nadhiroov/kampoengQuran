<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Santri</label>
    <div class="col-md-9 p-0 select2-input">
        <select id="basic" name="form[id_santri][]" multiple class="form-control select2-hidden-accessible" data-select2-id="basic" tabindex="-1" aria-hidden="true">
            <option value="">&nbsp;</option>
            <?php foreach ($santri as $key): ?>
                <option value="<?= $key['id']; ?>"><?= $key['nis'] . ' - ' . $key['fullname']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<input type="hidden" name="form[id_kelas]" value="<?= $id_kelas; ?>">