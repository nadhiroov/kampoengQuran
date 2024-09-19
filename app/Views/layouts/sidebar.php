<div class="sidebar sidebar-style-2" data-background-color="<?= session()->get('theme') == 'dark' ? 'dark2' : '' ?>">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= base_url() ?>assets/img/<?= session()->get('image') ?>" onerror="this.onerror=null;this.src='<?= base_url() ?>assets/img/profile.jpg';" alt="profile" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?= session()->get('fullname') ?>
                            <?php if (session()->get('is_admin') == 1) : ?>
                                <span class="user-level">Administrator</span>
                            <?php else : ?>
                                <span class="user-level">User</span>
                            <?php endif; ?>
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

                <!-- <li class="nav-section">
                    <h4 class="text-section">Fitur</h4>
                </li> -->

                <li class="nav-item <?= $menu_master ?? ''; ?>">
                    <a data-toggle="collapse" href="#selling">
                        <i class="fas fa-layer-group"></i>
                        <p>Master data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?= isset($menu_master) ? 'show' : '' ?>" id="selling">
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
                            <li class="<?= $submenu_kelas ?? ''; ?>">
                                <a href="<?= base_url() ?>kelas">
                                    <span class="sub-item">Kelas</span>
                                </a>
                            </li>
                            <li class="<?= $submenu_mapel ?? ''; ?>">
                                <a href="<?= base_url() ?>mapel">
                                    <span class="sub-item">Mapel</span>
                                </a>
                            </li>
                            <li>
                        </ul>
                    </div>
                </li>

                <?php if (session()->get('is_admin') == 1) : ?>
                    <li class="nav-item <?= $menu_member ?? ''; ?>">
                        <a href="<?= base_url() ?>member">
                            <i class="fas fa-users"></i>
                            <p>Members</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $menu_discount ?? ''; ?>">
                        <a href="<?= base_url() ?>discount">
                            <i class="fas fa-percentage"></i>
                            <p>Discount</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $menu_report ?? ''; ?>">
                        <a data-toggle="collapse" href="#report">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Report</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse <?= isset($menu_report) ? 'show' : '' ?>" id="report">
                            <ul class="nav nav-collapse">
                                <li class="<?= $submenu_byProduct ?? ''; ?>">
                                    <a href="<?= base_url() ?>rbyProduct">
                                        <span class="sub-item">Product</span>
                                    </a>
                                </li>
                                <li class="<?= $submenu_byTransaction ?? ''; ?>">
                                    <a href="<?= base_url() ?>rbyTransaction">
                                        <span class="sub-item">Transaction graph</span>
                                    </a>
                                </li>
                                <li class="<?= $submenu_byTransactionDiagram ?? ''; ?>">
                                    <a href="<?= base_url() ?>rbyTransactionDiagram">
                                        <span class="sub-item">Transaction diagram</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-section">
                        <h4 class="text-section">Setting</h4>
                    </li>

                    <li class="nav-item <?= @$menu_user; ?>">
                        <a href="<?= base_url() ?>user">
                            <i class="fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>

                    <li class="nav-item <?= $menu_setting ?? ''; ?>">
                        <a href="<?= base_url() ?>setting">
                            <i class="fas fa-cogs"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>