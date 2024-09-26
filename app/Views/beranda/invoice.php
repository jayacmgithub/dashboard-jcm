<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>
<ul class="nav nav-tabs" id="myTab" role="tablist">

    <?php if ($pro1 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_01" role="tab" aria-controls="gedung1"
                aria-selected="true">GEDUNG 1</a>
        </li>
    <?php } ?>
    <?php if ($pro2 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_02" role="tab" aria-controls="gedung2"
                aria-selected="true">GEDUNG 2</a>
        </li>
    <?php } ?>
    <?php if ($pro3 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_03" role="tab" aria-controls="gedung3"
                aria-selected="true">KTL 1</a>
        </li>
    <?php } ?>
    <?php if ($pro4 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_04" role="tab" aria-controls="gedung4"
                aria-selected="true">KTL 2</a>
        </li>
    <?php } ?>
    <?php if ($pro5 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_05" role="tab" aria-controls="gedung5"
                aria-selected="true">TRANSPORTASI 1</a>
        </li>
    <?php } ?>
    <?php if ($pro6 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" id="gedung6-tab" data-toggle="tab" href="#gedung6" role="tab" aria-controls="gedung6"
                aria-selected="true">TRANSPORTASI 2</a>
        </li>
    <?php } ?>    <?php if ($pro7 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_07" role="tab" aria-controls="gedung7"
                aria-selected="true">MARKETING</a>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link active" href="<?= base_url() ?>dashboard/invoice" role="tab" aria-controls="gedung8"
            aria-selected="true">INVOICE</a>
    </li>
</ul>
<?php date_default_timezone_set("Asia/Jakarta");
$now = date("Y-m-d");
$tgl_terawang = date('Y-m-d', strtotime('-365 days', strtotime($now)));
?>

<div class="tab-content" id="myTabContent">
    <!--GEDUNG1-->
    <?php if ($pro2 == 1) { ?>
        <div class="tab-pane active" id="gedung6" role="tabpanel" aria-labelledby="gedung6-tab">
            <!---->
            <div>
                <h4 class="card-title">PROGRESS INVOICE PER DIVISI</h4>
                <div class="row justify-content-center">
                    <div class="col-md-2">
                        <div class="card bg-secondary"
                            style="border-top-right-radius:20px; border-bottom-left-radius:20px;box-shadow: 0 4px 6px rgba(0,0,0,0.10);">
                            <div class="card-header" style="border-top-right-radius:20px; background-color:#08253d">
                                <div class="card-title text-white">Divisi Gedung 1</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="chart1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-secondary"
                            style="border-top-right-radius:20px; border-bottom-left-radius:20px;box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <div class="card-header" style="border-top-right-radius:20px; background-color:#08253d">
                                <div class="card-title text-white">Divisi Gedung 2</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="chart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-secondary"
                            style="border-top-right-radius:20px; border-bottom-left-radius:20px;box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <div class="card-header" style="border-top-right-radius:20px; background-color:#08253d">
                                <div class="card-title text-white">Divisi KTL 1</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="chart3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-secondary"
                            style="border-top-right-radius:20px; border-bottom-left-radius:20px;box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <div class="card-header" style="border-top-right-radius:20px; background-color:#08253d">
                                <div class="card-title text-white">Divisi KTL 2</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="chart4"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-secondary"
                            style="border-top-right-radius:20px; border-bottom-left-radius:20px;box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <div class="card-header" style="border-top-right-radius:20px; background-color:#08253d">
                                <div class="card-title text-white">Divisi Trans 1</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="chart5"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-secondary"
                            style="border-top-right-radius:20px; border-bottom-left-radius:20px;box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <div class="card-header" style="border-top-right-radius:20px; background-color:#08253d">
                                <div class="card-title text-white">Divisi Trans 2</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="chart6"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row ">
                <div class="col-lg-12">
                    <span class="label3 label-info m-r-5 text-success"
                        style="background-color: #ff6361;margin-top: 2px; border-radius:20px"></span> <a
                        style="font-size: 12px;">BAP</a>
                    <span class="label3 label-info m-r-5 text-success"
                        style="background-color: #47e339;margin-top: 2px; border-radius:20px"></span> <a
                        style="font-size: 12px;">CAIR</a>
                </div>
            </div>
        </div>
    </div>
    </section>

    <?= $this->include('layout/js') ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('ul li a').click(function () {
                $('li a').removeClass("active");
                $(this).addClass("active");
            });
        });
        $(".table-scrollable").freezeTable({
            'scrollable': true,
            'columnNum': 2,
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx1 = document.getElementById('chart1').getContext('2d');
            var chart1 = new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: ['BAP', 'CAIR'],
                    datasets: [{
                        label: '',
                        data: [12, 19],
                        backgroundColor: [
                            '#ff6361',
                            '#47e339'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                            labels: {
                                boxWidth: 10
                            }
                        }
                    }
                }
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx2 = document.getElementById('chart2').getContext('2d');
            var chart2 = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['BAP', 'CAIR'],
                    datasets: [{
                        label: '',
                        data: [30, 50],
                        backgroundColor: [
                            '#ff6361',
                            '#47e339'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                            labels: {
                                boxWidth: 10
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx3 = document.getElementById('chart3').getContext('2d');
            var chart3 = new Chart(ctx3, {
                type: 'doughnut',
                data: {
                    labels: ['BAP', 'CAIR'],
                    datasets: [{
                        label: '',
                        data: [10, 30],
                        backgroundColor: [
                            '#ff6361',
                            '#47e339'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                            labels: {
                                boxWidth: 10
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx4 = document.getElementById('chart4').getContext('2d');
            var chart4 = new Chart(ctx4, {
                type: 'doughnut',
                data: {
                    labels: ['BAP', 'CAIR'],
                    datasets: [{
                        label: '',
                        data: [25, 35],
                        backgroundColor: [
                            '#ff6361',
                            '#47e339'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                            labels: {
                                boxWidth: 10
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx5 = document.getElementById('chart5').getContext('2d');
            var chart5 = new Chart(ctx5, {
                type: 'doughnut',
                data: {
                    labels: ['BAP', 'CAIR'],
                    datasets: [{
                        label: '',
                        data: [20, 40],
                        backgroundColor: [
                            '#ff6361',
                            '#47e339'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                            labels: {
                                boxWidth: 10
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx6 = document.getElementById('chart6').getContext('2d');
            var chart6 = new Chart(ctx6, {
                type: 'doughnut',
                data: {
                    labels: ['BAP', 'CAIR'],
                    datasets: [{
                        label: '',
                        data: [25, 30],
                        backgroundColor: [
                            '#ff6361',
                            '#47e339'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                            labels: {
                                boxWidth: 10
                            }
                        }
                    }
                }
            });
        });
    </script>



    <?= $this->endSection(); ?>