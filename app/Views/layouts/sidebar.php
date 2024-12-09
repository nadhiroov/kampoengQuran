<div class="sidebar sidebar-style-2" data-background-color="<?= session()->get('theme') == 'dark' ? 'dark2' : '' ?>">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= base_url() ?>showImg/admin/<?= session()->get('image') ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/profile.jpg';" alt="profile" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?= session()->get('fullname') ?>
                            <span class="user-level">Administrator</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item <?= $menu_dashboard ?? ''; ?>">
                    <a href="<?= base_url() ?>dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item <?= $menu_master ?? ''; ?>">
                    <a data-toggle="collapse" href="#mater">
                        <i class="fas fa-layer-group"></i>
                        <p>Master data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= isset($menu_master) ? 'show' : '' ?>" id="mater">
                        <ul class="nav nav-collapse">
                            <li class="<?= $submenu_admin ?? ''; ?>">
                                <a href="<?= base_url() ?>admin">
                                    <span class="sub-item">Admin</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_ustadz ?? ''; ?>">
                                <a href="<?= base_url() ?>ustadz">
                                    <span class="sub-item">Ustadz</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_santri ?? ''; ?>">
                                <a href="<?= base_url() ?>santri">
                                    <span class="sub-item">Santri</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_tahunakademik ?? ''; ?>">
                                <a href="<?= base_url() ?>tahun_akademik">
                                    <span class="sub-item">Tahun Akademik</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_materi ?? ''; ?>">
                                <a href="<?= base_url() ?>materi">
                                    <span class="sub-item">Materi</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_kelas ?? ''; ?>">
                                <a href="<?= base_url() ?>kelas">
                                    <span class="sub-item">Kelas dan Jadwal</span>
                                </a>
                            </li>

                            <li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item <?= $menu_penilaian ?? ''; ?>">
                    <a data-toggle="collapse" href="#penilaian">
                        <i class="fas fa-pencil-alt"></i>
                        <p>Penilaian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= isset($menu_penilaian) ? 'show' : '' ?>" id="penilaian">
                        <ul class="nav nav-collapse">
                            <li class="<?= $submenu_quran ?? ''; ?>">
                                <a href="<?= base_url() ?>quran">
                                    <span class="sub-item">Al Qur'an</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_nilai_materi ?? ''; ?>">
                                <a href="<?= base_url() ?>nilai">
                                    <span class="sub-item">Materi</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_nilai_praktek ?? ''; ?>">
                                <a href="<?= base_url() ?>praktek">
                                    <span class="sub-item">Ibadah Praktis</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_nilai_absensi ?? ''; ?>">
                                <a href="<?= base_url() ?>absensi">
                                    <span class="sub-item">Absensi</span>
                                </a>
                            </li>
                            <li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>