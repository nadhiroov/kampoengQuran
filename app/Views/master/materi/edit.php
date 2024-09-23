<div class="form-group form-inline">
    <label for="inlineinput" class="col-md-3 col-form-label">Materi</label>
    <div class="col-md-9 p-0">
        <input type="text" class="form-control input-full" placeholder="masukkan materi" name="form[materi]" value="<?= $content['materi']; ?>">
    </div>
</div>
<input type="hidden" name="form[id]" value="<?= $content['id']; ?>">