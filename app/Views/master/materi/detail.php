<?= $this->extend('layouts/template'); ?>

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
                <a href="/materi"><?= esc($menu); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?= esc($submenu); ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Materi</h4>
                </div>
                <div class="card-body">
                    <table class="table table-typo">
                        <tbody>
                            <tr>
                                <td>
                                    <p>Materi :</p>
                                </td>
                                <td><?= $content['materi'] ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Semester :</p>
                                </td>
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
                        <div class="card-title">Data Submateri</div>
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
                                    <th>Sub materi</th>
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
                        <div class="card-title">Data Ibadah Praktis</div>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addPraktek">
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
                                    <th>No</th>
                                    <th>Ibadah Praktis</th>
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

<!-- Modal add materi -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Tambah baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formAdd" action="<?= base_url() ?>submateri/process" method="POST">
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

<!-- Modal edit materi-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Edit data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formEdit" action="<?= base_url() ?>submateri/process" method="POST">
                <div class="modal-body edited-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal add praktek -->
<div class="modal fade" id="addPraktek" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Tambah baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formAddPraktek" action="<?= base_url() ?>praktek/process" method="POST">
                <div class="modal-body add-body-praktek">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit praktek-->
<div class="modal fade" id="editPraktek" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Edit data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formEditPraktek" action="<?= base_url() ?>praktek/process" method="POST">
                <div class="modal-body edited-body-praktek"></div>
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
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax: {
                url: '<?= base_url() . 'detailMateri/' . $content['id'] ?>',
                type: 'POST'
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            columnDefs: [{
                width: "20%",
                targets: 2
            }, {
                targets: 2,
                orderable: false
            }],
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'submateri'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `<a href="#edit" data-toggle="modal" data-id="${data}" class="btn btn-sm btn-round btn-warning"><i class="fas fa-pencil-alt"></i></a>
                        <a onclick="confirmDelete(this)" target="<?= base_url() ?>submateri/${data}" class="btn btn-delete btn-sm btn-round btn-danger"><i class="far fa-trash-alt"></i></a>`;
                    }
                }
            ]
        })

        $('#datatable2').DataTable({
            ajax: {
                url: '<?= base_url() . 'detailPraktek/' . $content['id'] ?>',
                type: 'POST'
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            columnDefs: [{
                width: "20%",
                targets: 2
            }, {
                targets: 2,
                orderable: false
            }],
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'praktek'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `<a href="#editPraktek" data-toggle="modal" data-id="${data}" class="btn btn-sm btn-round btn-warning"><i class="fas fa-pencil-alt"></i></a>
                        <a onclick="confirmDelete(this,  function() { $('#datatable2').DataTable().ajax.reload() } )" target="<?= base_url() ?>praktek/${data}" class="btn btn-delete btn-sm btn-round btn-danger"><i class="far fa-trash-alt"></i></a>`;
                    }
                }
            ]
        })
    })

    $('#add').on('show.bs.modal', function(e) {
        $.ajax({
            type: 'get',
            url: '<?= base_url() . 'submateri/add/' . $content['id'] ?>',
            success: function(data) {
                $('.add-body').html(data)
            }
        })
    })

    $('#edit').on('show.bs.modal', function(e) {
        let rowid = $(e.relatedTarget).data('id')
        if (typeof rowid != 'undefined') {
            $.ajax({
                type: 'get',
                url: `<?= base_url() ?>submateri/edit/${rowid}`,
                success: function(data) {
                    $('.edited-body').html(data)
                }
            })
        }
    })

    $('#addPraktek').on('show.bs.modal', function(e) {
        $.ajax({
            type: 'get',
            url: '<?= base_url() . 'praktek/add/' . $content['id'] ?>',
            success: function(data) {
                $('.add-body-praktek').html(data)
            }
        })
    })

    $('#editPraktek').on('show.bs.modal', function(e) {
        let rowid = $(e.relatedTarget).data('id')
        if (typeof rowid != 'undefined') {
            $.ajax({
                type: 'get',
                url: `<?= base_url() ?>praktek/edit/${rowid}`,
                success: function(data) {
                    $('.edited-body-praktek').html(data)
                }
            })
        }
    })

    $('.formAdd, .formEdit').submit(function(e) {
        e.preventDefault()
        saveData(this)
    })

    $('.formAddPraktek, .formEditPraktek').submit(function(e) {
        e.preventDefault()
        saveData(this, function() {
            $("#addPraktek").modal("hide")
            $("#editPraktek").modal("hide")
            $("#datatable2").DataTable().ajax.reload()
        })
    })
</script>
<?= $this->endSection(); ?>