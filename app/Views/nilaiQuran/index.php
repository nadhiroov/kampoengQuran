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
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="filterTahunAjaran">Filter: </label>
                            <select id="filterTahunAjaran" class="form-control select2">
                                <option value=""></option>
                                <?php foreach ($tahun_akademik as $key): ?>
                                    <option value="<?= $key['tahun_akademik']; ?>"><?= $key['tahun_akademik']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterSemester"></label>
                            <select id="filterSemester" class="form-control select2">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Tahun Ajaran - Semester</th>
                                    <th>Walikelas</th>
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
<script src="<?= base_url() ?>assets/js/plugin/select2/select2.min.js"></script>
<script>
    $(document).ready(function() {
        let table = $('#datatable').DataTable({
            ajax: {
                url: '<?= base_url('api/nilaiQuran') ?>',
                type: 'POST',
                data: function(d) {
                    d.filter = d.filter || {};
                    d.filter['tahunAjaran'] = $('#filterTahunAjaran').val();
                    d.filter['semester'] = $('#filterSemester').val();
                }
            },
            pageLength: 10,
            serverSide: true,
            processing: true,
            columnDefs: [{
                width: "20px",
                targets: 4
            }, {
                targets: 4,
                orderable: false
            }],
            columns: [{
                    data: 'id',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nama_kelas'
                },
                {
                    data: 'tahun_ajaran',
                    render: function(data, type, row) {
                        return data + ' - ' + row.semester
                    }
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `<a href="quran/${data}" class="btn btn-sm btn-round btn-primary"><i class="fas fa-external-link-alt"></i></a>`;
                    }
                }
            ]
        })

        $('#filterTahunAjaran, #filterSemester').on('change', function() {
            table.ajax.reload(); // Reload data berdasarkan filter
        })

        $('#filterTahunAjaran').select2({
            placeholder: 'Pilih Tahun Ajaran',
            allowClear: true
        })
        $('#filterSemester').select2({
            placeholder: 'Pilih Semester',
            allowClear: true
        })
    })

    $('#add').on('show.bs.modal', function(e) {
        $.ajax({
            type: 'get',
            url: '<?= base_url() ?>kelas/add',
            success: function(data) {
                $('.add-body').html(data)
                $('#basic').select2({
                    theme: "bootstrap",
                    minimumResultsForSearch: -1,
                    width: '100%'
                })
            }
        })
    })

    $('#edit').on('show.bs.modal', function(e) {
        let rowid = $(e.relatedTarget).data('id')
        if (typeof rowid != 'undefined') {
            $.ajax({
                type: 'get',
                url: `<?= base_url() ?>kelas/${rowid}`,
                success: function(data) {
                    $('.edited-body').html(data)
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