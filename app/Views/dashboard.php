<?= $this->extend('layouts/template'); ?>

<?= $this->section('css'); ?>
<style>
    .spinner {
        height: 60px;
        width: 60px;
        margin: auto;
        display: flex;
        position: absolute;
        -webkit-animation: rotation .6s infinite linear;
        -moz-animation: rotation .6s infinite linear;
        -o-animation: rotation .6s infinite linear;
        animation: rotation .6s infinite linear;
        border-left: 6px solid rgba(0, 174, 239, .15);
        border-right: 6px solid rgba(0, 174, 239, .15);
        border-bottom: 6px solid rgba(0, 174, 239, .15);
        border-top: 6px solid rgba(0, 174, 239, .8);
        border-radius: 100%;
    }

    @-webkit-keyframes rotation {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(359deg);
        }
    }

    @-moz-keyframes rotation {
        from {
            -moz-transform: rotate(0deg);
        }

        to {
            -moz-transform: rotate(359deg);
        }
    }

    @-o-keyframes rotation {
        from {
            -o-transform: rotate(0deg);
        }

        to {
            -o-transform: rotate(359deg);
        }
    }

    @keyframes rotation {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(359deg);
        }
    }

    #overlay {
        position: absolute;
        display: none;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.15);
        z-index: 2;
        cursor: pointer;
    }
</style>
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
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-customer-support"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Admin</p>
                                <h4 class="card-title"><?= $total_admin['total_admin'] ?? '-'; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-user"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Ustadz</p>
                                <h4 class="card-title"><?= $total_ustadz['total_ustadz'] ?? '-'; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Santri</p>
                                <h4 class="card-title"><?= $total_santri['total_santri'] ?? '-'; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="flaticon-presentation"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Kelas</p>
                                <h4 class="card-title"><?= $total_kelas['total_kelas'] ?? '-'; ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Sebaran Santri </div>
                </div>
                <div class="card-body">
                    <div class="loadTotalSantri" id="overlay">
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <div class="spinner"></div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="multipleBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Sebaran Ustadz</div>
                </div>
                <div class="card-body">
                    <div class="loadTotalUstadz" id="overlay">
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <div class="spinner"></div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Total Materi per semester</div>
                </div>
                <div class="card-body">
                    <div class="loadTotalMateri" id="overlay">
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <div class="spinner"></div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="multipleBarChartMateri" style="width: 50%; height: 50%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="<?= base_url() ?>assets/js/plugin/chart.js/chart.min.js"></script>
<script>
    $(document).ready(function() {
        let multipleBarChart = document.getElementById('multipleBarChart').getContext('2d')
        let pieChart = document.getElementById('pieChart').getContext('2d')
        let multipleBarChartMateri = document.getElementById('multipleBarChartMateri').getContext('2d')
        totalSantri()
        totalUstadz()
        totalMateri()
    })

    function totalSantri() {
        $.ajax({
            url: '<?= base_url('getTotalSantri') ?>', // Ganti dengan URL endpoint Anda
            method: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $(".loadTotalSantri").css("display", "flex");
            },
            success: function(data) {
                // Extract labels dan data dari response
                const labels = data.map(item => item.angkatan)
                const totalPria = data.map(item => parseInt(item.total_pria))
                const totalWanita = data.map(item => parseInt(item.total_wanita))

                // Inisialisasi Chart
                new Chart(multipleBarChart, {
                    type: 'bar',
                    data: {
                        labels: labels, // Label berdasarkan angkatan
                        datasets: [{
                                label: "Total Pria",
                                backgroundColor: '#59d05d',
                                borderColor: '#59d05d',
                                data: totalPria
                            },
                            {
                                label: "Total Wanita",
                                backgroundColor: '#177dff',
                                borderColor: '#177dff',
                                data: totalWanita
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Santri Berdasarkan Angkatan'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        scales: {
                            xAxes: [{
                                stacked: true
                            }],
                            yAxes: [{
                                stacked: true
                            }]
                        }
                    }
                })
                $(".loadTotalSantri").css("display", "none");
                // document.getElementById("loadTotalSantri").style.display = "none";
            },
            error: function(xhr, status, error) {
                console.error('Error fetching chart data:', error)
            }
        })
    }

    function totalUstadz() {
        $.ajax({
            url: '<?= base_url('getTotalUstadz') ?>', // Ganti dengan endpoint API Anda
            method: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $(".loadTotalUstadz").css("display", "flex");
            },
            success: function(data) {
                // Extract data
                const totalPria = parseInt(data[0].total_pria)
                const totalWanita = parseInt(data[0].total_wanita)

                // Buat Pie Chart
                new Chart(pieChart, {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: [totalPria, totalWanita],
                            backgroundColor: ["#1d7af3", "#59d05d"],
                            borderWidth: 0
                        }],
                        labels: ['Pria', 'Wanita'] // Labels sesuai data
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'bottom',
                            labels: {
                                fontColor: 'rgb(154, 154, 154)',
                                fontSize: 11,
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        pieceLabel: {
                            render: 'percentage',
                            fontColor: 'white',
                            fontSize: 14,
                        },
                        tooltips: false,
                        layout: {
                            padding: {
                                left: 20,
                                right: 20,
                                top: 20,
                                bottom: 20
                            }
                        }
                    }
                })
                $(".loadTotalUstadz").css("display", "none");
            },
            error: function(xhr, status, error) {
                console.error('Error fetching pie chart data:', error)
            }
        })
    }

    function totalMateri() {
        $.ajax({
            url: '<?= base_url('getTotalMateri') ?>', // Ganti dengan URL endpoint Anda
            method: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $(".loadTotalMateri").css("display", "flex");
            },
            success: function(data) {
                // Extract labels dan data dari response
                const labels = data.map(item => item.semester)
                const totalMateri = data.map(item => parseInt(item.total_materi))

                var myBarChart = new Chart(multipleBarChartMateri, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Total",
                            backgroundColor: 'rgb(23, 125, 255)',
                            borderColor: 'rgb(23, 125, 255)',
                            data: totalMateri,
                        }],
                    },
                    options: {
                        legend: {
                            position: 'bottom'
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                    }
                })
                $(".loadTotalMateri").css("display", "none");

            },
            error: function(xhr, status, error) {
                console.error('Error fetching chart data:', error)
            }
        })
    }
</script>
<?= $this->endSection(); ?>