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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Semua data</div>
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
                                    <th>Nama</th>
                                    <th>Jenis kelamin</th>
                                    <th>Email</th>
                                    <th>Gambar</th>
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

<!-- Modal add new -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Tambah baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formAdd" action="<?= base_url() ?>ustadz/process" method="POST">
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

<!-- Modal edit -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Edit data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formEdit" action="<?= base_url() ?>admin/process" method="POST">
                <div class="modal-body edited-body"></div>
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
<script src="<?= base_url() ?>assets/js/plugin/select2/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax: {
                url: '<?= base_url('ustadz/data') ?>',
                type: 'POST'
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            "columnDefs": [{
                "width": "20%",
                "targets": 5
            }, {
                "targets": 5,
                "orderable": false
            }, {
                "targets": 4,
                "orderable": false
            }],
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'email'
                },
                {
                    data: 'image',
                    render: function(data, type, row) {
                        return data == 'user.png' ? '<div class="avatar"><img src="<?= base_url() ?>assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded"></div>' : `<div class="avatar"><img src="<?= base_url() ?>showImg/ustadz/${row.image}" alt="..." class="avatar-img rounded"></div>`
                    }
                },

                {
                    data: 'id',
                    render: function(data, type, row) {
                        // <a href="categoryDetail/${data}" class="btn btn-sm btn-round btn-primary"><i class="fas fa-external-link-alt"></i></a>
                        return `<a href="#edit" data-toggle="modal" data-id="${data}" class="btn btn-sm btn-round btn-warning"><i class="fas fa-edit"></i></a>
                        <a onclick="confirmDelete(this)" target="<?= base_url() ?>/admin/${data}" class="btn btn-delete btn-sm btn-round btn-danger"><i class="far fa-trash-alt"></i></a>`;
                    }
                }
            ]
        })
    })

    $('#add').on('show.bs.modal', function(e) {
        $.ajax({
            type: 'get',
            url: '<?= base_url() ?>/ustadz/add',
            success: function(data) {
                $('.add-body').html(data)
                // $('#basic').select2()
                $('#uploadImg').on('change', function(e) {
                    var input = this;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader()
                        reader.onload = function(e) {
                            $('#imgPreview').attr('src', e.target.result) // Update image preview
                        }
                        reader.readAsDataURL(input.files[0])
                    }
                })
            }
        })
    })

    $('#edit').on('show.bs.modal', function(e) {
        let rowid = $(e.relatedTarget).data('id')
        if (typeof rowid != 'undefined') {
            $.ajax({
                type: 'get',
                url: `<?= base_url() ?>/ustadz/${rowid}`,
                success: function(data) {
                    $('.edited-body').html(data)
                    $('#uploadImg').on('change', function(e) {
                        var input = this;
                        if (input.files && input.files[0]) {
                            var reader = new FileReader()
                            reader.onload = function(e) {
                                $('#imgPreview').attr('src', e.target.result) // Update image preview
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    })
                }
            })
        }
    })

    $('.formAdd, .formEdit').submit(function(e) {
        e.preventDefault()
        saveData(this)
    })
</script>
<?= $this->endSection(); ?>