<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $menu ?? 'Cashier App'; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= base_url() ?>assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?= base_url() ?>assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['<?= base_url() ?>assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/atlantis.min.css">

    <?= $this->renderSection('css'); ?>
</head>

<body data-background-color="blue">
    <div class="wrapper <?= isset($submenu_transaction) ? 'overlay-sidebar' : ''; ?>">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="<?= session()->get('theme') == 'dark' ? 'dark2' : 'blue2' ?>">

                <a href="index.html" class="logo">
                    <img src="<?= base_url() ?>assets/img/logo.svg" style="max-width:45%" alt="ais logo" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle <?= isset($submenu_transaction) ? 'sidenav-overlay-toggler' : 'toggle-sidebar'; ?>">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <?= $this->include('layouts/navbar'); ?>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <?= $this->include('layouts/sidebar'); ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <?= $this->renderSection('content'); ?>
            </div>
            <?= $this->include('layouts/footer'); ?>
        </div>

    </div>
    <!--   Core JS Files   -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?= base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="<?= base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url() ?>assets/js/process.js"></script>
    <?= $this->renderSection('js'); ?>

    <!-- Atlantis JS -->
    <script src="<?= base_url() ?>assets/js/atlantis.min.js"></script>
</body>

</html>