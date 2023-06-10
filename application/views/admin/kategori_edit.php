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
                    <h3>Edit Kategori</h3>
                    <p class="text-subtitle text-muted">
                        Edit Kategori Wafood
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url(); ?>">Dashboard</a>
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
                <div class="card-body">
                    <?= form_open_multipart('admin/kategori_edit/' . $kategori->id_kategori); ?>
                    <label for="nama">Nama kategori: </label>
                    <div class="form-group">
                        <input name="nama" type="text" placeholder="Nama kategori" class="form-control" value="<?= $kategori->nama_kategori; ?>" required pattern="[A-Za-z ]+" title="Hanya huruf yang diizinkan" />
                    </div>
                    <a href="<?= base_url('admin/kategori'); ?>" class="btn btn-danger">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kembali</span>
                    </a>
                    <button type="submit" class="btn btn-primary ms-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Edit</span>
                    </button>

                    </form>
                </div>
            </div>
        </section>
    </div>