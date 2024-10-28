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
                <a href="/praktek"><?= esc($menu); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">Praktek</a>
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
                                <td><?= $content['nama_kelas'] ?></td>
                            </tr>
                            <tr>
                                <th>
                                    <p>Tahun Ajaran</p>
                                </th>
                                <td><?= $content['tahun_ajaran'] ?></td>
                            </tr>
                            <tr>
                                <th>
                                    <p>Semester</p>
                                </th>
                                <td><?= $content['semester'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
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
                                    <th>Materi</th>
                                    <th>Praktek</th>
                                    <th>Pengajar</th>
                                    <th class="col-xs-1">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
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
        $('#datatable').DataTable({
            ajax: {
                url: '<?= base_url() . 'api/nilaiPraktek/kelas/' . $content['id'] ?>',
                type: 'POST',
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            columnDefs: [{
                "width": "20%",
                "targets": 2
            }, {
                "targets": 2,
                "orderable": false
            }],
            columns: [{
                    data: 'materi'
                },
                {
                    data: 'praktek'
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'id_kelas',
                    render: function(data, type, row) {
                        return `<a href="/api/nilaiPraktek/kelas/${data}/${row.id_praktek}" class="btn btn-sm btn-round btn-primary"><i class="fas fa-external-link-alt"></i></a>`;
                    }
                }
            ]
        })
    })
</script>
<?= $this->endSection(); ?>