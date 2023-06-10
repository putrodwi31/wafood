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
                    <h3>Data Transaksi</h3>
                    <p class="text-subtitle text-muted">
                        Transaksi Wafood
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="$<?= base_url(); ?>">Dashboard</a>
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
                        <a class="btn btn-outline-primary m-4" href="<?= base_url('admin/tambah_transaksi'); ?>"><span><i class="fas fa-plus"></i></span> Tambah Transaksi</a>
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
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($transaksi as $t) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $t->no_transaksi; ?></td>
                                    <td><?php echo $t->nama_pembeli ?></td>
                                    <td><?php echo $t->tanggal_transaksi ?></td>
                                    <td><?= "Rp. " . number_format($t->total_harga) . ' ,-' ?></td>
                                    <td><?= $t->metode == '1' ? 'Tunai' : 'Nontunai' ?></td>
                                    <td><?= ($t->status == '1') ? '<span class="badge bg-success">Selesai</span>' : (($t->status == '2' ? "<span id='menunggu_pembayaran' data-token='$t->token' data-no_transaksi='$t->no_transaksi' class='badge bg-warning'>Menunggu pembayaran</span>" : (($t->status == '3') ? '<span class="badge bg-danger">Pembayaran gagal</span>' : '<span class="badge bg-secondary ">Invalid</span>'))) ?></td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-no="<?= $t->no_transaksi; ?>" id="printtrans" <?= $t->status != '1' ? ' disabled' : ''; ?>><i class="bi bi-printer-fill"></i></button>
                                    </td>

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
    <script>
    </script>