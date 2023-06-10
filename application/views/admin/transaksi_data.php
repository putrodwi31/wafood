<?php $no = 1;
if ($transaksi_data->num_rows() > 0) {
    foreach ($transaksi_data->result() as $k => $data) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data->kd_menu; ?></td>
            <td><?= $data->nama_menu; ?></td>
            <td><?= $data->harga; ?></td>
            <td><?= $data->jumlah; ?></td>
            <td id="total"><?= $data->jumlah * $data->harga; ?></td>
            <td>
                <button class="btn btn-success btn-sm" id="edit_transaksi_data" data-bs-toggle="modal" data-bs-target="#modal-item-edit" data-kd="<?= $data->kd_menu; ?>" data-nama_menu="<?= $data->nama_menu; ?>" data-total="<?= $data->jumlah * $data->harga; ?>" data-harga="<?= $data->harga; ?>" data-iddetail="<?= $data->id_detailtransaksi; ?>" data-idmenu="<?= $data->id_menu; ?>" data-jumlah="<?= $data->jumlah; ?>"><i class="fa fa-edit"></i></button>

                <button class="btn btn-danger btn-sm" id="hapus_transaksi_data" data-idtransaksi_data="<?= $data->id_detailtransaksi; ?>"><i class="fa fa-trash"></i></button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php } else {
    echo '<tr><td colspan="8" class="text-center">Tidak ada menu yang dipilih!</td></tr>';
} ?>