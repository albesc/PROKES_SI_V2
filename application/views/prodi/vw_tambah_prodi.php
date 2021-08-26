<!-- Begin Page Content-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header justify-content-center">
                Form Tambah Data Prodi
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama Prodi</label>
                        <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control" id="nama" placeholder="Nama Jurusan">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="ruangan">Ruangan</label>
                        <input type="text" name="ruangan" value="<?= set_value('ruangan'); ?>" class="form-control" id="singkatan" placeholder="Ruangan">
                        <?= form_error('ruangan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="menu_id" class="form-control" value="<?= set_value('jurusan'); ?>">
                            <option value="">Pilih Jurusan</option>
                            <?php foreach ($jurusan as $j) : ?>
                                <option value="<?= $j['id']; ?>"><?= $j['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="akreditasi">Akreditasi</label>
                        <input type="text" name="akreditasi" class="form-control" id="akreditasi" placeholder="Akreditasi" value="<?= set_value('akreditasi'); ?>">
                        <?= form_error('akreditasi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="nama_kaprodi">Nama Kaprodi</label>
                        <select name="nama_kaprodi" id="menu_id" class="form-control" value="<?= set_value('nama_kaprodi'); ?>">
                            <option value="">Pilih Kajur</option>
                            <?php foreach ($dosen as $d) : ?>
                                <option value="<?= $d['id']; ?>"><?= $d['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('nama_kaprodi', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="tahun_berdiri">Tahun Berdiri</label>
                        <input type="text" name="tahun_berdiri" value="<?= set_value('tahun_berdiri'); ?>" class="form-control" id="tahun_berdiri" placeholder="Tahun Berdiri">
                        <?= form_error('tahun_berdiri', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>

                    <div class="form-group">
                        <label for="output_lulusan"> Output Lulusan</label>
                        <input type="text" name="output_lulusan" class="form-control" id="output_lulusan" placeholder="Output Lulusan" value="<?= set_value('output_lulusan'); ?>">
                        <?= form_error('output_lulusan', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>


                    <a href="<? base_url('prodi') ?>" class="btn btn-danger">Tutup</a>
                    <button type="submit" name="Tambah" class="btn btn-primary float-right">Tambah Prodi</button>
                </form>
            </div>
        </div>
    </div>
</div>