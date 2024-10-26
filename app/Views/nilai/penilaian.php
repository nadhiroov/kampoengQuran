<?= $this->extend('layouts/template'); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"><?= esc($menu); ?></h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="dashboard">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?= esc($menu); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="/api/nilai/kelas/<?= $id_kelas; ?>">Materi</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Penilaian</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail kelas</h4>
                </div>
                <div class="card-body">
                    <table class="table table-typo">
                        <tbody>
                            <tr>
                                <th>
                                    <p>Nama kelas</p>
                                </th>
                                <td><?= $nilai[0]['nama_kelas'] ?></td>
                            </tr>
                            <tr>
                                <th>
                                    <p>Materi</p>
                                </th>
                                <td><?= $nilai[0]['materi'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <form action="/nilai/process" method="post" class="formNilai">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Data Penilaian</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nilai as $key): ?>
                                        <tr>
                                            <td><?= $key['fullname']; ?></td>
                                            <td><input type="number" min="0" max="100" name="form[nilai][]" value="<?= $key['nilai']; ?>"></td>
                                            <input type="hidden" name="form[id_santri][]" value="<?= $key['id_santri']; ?>">
                                            <input type="hidden" name="form[id_kelas]" value="<?= $id_kelas; ?>">
                                            <input type="hidden" class="form-control input-full" name="form[id_materi]" value="<?= $id_materi; ?>">
                                            <?= !is_null($key['id_nilai']) ? '<input type="hidden" name="form[id_nilai][]" value="' . $key['id_nilai'] . '">' : '' ?>
                                        </tr>
                                    <?php endforeach;  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/api/nilai/kelas/<?= $id_kelas; ?>" class="btn btn-primary btn-round ml-auto"><i class="far fa-arrow-alt-circle-left"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#add">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('js'); ?>
<script src="<?= base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $('.formNilai').submit(function(e) {
            e.preventDefault()
            saveData(this, function() {
                setTimeout(() => {
                    location.reload();
                }, 1000);
            })
        })
    })
</script>
<?= $this->endSection(); ?>