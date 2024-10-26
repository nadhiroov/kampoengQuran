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
                <form action="/absensi/process" method="post" class="formNilai">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Data Nilai Quran</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Jumlah Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal add nilai tahfidz-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Tambah nilai tahfidz</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formAdd" action="<?= base_url() ?>nilaiQuran/process" method="POST">
                <div class="modal-body add-body">
                    <div class="item-container"></div>
                    <button type="button" id="add-row" class="btn btn-primary">Tambah Baris</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal add nilai tahsin-->
<div class="modal fade" id="addTahsin" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Tambah nilai tahsin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="formAddTahsin" action="<?= base_url() ?>nilaiTahsin/process" method="POST">
                <div class="modal-body add-body-tahsin">
                    <div class="item-container"></div>
                    <button type="button" id="add-row" class="btn btn-primary">Tambah Baris</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal detail nilai -->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addnewLabel">Detail nilai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body detail-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            </div>
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
                url: '<?= base_url('api/nilaiQuran/kelas/') . $id_kelas ?>',
                type: 'POST'
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            columnDefs: [{
                "targets": 3,
                "orderable": false
            }],
            columns: [{
                    data: 'nis'
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'count_nilai',
                },
                {
                    data: 'id_santri',
                    render: function(data, type, row) {
                        return `<a href="#add" data-toggle="modal" data-id="${data}" class="btn btn-sm btn-round btn-primary"><i class="fa fa-clipboard-list"></i></a>
                        <a href="#addTahsin" data-toggle="modal" data-id="${data}" class="btn btn-sm btn-round btn-primary"><i class="fa fa-headset"></i></a>
                        <a href="#detail" data-toggle="modal" data-id="${data}" class="btn btn-sm btn-round btn-primary"><i class="fas fa-external-link-alt"></i></a>`;
                    }
                }
            ]
        })

        $('#add').on('show.bs.modal', function(e) {
            let rowid = $(e.relatedTarget).data('id')
            let index = 0;
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '<?= base_url('nilaiQuran/add/') . $id_kelas . '/' ?>' + rowid,
                success: function(response) {
                    let container = $('.item-container');
                    container.empty();
                    index = 0
                    let newRow
                    let option
                    if (response.content.code == 200) {
                        option = `<select id="surat-${index}" name="form[surat][]" class="form-control" tabindex="-1" aria-hidden="true" required><option value="">&nbsp;</option>`
                        response.content.data.forEach(function(item) {
                            option += `<option value="${item.nomor}#${item.namaLatin}">${item.nomor} - ${item.namaLatin}</option>`;
                        });
                        option += '</select>';
                    } else {
                        option = '<div class="alert alert-danger" role="alert">'
                        option += response.content.message
                        option += '</div>'
                    }
                    newRow = `<div class="row repeater-item">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surat</label>
                                    ${option}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ayat :</label>
                                    <input name="form[ayat][]" type="number" min="1" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai :</label>
                                    <input name="form[nilai][]" type="number" min="1" max="100" class="form-control" required="">
                                </div>
                            </div>
                            <input type="hidden" name="form[id_kelas]" value="${response.id_kelas}">
                            <input type="hidden" name="form[id_santri]" value="${response.santri.id}">
                        </div>`
                    container.append(newRow);
                    $('#surat-0').select2({
                        theme: "bootstrap",
                        minimumResultsForSearch: -1,
                        width: '100%'
                    })
                    $('#add-row').off('click').on('click', function() {
                        index++
                        option = `<select id="surat-${index}" name="form[surat][]" class="form-control" tabindex="-1" aria-hidden="true" required><option value="">&nbsp;</option>`
                        response.content.data.forEach(function(item) {
                            option += `<option value="${item.nomor}#${item.namaLatin}">${item.nomor} - ${item.namaLatin}</option>`;
                        });
                        option += '</select>';
                        let newRows = `<div id="repeater-container-${index}">
                        <div class="row repeater-item">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Surat</label>
                                    ${option}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ayat :</label>
                                    <input name="form[ayat][]" type="number" min="1" class="form-control" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai :</label>
                                    <input name="form[nilai][]" type="number" min="1" max="100" class="form-control" required="">
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-row"><span class="btn-label"><i class="icon-close"></i></span></button>
                            </div>
                        </div>
                    </div>`
                        container.append(newRows);
                        $('#surat-' + index).select2({
                            theme: "bootstrap",
                            minimumResultsForSearch: -1,
                            width: '100%'
                        })

                        $('.remove-row').on('click', function() {
                            $(this).closest('.repeater-item').remove();
                        });
                    })
                }
            })
        })

        $('#addTahsin').on('show.bs.modal', function(e) {
            let rowid = $(e.relatedTarget).data('id')
            $.ajax({
                type: 'get',
                url: '<?= base_url('addNilaiTahsin/') . $id_kelas ?>/' + rowid,
                success: function(data) {
                    $('.add-body-tahsin').html(data)
                }
            })
        })

        $('.formAddTahsin').submit(function(e) {
            e.preventDefault()
            saveData(this, function() {
                $("#addTahsin").modal("hide");
            })
        })

        $('.formAdd').submit(function(e) {
            e.preventDefault()
            saveData(this)
        })

        $('#detail').on('show.bs.modal', function(e) {
            let rowid = $(e.relatedTarget).data('id')
            if (typeof rowid != 'undefined') {
                $.ajax({
                    type: 'get',
                    url: '<?= base_url('detailSantri/') . $id_kelas ?>/' + rowid,
                    success: function(data) {
                        $('.detail-body').html(data)
                        $('#datatableDetail').DataTable({
                            ajax: {
                                url: '<?= base_url('api/nilaiQuran/santri') ?>',
                                type: 'POST',
                                data: {
                                    id_santri: rowid,
                                    id_kelas: '<?= $id_kelas; ?>'
                                }
                            },
                            pageLength: 10,
                            serverSide: true,
                            processing: true,
                            bPaginate: false,
                            searching: false,
                            paging: false,
                            info: false,
                            columnDefs: [{
                                "width": "20px",
                                "targets": 3
                            }, {
                                "targets": 3,
                                "orderable": false
                            }],
                            columns: [{
                                    data: 'surat'
                                },
                                {
                                    data: 'ayat'
                                },
                                {
                                    data: 'nilai',
                                },
                                {
                                    data: 'id',
                                    render: function(data, type, row) {
                                        return `<a onclick="confirmDelete(this, function() { $('#datatableDetail').DataTable().ajax.reload(); $('#datatable').DataTable().ajax.reload() })" target="/nilaiQuran/${data}" class="btn btn-delete btn-sm btn-round btn-danger"><i class="far fa-trash-alt"></i></a>`;
                                    }
                                }
                            ]
                        })
                    }
                })
            }
        })
    })
</script>
<?= $this->endSection(); ?>