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
                    <h3>Data Kategori</h3>
                    <p class="text-subtitle text-muted">
                        Menu Kategori Wafood
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
                    <div class="col-lg-2">
                        <button class="btn btn-outline-primary m-4" data-bs-toggle="modal" data-bs-target="#inlineForm"><span><i class="fas fa-plus"></i></span> Tambah Kategori</button>
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">
                                            Tambah Kategori
                                        </h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('admin/kategori'); ?>" method="post">
                                        <div class="modal-body">
                                            <label for="nama">Nama Kategori: </label>
                                            <div class="form-group">
                                                <input name="nama" type="text" placeholder="Nama kategori" class="form-control" pattern="[A-Za-z ]+" title="Hanya huruf yang diizinkan" required />
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
                                <th>Nama Kategori</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kategori as $mi) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $mi->nama_kategori ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="<?php echo base_url() . 'admin/kategori_edit/' . $mi->id_kategori; ?>"><span class="glyphicon glyphicon-plus"></span>Edit</a>
                                        <a class="btn btn-danger btn-sm" id="delwafood<?= $mi->id_kategori; ?>" onclick="getDel(<?= $mi->id_kategori; ?>)" data-nama="<?= $mi->nama_kategori; ?>" data-link="<?php echo base_url() . 'admin/kategori_hapus/' . $mi->id_kategori; ?>">Hapus</a>
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