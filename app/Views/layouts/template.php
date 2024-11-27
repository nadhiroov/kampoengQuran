<!DOCTYPE html>
<html lang="en" class="wf-lato-n4-active wf-lato-n3-active wf-simplelineicons-n4-active wf-lato-n7-active wf-lato-n9-active wf-flaticon-n4-active wf-fontawesome5solid-n4-active wf-fontawesome5regular-n4-active wf-fontawesome5brands-n4-active wf-active">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($menu) ? $menu . ' - Smart Tahfidz' : 'Smart Tahfidz'; ?></title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?= base_url() ?>assets/img/logo-red.png" type="image/x-icon">

    <!-- Fonts and icons -->
    <script src="<?= base_url() ?>assets/js/plugin/webfont/webfont.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" media="all">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/fonts.min.css" media="all">
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
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/atlantis.css">
    <?= $this->renderSection('css'); ?>

</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="../index.html" class="logo">
                    <img src="<?= base_url() ?>assets/img/logo.png" style="max-width: 40px;" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
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

        <div class="main-panel">
            <div class="container">
                <?= $this->renderSection('content'); ?>
            </div>
            <?= $this->include('layouts/footer'); ?>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugin/moment/moment.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?= base_url() ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="<?= base_url() ?>assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Atlantis JS -->
    <script src="<?= base_url() ?>assets/js/atlantis.min.js"></script>
    <!-- Page JS -->
    <script src="<?= base_url() ?>assets/js/process.js"></script>
    <?= $this->renderSection('js'); ?>


    <div style="left: -1000px; overflow: scroll; position: absolute; top: -1000px; border: medium; box-sizing: content-box; height: 200px; margin: 0px; padding: 0px; width: 200px;">
        <div style="border: medium; box-sizing: content-box; height: 200px; margin: 0px; padding: 0px; width: 200px;"></div>
    </div>
</body>

</html>