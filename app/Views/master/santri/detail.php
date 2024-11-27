<?= $this->extend('layouts/template'); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title"><?= esc($menu); ?></h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="/dashboard">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="/santri"><?= esc($menu); ?></a>
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
        <div class="col-md-8">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                            <li class="nav-item submenu"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true">Profile</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/santri/process" method="post" class="formEdit">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" name="form[nis]" placeholder="NIS" value="<?= $content['nis']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Nama lengkap</label>
                                    <input type="text" class="form-control" name="form[fullname]" placeholder="Nama Lengkap" value="<?= $content['fullname']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="form[email]" placeholder="Email" value="<?= $content['email']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="form[password]" placeholder="password">
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Kosongkan jika tidak ingin merubah password</small>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-group form-group-default">
                                    <label>Tanggal lahir</label>
                                    <input type="text" class="form-control" id="datepicker" name="form[tanggal_lahir]" placeholder="Tanggal lahir" name="form[tanggal_lahir]">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-group-default">
                                    <label>Gender</label>
                                    <select class="form-control" id="gender" name="form[gender]">
                                        <option <?= $content['gender'] == 'Pria' ? 'selected' : ''; ?>>Pria</option>
                                        <option <?= $content['gender'] == 'Wanita' ? 'selected' : ''; ?>>Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-group-default">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="<?= $content['phone']; ?>" name="form[phone]" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-group-default">
                                    <label>Angkatan</label>
                                    <input type="text" class="form-control" value="<?= $content['angkatan']; ?>" name="form[angkatan]" placeholder="angkatan">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Alamat Asal</label>
                                    <textarea class="form-control" name="form[alamat_asal]" placeholder="Alamat asal" rows="2"><?= $content['alamat_asal']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-1">
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Alamat Domisili</label>
                                    <textarea class="form-control" name="form[alamat_domisili]" placeholder="Alamat domisili" rows="2"><?= $content['alamat_domisili']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="form[id]" value="<?= $content['id']; ?>">
                        <div class="text-right mt-3 mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="<?= base_url() . 'showImg/santri/' . $content['image'] ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/profile.jpg';" alt="profile" class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name"><?= $content['fullname']; ?></div>
                        <div class="job"><?= $content['nis']; ?></div>
                        <div class="desc"><?= $content['angkatan']; ?></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                            <div class="number">125</div>
                            <div class="title">Post</div>
                        </div>
                        <div class="col">
                            <div class="number">25K</div>
                            <div class="title">Followers</div>
                        </div>
                        <div class="col">
                            <div class="number">134</div>
                            <div class="title">Following</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="<?= base_url() ?>assets/js/plugin/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugin/datepicker/datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
            defaultDate: '<?= $content['tanggal_lahir']; ?>'
        })
    })

    $('.formEdit').submit(function(e) {
        e.preventDefault()
        saveData(this, function() {
            setTimeout(() => {
                location.reload()
            }, 1000);
        })
    })
</script>

<?= $this->endSection(); ?>