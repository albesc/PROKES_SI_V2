<!-- Begin Page Content-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header justify-content-center">
                Form Tambah Data Buku
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Buku</label>
                        <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control" id="nama" placeholder="Nama Buku">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" name="pengarang" value="<?= set_value('pengarang'); ?>" class="form-control" id="pengarang" placeholder="Pengarang">
                        <?= form_error('pengarang', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" name="stok" value="<?= set_value('stok'); ?>" class="form-control" id="stok" placeholder="Stok">
                        <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga Buku</label>
                        <input type="text" name="harga" value="<?= set_value('harga'); ?>" class="form-control" id="harga" placeholder="Harga Buku">
                        <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="Gambar">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="gambar" id="gambar">
                            <label for="gambar" class="custom-file-label">Choose File</label>
                        </div>
                    </div>

                    <a href="<? base_url('buku') ?>" class="btn btn-danger">Tutup</a>
                    <button type="submit" name="Tambah" class="btn btn-primary float-right">Tambah Buku</button>
                </form>
            </div>
        </div>
    </div>
</div>