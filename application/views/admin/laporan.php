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
                    <div class="col-lg-2">
                        <button class="btn btn-outline-primary m-4" data-bs-toggle="modal" data-bs-target="#inlineForm"><span><i class="bi bi-search"></i></span> Cari Laporan</button>
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">
                                            Laporan
                                        </h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <?= form_open_multipart('admin/laporan'); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="daritgl">Dari tanggal</label>
                                            <input type="date" name="dari" id="daritgl" class="form-control" required>
                                            <?php echo form_error('dari') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="sampaitgl">Sampai tanggal</label>
                                            <input type="date" name="sampai" id="sampaitgl" class="form-control" required>
                                            <?php echo form_error('sampai') ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Tutup</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ms-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Cari</span>
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>