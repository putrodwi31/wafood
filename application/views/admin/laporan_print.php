<html>

<head>
    <title><?= $judul; ?></title>
    <style type="text/css">
        * {
            font-family: arial;
            background-color: #fff
        }

        .rangkasurat {
            background-color: #fff;
        }

        .tengah {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td> <img src="<?= base_url() . 'dist/'; ?>assets/compiled/png/logo.png" alt="Logo" srcset="" width="140px" /> </td>
                <td class="tengah">
                    <h2>Warteg Amir</h2>
                    <p>Jl. Raya Siliwangi No.6, RT.001/RW.004, Sepanjang Jaya, Kec. Rawalumbu, Kota Bks, Jawa Barat 17114</p>
                </td>
            </tr>
        </table>
        <hr>

        <style>
            .table-data {
                width: 100%;
                border-collapse: collapse;
            }

            .table-data tr th,
            .table-data tr td {
                border: 1px solid black;
                font-size: 10pt;
            }
        </style>
        <h3>Laporan Transaksi</h3>
        <table>
            <tr>
                <td>Dari Tanggal</td>
                <td>:</td>
                <td><?= date('d/m/Y', strtotime($_GET['dari'])); ?></td>
            </tr>
            <tr>
                <td>Sampai Tanggal</td>
                <td>:</td>
                <td><?= date('d/m/Y', strtotime($_GET['sampai'])); ?></td>
            </tr>
        </table>

        <br>
        <table class="table-data">
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
                foreach ($laporan as $t) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $t->no_transaksi; ?></td>
                        <td><?= $t->nama_pembeli; ?></td>
                        <td><?= date('d/m/Y', strtotime($t->tanggal_transaksi)); ?></td>
                        <td><?= "Rp. " . number_format($t->total_harga) . ' ,-' ?></td>

                        <td><?= $t->metode == '1' ? 'Tunai' : 'Nontunai' ?></td>
                        <td><?= ($t->status == '1') ? '<span class="badge bg-success">Selesai</span>' : (($t->status == '2' ? "<span id='menunggu_pembayaran' data-token='$t->token' data-no_transaksi='$t->no_transaksi' class='badge bg-warning'>Menunggu pembayaran</span>" : (($t->status == '3') ? '<span class="badge bg-danger">Pembayaran gagal</span>' : '<span class="badge bg-secondary ">Invalid</span>'))) ?></td>

                    </tr>

                <?php
                }
                ?>
            </tbody>

        </table>
        <p style="text-align: right; font-size: medium; align-items: flex-end; "><b>Bekasi, <?= date('d F Y'); ?></b></p>
        <p style="padding: 0; margin-top: -15px;  font-weight: bold; text-align: right; font-size: medium;">Pembuat</p>
        <p style="padding: 0; margin-top: 80px;  font-weight: bold; text-align: right; font-size: medium;"><?= $_SESSION['username']; ?></p>


    </div>
</body>

</html>