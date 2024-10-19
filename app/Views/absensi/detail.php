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
                                <td><?= $absensi[0]['nama_kelas'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="/absensi/process" method="post" class="formNilai">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Data Absensi</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Sakit</th>
                                        <th>Izin</th>
                                        <th>Tanpa Keterangan</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($absensi as $key): ?>
                                        <tr>
                                            <td><?= $key['fullname']; ?></td>
                                            <td><input type="number" min="0" max="100" name="form[sakit][]" value="<?= $key['sakit']; ?>"></td>
                                            <td><input type="number" min="0" max="100" name="form[izin][]" value="<?= $key['izin']; ?>"></td>
                                            <td><input type="number" min="0" max="100" name="form[alpha][]" value="<?= $key['tanpa_keterangan']; ?>"></td>
                                            <td><textarea class="form-control input-full" name="form[catatan][]" id=""><?= $key['catatan']; ?></textarea></td>
                                            <input type="hidden" name="form[id_santri][]" value="<?= $key['id_santri']; ?>">
                                            <input type="hidden" name="form[id_kelas]" value="<?= $id_kelas; ?>">
                                            <?= !is_null($key['id_absensi']) ? '<input type="hidden" name="form[id_absensi][]" value="' . $key['id_absensi'] . '">' : '' ?>
                                        </tr>
                                    <?php endforeach;  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#add">
                            <i class="far fa-arrow-alt-circle-left"></i>
                            Kembali
                        </button>
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