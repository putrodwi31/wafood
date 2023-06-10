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
                    <h3>Data Menu</h3>
                    <p class="text-subtitle text-muted">
                        Menu Makanan & Minuman Wafood
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
                    <div class="col-lg-2">
                        <button class="btn btn-outline-primary m-4" data-bs-toggle="modal" data-bs-target="#inlineForm"><span><i class="fas fa-plus"></i></span> Tambah Menu</button>
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">
                                            Tambah Menu
                                        </h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <?= form_open_multipart('admin/menu'); ?>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                Gambar:
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img id="output_image" class="img-thumbnail">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="file" id="image" name="image" onchange="loadFile(event)" accept="image/gif, image/jpeg, image/jpg, image/png" required />
                                        </div>
                                        <label for="nama">Nama Menu: </label>
                                        <div class="form-group">
                                            <input name="nama" type="text" placeholder="Nama Makanan" class="form-control" pattern="[A-Za-z ]+" title="Hanya huruf yang diizinkan" required />
                                        </div>
                                        <label for="kategori">Kategori: </label>
                                        <div class="form-group">
                                            <select name="kategori" id="kategori" class="form-control">
                                                <option value="1">Makanan</option>
                                                <option value="2">Minuman</option>
                                            </select>
                                        </div>
                                        <label for="harga">Harga: </label>
                                        <div class="form-group">
                                            <input name="harga" type="number" placeholder="Harga Makanan" class="form-control" required />
                                        </div>
                                        <label for="stok">Stok: </label>
                                        <div class="form-group">
                                            <input name="stok" type="number" placeholder="Stok Makanan" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Tutup</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ms-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Tambah</span>
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>gambar</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                                <th>Status</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($menu as $m) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $m->nama_menu ?></td>
                                    <td><?php echo $m->nama_kategori ?></td>
                                    <td><img src="<?= base_url('dist/assets/static/images/makanan/') . $m->gambar; ?>" alt="" class="img-thumbnail" width="100px" height="100px"></td>
                                    <td><?= "Rp. " . number_format($m->harga) . ' ,-' ?></td>
                                    <td><?php echo $m->stok . ' Porsi' ?></td>
                                    <td><?php echo $m->terjual . ' Porsi' ?></td>
                                    <td><?= ($m->stok > '4') ? '<span class="badge bg-success">Tersedia</span>' : (($m->stok <= '4' && $m->stok > '0') ? '<span class="badge bg-warning">Hampir habis</span>' : (($m->stok == '0') ? '<span class="badge bg-danger">Habis</span>' : '')) ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="<?php echo base_url() . 'admin/menu_edit/' . $m->id_menu; ?>"><span class="glyphicon glyphicon-plus"></span>Edit</a>
                                        <a class="btn btn-danger btn-sm" id="delwafood<?= $m->id_menu; ?>" onclick="getDel(<?= $m->id_menu; ?>)" data-nama="<?= $m->nama_menu; ?>" data-link="<?php echo base_url() . 'admin/menu_hapus/' . $m->id_menu; ?>">Hapus</a>
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