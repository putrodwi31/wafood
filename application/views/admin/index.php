<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Statistik Penjualan</h3>
    </div>
    <?php $drk = '';
    $totdrk = '';
    foreach ($menufav as $ff) {
        $nama = $ff->nama_menu;
        $toooo = $ff->terjual;
        $totdrk .= $toooo . ", ";
        $drk .= "'$nama', ";
    }; ?>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="fas fa-utensils fa-lg" style="color: #ffff;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">
                                            Makanan
                                        </h6>
                                        <h6 class="font-extrabold mb-0"><?= $makanan->maktot; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="fas fa-wine-glass-alt fa-lg" style="color: #ffff;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Minuman</h6>
                                        <h6 class="font-extrabold mb-0"><?= $minuman->mintot; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="fas fa-wallet fa-lg" style="color: #ffff;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Pendapatan</h6>
                                        <h6 class="font-extrabold mb-0"><?= "Rp. " . number_format($pendapatan->sumtot, 0, ",", ".") ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Kategori</h6>
                                        <h6 class="font-extrabold mb-0"><?= $kategori; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Makanan & Minuman Terfoavorit</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4-5 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="<?= base_url() . 'dist/'; ?>assets/compiled/jpg/1.jpg" alt="Face 1" />
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold"><?= $_SESSION['username']; ?></h5>
                                <h6 class="text-muted mb-0">@<?= $_SESSION['username']; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Transaksi Terbaru</h4>
                    </div>
                    <div class="card-content pb-4">
                        <?php foreach ($transaksi as $t) {
                        ?>
                            <div class="recent-message d-flex px-4 py-3">
                                <?php if ($t->status == '1') { ?>
                                    <div class="avatar avatar-lg bg-success">
                                        <span class="avatar-content"><i class="bi bi-check-circle"></i></span>
                                    </div>
                                <?php } ?>
                                <?php if ($t->status == '2') { ?>
                                    <div class="avatar avatar-lg bg-warning">
                                        <span class="avatar-content"><i class="bi bi-question-circle"></i></span>
                                    </div>
                                <?php } ?>
                                <?php if ($t->status == '3') { ?>
                                    <div class="avatar avatar-lg bg-danger">
                                        <span class="avatar-content"><i class="bi bi-x-circle"></i></span>
                                    </div>
                                <?php } ?>
                                <?php if ($t->status == '') { ?>
                                    <div class="avatar avatar-lg bg-secondary">
                                        <span class="avatar-content"><i class="bi bi-exclamation-circle"></i></span>
                                    </div>
                                <?php } ?>
                                <div class="name ms-4">
                                    <h5 class="mb-1"><?= $t->no_transaksi; ?></h5>
                                    <h6 class="text-muted mb-0"><?= $t->nama_pembeli; ?> - <?= "Rp " . number_format($t->total_harga, 0, ",", "."); ?></h6>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="<?= base_url('dist/'); ?>assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script>
        var optionsProfileVisit = {
            annotations: {
                position: "back",
            },
            dataLabels: {
                enabled: false,
            },
            chart: {
                type: "bar",
                height: 300,
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {},
            series: [{
                name: "Terjual",
                data: [<?= $totdrk; ?>],
            }, ],
            colors: "#435ebe",
            xaxis: {
                categories: [<?= $drk; ?>],
            },
        }
        var chartProfileVisit = new ApexCharts(
            document.querySelector("#chart-profile-visit"),
            optionsProfileVisit
        )
        chartProfileVisit.render()
    </script>