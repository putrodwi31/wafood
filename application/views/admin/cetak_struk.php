<?php
// jika id penjualan salah redirect ke halaman penjualan
if ($transaksi->id_transaksi == null) {
    redirect(base_url('transaksi'));
    exit;
}

?>
<html moznomarginboxes mozdisalowselectionprint>

<head>
    <title>Warteg Amir - Print Invoice</title>
    <style>
        html {
            font-family: "Verdana, Arial";
        }

        .container {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 20px;
            padding-bottom: 5px;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        .table {
            width: 100%;
            font-size: 12px;
        }

        .kiri {
            text-align: left;
        }

        .kanan {
            text-align: right;
        }

        .terimakasih {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="title">
            <b>Warteg Amir</b>
            <br>
        </div>
        <div style="text-align: center; border-bottom: 1px solid; margin-top: 10px; padding-bottom: 10px;">
            <span style="text-align: center; font-size: 12px; ">Jl. Raya Siliwangi No.6, RT.001/RW.004, Sepanjang Jaya, Kec. Rawalumbu, Kota Bks, Jawa Barat 17114</span>
        </div>
        <div class="head">
            <table class="table">
                <tr>
                    <td class="kiri"><?= date('d F Y', strtotime($transaksi->tanggal_transaksi)); ?></td>
                    <td class="kanan"> Pembuat :</td>
                    <td class="kanan"><?= $_SESSION['username']; ?></td>
                </tr>
                <tr>
                    <td class="kiri"><?= $transaksi->no_transaksi; ?></td>
                    <td class="kanan">Pembeli :</td>
                    <td class="kanan"><?= $transaksi->nama_pembeli; ?></td>
                </tr>
                <tr>
                    <td class="kiri"></td>
                    <td class="kanan">Pembayaran :</td>
                    <td class="kanan"><?= $transaksi->metode == '1' ? 'Tunai' : 'Nontunai'; ?></td>
                </tr>
            </table>
        </div>
        <div class="transaksi">
            <table class="table">
                <?php foreach ($menu as $m) { ?>
                    <tr>
                        <td class="kiri"><?= $m->nama_menu; ?></td>
                        <td class="kanan"><?= $m->jumlah; ?></td>
                        <td class="kanan"><?= $m->harga; ?></td>
                        <td class="kanan"><?= "Rp. " . number_format($m->harga * $m->jumlah) . ' ,-'  ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="border-bottom:1px dashed; "></td>
                </tr>
                <tr>
                    <td colspan="3" class="kanan"> Total</td>
                    <td class="kanan"><?= "Rp. " . number_format($transaksi->total_harga) . ' ,-' ?></td>
                </tr>
                <?php if ($transaksi->metode != '2') { ?>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2" style="border-bottom: 1px dashed;"></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="kanan"> Tunai</td>
                        <td class="kanan"><?= "Rp. " . number_format($transaksi->tunai) . ' ,-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="kanan">Kembalian</td>
                        <td class="kanan"><?= "Rp. " . number_format($transaksi->kembalian) . ' ,-' ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div class="terimakasih">
            ~~~~~ Terima Kasih ~~~~~
            <br>
            Wafood.id
        </div>
    </div>
</body>

</html>