<!-- Begin Page Content-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header justify-content-center">
                Form Tambah Data Jurusan
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Jurusan</label>
                        <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control" id="nama" placeholder="Nama Jurusan">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="singkatan">Singkatan</label>
                        <input type="text" name="singkatan" value="<?= set_value('singkatan'); ?>" class="form-control" id="singkatan" placeholder="Singkatan">
                        <?= form_error('singkatan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="kepala_jurusan">Kepala Jurusan</label>
                        <select name="nama_kajur" id="menu_id" class="form-control" value="<?= set_value('nama_kajur'); ?>">
                            <option value="">Pilih Kajur</option>
                            <?php foreach ($dosen as $d) : ?>
                                <option value="<?= $d['id']; ?>"><?= $d['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('nama_kajur', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <a href="<? base_url('jurusan') ?>" class="btn btn-danger">Tutup</a>
                    <button type="submit" name="Tambah" class="btn btn-primary float-right">Tambah Jurusan</button>
                </form>
            </div>
        </div>
    </div>
</div>