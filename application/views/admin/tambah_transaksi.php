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
                    <h3>Tambah Transaksi</h3>
                    <p class="text-subtitle text-muted">
                        Menu Tambah Transaksi Baru Wafood
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="$<?= base_url(); ?>">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tambah <?= $title; ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-9">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Pembuat" class="col-sm-3 col-form-label">Pembuat</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $this->session->userdata('username'); ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Pembeli" class="col-sm-3 col-form-label">Pembeli</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="nama_pel" id="nama_pel" value="Umum" pattern="[A-Za-z ]+" title="Hanya huruf yang diizinkan" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nama_menu" class="col-sm-3 col-form-label">Menu</label>
                                <div class="col-9">
                                    <div class="input-group mb-1">
                                        <input type="hidden" id="id_menu">
                                        <input type="hidden" id="harga">
                                        <input type="hidden" id="stok">
                                        <input type="text" class="form-control" id="nama_menu" name="nama_menu" required autofocus autocomplete="off" readonly>
                                        <div class="input-group-append">

                                            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal_item"><i class="fa fa-search"></i></button> -->
                                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm"><i class="fas fa-search"></i></button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="qty" class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-9">
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" autocomplete="off" value="1" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-9 float-right">
                                    <button type="button" class="btn btn-primary" id="add_cart">
                                        <i class="fa fa-cart-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end">
                                <h5>No Transaksi : <b><span id="notrx"><?= $transaksi; ?></span></b></h5>
                                <h2><b><span id="grand_total2">0</span></b></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Menu</th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel_keranjang">
                                    <?php $this->load->view('admin/transaksi_data'); ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-5 col-form-label">Total</label>
                                <div class="col-7">
                                    <input type="number" class="form-control" name="sub_total" id="sub_total" disabled value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grand_total" class="col-sm-5 col-form-label">Metode Pembayaran</label>
                                <div class="col-7">
                                    <select name="metode" id="metode" class="form-control">
                                        <option value="">PILIH METODE PEMBAYARAN</option>
                                        <option value="1">Tunai</option>
                                        <option value="2">Non-Tunai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" id="tunai" style="display:none;">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="tunai" class="col-sm-5 col-form-label">Tunai</label>
                                <div class="col-7">
                                    <input type="number" class="form-control" name="tunai" id="tunaibay" value="0" min="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kembalian" class="col-sm-5 col-form-label">Kembalian</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" name="kembalian" id="kembalian" disabled value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <p><button class="btn btn-warning" id="batal_pembayaran"><i class="fas fa-sync"></i> Batal</button></p>
                            <p><button class="btn btn-success" style="margin-bottom: -10px!important" id="proses_pembayaran" disabled><i class="fas fa-paper-plane"></i> Proses Pembayaran</button></p>
                        </div>
                    </div>
                </div>
                <!-- .col-md-3 -->
            </div>
            <!-- .row -->
        </section>
    </div>
    <!-- modal tambah item produk-->
    <div class="modal fade text-left" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Pilih Menu Menu
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>Kode Menu</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menu as $data) : ?>
                                <tr>
                                    <td><?= $data->kd_menu; ?></td>
                                    <td><?= $data->nama_menu; ?></td>
                                    <td><?= $data->nama_kategori; ?></td>
                                    <td><?= "Rp. " . number_format($data->harga); ?></td>
                                    <td><?= $data->stok; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" id="select" data-kd="<?= $data->kd_menu; ?>" data-id_menu="<?= $data->id_menu; ?>" data-nama="<?= $data->nama_menu; ?>" data-kategori="<?= $data->nama_kategori; ?>" data-harga="<?= $data->harga; ?>" data-stok="<?= $data->stok; ?>"><i class="fa fa-check"></i> Pilih</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="modal-item-edit" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Edit pilihan menu
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="pilid_detailtransaksi">
                    <input type="hidden" id="pilid_menu">
                    <div class="form-group">
                        <label for="nama_menu"> Pilihan Menu</label>
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" id="pilkd_menu" class="form-control" disabled>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="pilnama_menu" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" id="pilharga" class="form-control" min="0" disabled>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="piljumlah" class="form-control" min="1">
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="number" id="piltotal" class="form-control" min="0" disabled>
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-success" id="updatepilmenu"><i class="fa fa-paper-plane"></i> Simpan</button>
                    </div>
                </div>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>