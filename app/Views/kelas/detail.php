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
                                <td>
                                    <p>Nama kelas</p>
                                </td>
                                <td><?= $content['nama_kelas'] ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Tahun ajaran - semester</p>
                                </td>
                                <td><?= $content['tahun_ajaran'] . ' - ' . $content['semester'] ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Pengajar</p>
                                </td>
                                <td><?= $content['fullname'] ?></td>
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
                        <div class="card-title">Data Santri</div>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#add">
                            <i class="fa fa-plus"></i>
                            Tambah baru
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
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
    <div class="row">
        <div class="col-md-8 ml-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Data Jadwal</div>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addJadwal">
                            <i class="fa fa-plus"></i>
                            Tambah baru
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable2" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Materi</th>
                                    <th>Waktu mulai</th>
                                    <th>Waktu akhir</th>
                                    <th>Ruang</th>
                                    <th>Ustadz</th>
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

<!-- Modal add santri -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Tambah baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formAdd" action="<?= base_url() ?>kelas/processAddSantri" method="POST">
                <div class="modal-body add-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal add jadwal -->
<div class="modal fade" id="addJadwal" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Tambah baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formAddJadwal" action="<?= base_url() ?>jadwal/process" method="POST">
                <div class="modal-body add-jadwal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('js'); ?>
<script src="<?= base_url() ?>assets/js/plugin/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/datepicker/datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/select2/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax: {
                url: '<?= base_url() . 'api/kelas/detailData/' . $content['id'] ?>',
                type: 'POST'
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            "columnDefs": [{
                "width": "20%",
                "targets": 3
            }, {
                "targets": 3,
                "orderable": false
            }],
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nis'
                },
                {
                    data: 'nama_santri'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `<a onclick="confirmDelete(this)" target="<?= base_url() ?>kelas/${data}/${row.id_santri}" class="btn btn-delete btn-sm btn-round btn-danger"><i class="far fa-trash-alt"></i></a>`;
                    }
                }
            ]
        })

        $('#datatable2').DataTable({
            ajax: {
                url: '<?= base_url('api/jadwal') ?>',
                type: 'POST',
                data: function(d) {
                    d.id_kelas = '<?= $content['id']; ?>';
                }
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            "columnDefs": [{
                "width": "20%",
                "targets": 3
            }, {
                "targets": 3,
                "orderable": false
            }],
            columns: [{
                    data: 'hari'
                },
                {
                    data: 'materi'
                },
                {
                    data: 'jam_awal'
                },
                {
                    data: 'jam_akhir'
                },
                {
                    data: 'lokasi'
                },
                {
                    data: 'nama_ustadz'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `<a onclick="confirmDelete(this, function() { $('#datatable2').DataTable().ajax.reload() })" target="<?= base_url() ?>jadwal/${data}" class="btn btn-delete btn-sm btn-round btn-danger"><i class="far fa-trash-alt"></i></a>`;
                    }
                }
            ]
        })
    })

    $('#add').on('show.bs.modal', function(e) {
        $.ajax({
            type: 'get',
            url: '<?= base_url() . 'kelas/addSantri/' . $content['id'] ?>',
            success: function(data) {
                $('.add-body').html(data)
                $('#basic').select2({
                    width: '100%'
                })
            }
        })
    })

    $('#addJadwal').on('show.bs.modal', function(e) {
        $.ajax({
            type: 'get',
            url: '<?= base_url() . 'jadwal/add/' . $content['id'] ?>',
            success: function(data) {
                $('.add-jadwal').html(data)
                $('#hari').select2({
                    width: '100%'
                })
                $('#submateri').select2({
                    width: '100%'
                })
                $('#ustadz').select2({
                    width: '100%'
                })
                $('#timepicker, #timepicker2').datetimepicker({
                    format: 'HH:mm',
                });
            }
        })
    })

    $('.formAdd').submit(function(e) {
        e.preventDefault()
        saveData(this)
    })
    $('.formAddJadwal').submit(function(e) {
        e.preventDefault()
        saveData(this)
        $("#addJadwal").modal("hide")
        $("#datatable2").DataTable().ajax.reload()
    })
</script>
<?= $this->endSection(); ?>