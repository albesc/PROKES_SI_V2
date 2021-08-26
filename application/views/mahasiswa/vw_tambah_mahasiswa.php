<!-- Begin Page Content-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header justify-content-center">
                Form Tambah Data Mahasiswa
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control" id="nama" placeholder="Nama">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">NIM</label>
                        <input type="text" name="nim" value="<?= set_value('nim'); ?>" class="form-control" id="nim" placeholder="NIM">
                        <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">Jenis Kelamin</label>
                        <select type="text" name="jenis_kelamin" value="<?= set_value('jenis_kelamin'); ?>" class="form-control" id="jenis_kelamin">
                            <option value="">Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <?= form_error('jenis_kelamin', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">email</label>
                        <input type="text" name="email" value="<?= set_value('email'); ?>" class="form-control" id="email" placeholder="Email">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <select name="prodi" id="menu_id" class="form-control" value="<?= set_value('jenis_kelamin'); ?>">
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="<?= set_value('asal_sekolah'); ?>" class="form-control" id="asal_sekolah" placeholder="Asal Sekolah">
                        <?= form_error('asal_sekolah', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">No HP</label>
                        <input type="text" name="no_hp" value="<?= set_value('no_hp'); ?>" class="form-control" id="no_hp" placeholder="NO HP">
                        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">Alamat</label>
                        <input type="text" name="alamat" value="<?= set_value('alamat'); ?>" class="form-control" id="alamat" placeholder="alamat">
                        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <a href="<? base_url('mahasiswa') ?>" class="btn btn-danger">Tutup</a>
                    <button type="submit" name="Tambah" class="btn btn-primary float-right">Tambah Mahasiswa</button>
                </form>
            </div>
        </div>
    </div>
</div>