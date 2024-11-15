<!DOCTYPE html>
<html lang="en" class="wf-lato-n4-active wf-lato-n3-active wf-simplelineicons-n4-active wf-lato-n7-active wf-lato-n9-active wf-flaticon-n4-active wf-fontawesome5solid-n4-active wf-fontawesome5regular-n4-active wf-fontawesome5brands-n4-active wf-active">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Notifications - Atlantis Bootstrap 4 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?= base_url() ?>assets/img/icon.ico" type="image/x-icon">

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
                    <img src="<?= base_url() ?>assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
                </a>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="<?= session()->get('theme') == 'dark' ? 'dark' : 'blue2' ?>">
                
            </nav>

            <!-- End Navbar -->
        </div>
        <!-- Sidebar -->
        <div class="main-panel">
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Smart Tahfidz</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Privacy and Policy </h4>
                                </div>
                                <div class="card-body">
                                    <p>Effective Date:&nbsp;Fri 15 Nov 24</p>
                                    <p>At Smart Tahfidz&nbsp;("we", "our", or "us"), we value your privacy. This Privacy Policy explains how we collect, use, and protect your personal information when you use our mobile application ("App") for monitoring student activities, including material assessments, practical evaluations, Quran memorization (hafalan), Quran reading improvement (tahsin), and attendance tracking.</p>
                                    <p>By using our App, you agree to the collection and use of information in accordance with this policy.</p>
                                    <p><strong>1. &nbsp;Information We Collect</strong></p>
                                    <p>We collect the following types of information from students, parents, and school staff:</p>
                                    <ul>
                                        <li><strong>Personal Information</strong>: This may include the student&rsquo;s name, grade level, school email, and contact information.</li>
                                        <li><strong>Academic Information</strong>: We collect data regarding assessments, practice evaluations, memorization progress (hafalan), reading improvement (tahsin), and attendance.</li>
                                        <li><strong>Usage Data</strong>: We automatically collect data on how the App is accessed and used, including device type, operating system, IP address, and browsing behavior.</li>
                                    </ul>
                                    <p><strong>2. &nbsp;How We Use Your Information</strong></p>
                                    <p>We use the collected information for the following purposes:</p>
                                    <ul>
                                        <li><strong>Monitoring Student Progress</strong>: To track and display academic performance, Quran memorization, reading improvements, and attendance.</li>
                                        <li><strong>Communication</strong>: To send important notifications regarding student activities, assessments, and school-related updates.</li>
                                        <li><strong>Improvement of App Features</strong>: To analyze usage data for improving the functionality and user experience of the App.</li>
                                        <li><strong>Security</strong>: To ensure the security and integrity of our services and protect against unauthorized access.</li>
                                    </ul>
                                    <p><strong>3. &nbsp;Data Sharing</strong></p>
                                    <p>We do not sell or rent your personal information to third parties. However, we may share information in the following cases:</p>
                                    <ul>
                                        <li><strong>With Service Providers</strong>: We may share data with trusted third-party service providers who assist us in operating the App and conducting business. These providers are required to maintain the confidentiality and security of your dat</li>
                                        <li><strong>Legal Requirements</strong>: We may disclose personal information if required to do so by law or to comply with a legal obligation.</li>
                                    </ul>
                                    <p><strong>4. Data Retention</strong></p>
                                    <p>We will retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy. Afterward, we will securely delete or anonymize the information.</p>
                                    <p><strong>5. Security</strong></p>
                                    <p>We implement reasonable security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. However, please be aware that no method of transmission over the Internet is completely secure, and we cannot guarantee absolute security.</p>
                                    <p><strong>6. Children&rsquo;s Privacy</strong></p>
                                    <p>Our App is intended for use by students under the supervision of school staff or parents. We do not knowingly collect or solicit personal information from children under the age of 13 without parental consent. If we become aware that we have collected personal data from a child under 13, we will take steps to delete that information as soon as possible.</p>
                                    <p><strong>7. Contact Us</strong></p>
                                    <p>If you have any questions about this Privacy Policy or our practices, please contact us at:</p>
                                    <p>Indonesia Kreatif Digital</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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