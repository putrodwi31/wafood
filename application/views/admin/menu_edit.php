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
                    <h3>Edit Menu</h3>
                    <p class="text-subtitle text-muted">
                        Edit Menu Wafood
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
                    <?= form_open_multipart('admin/menu_edit/' . $menu->id_menu); ?>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            Gambar:
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img id="output_image" class="img-thumbnail" src="<?= base_url('dist/assets/static/images/makanan/') . $menu->gambar; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" id="image" name="image" onchange="loadFile(event)" accept="image/gif, image/jpeg, image/jpg, image/png" />
                    </div>
                    <label for="nama">Nama menu: </label>
                    <div class="form-group">
                        <input name="nama" type="text" placeholder="Nama menu" class="form-control" value="<?= $menu->nama_menu; ?>" />
                    </div>
                    <div class="form-group">
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="1" <?= $menu->id_kategori == 1 ? 'selected=selected' : ''; ?>>Makanan</option>
                            <option value="2" <?= $menu->id_kategori == 2 ? 'selected=selected' : ''; ?>>Minuman</option>
                        </select>
                    </div>
                    <label for="harga">Harga: </label>
                    <div class="form-group">
                        <input name="harga" type="number" placeholder="Harga menu" class="form-control" value="<?= $menu->harga; ?>" />
                    </div>
                    <label for="stok">Stok: </label>
                    <div class="form-group">
                        <input name="stok" type="number" placeholder="Stok menu" class="form-control" value="<?= $menu->stok; ?>" />
                    </div>
                    <a href="<?= base_url('admin/menu'); ?>" class="btn btn-danger">
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