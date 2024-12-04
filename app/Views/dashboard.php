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
                    <div class="card-title">Total Santri </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="multipleBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Total Ustadz</div>
                </div>
                <div class="card-body">
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
            },
            error: function(xhr, status, error) {
                console.error('Error fetching chart data:', error)
            }
        })
    }
</script>
<?= $this->endSection(); ?>