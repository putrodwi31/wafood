<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Laporan Wafood</h3>
                    <p class="text-subtitle text-muted">
                        Menu Laporan Wafood
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?= $title; ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="row">
                    <div class="col-lg-3">
                        <a target="_blank" class="btn btn-outline-primary m-4" href="<?php echo base_url() . 'admin/laporan_print/?dari=' . set_value('dari') . '&sampai=' . set_value('sampai') ?>"><span><i class="bi bi-printer-fill"></i></span>Print</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Nama Pembeli</th>
                                <th>Tanggal Transaksi</th>
                                <th>Total Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($laporan as $l) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $l->no_transaksi; ?></td>
                                    <td><?php echo $l->nama_pembeli ?></td>
                                    <td><?php echo $l->tanggal_transaksi ?></td>
                                    <td><?= "Rp. " . number_format($l->total_harga) . ' ,-' ?></td>
                                    <td><?= $l->metode == '1' ? 'Tunai' : 'Nontunai' ?></td>
                                    <td><?= ($l->status == '1') ? '<span class="badge bg-success">Selesai</span>' : (($l->status == '2' ? "<span id='menunggu_pembayaran' data-token='$l->token' data-no_transaksi='$l->no_transaksi' class='badge bg-warning'>Menunggu pembayaran</span>" : (($l->status == '3') ? '<span class="badge bg-danger">Pembayaran gagal</span>' : '<span class="badge bg-secondary ">Invalid</span>'))) ?></td>

                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>