<!-- Begin Page Content-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header justify-content-center">
                Form Ubah Data Prodi
            </div>
            <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $prodi['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Prodi</label>
                            <input type="text" name="nama" value="<?= $prodi['nama']; ?>" class="form-control" id="nama" placeholder="Nama Jurusan">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="ruangan">Ruangan</label>
                            <input type="text" name="ruangan" value="<?= $prodi['ruangan']; ?>" class="form-control" id="singkatan" placeholder="Singkatan">
                            <?= form_error('ruangan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="ruangan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-control">
                                <?php foreach ($jurusan as $p) : ?>
                                    <option value="<?= $p['id']; ?>" <?php if ($prodi['jurusan'] == $p['id']) {
                                                                            echo "selected";
                                                                        } ?>><?= $p['nama']; ?></option>
                                <?php endforeach; ?>
                                <?= form_error('jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="akreditasi">Akreditasi</label>
                            <input type="text" name="akreditasi" value="<?= $prodi['akreditasi']; ?>" class="form-control" id="akreditasi" placeholder="Akreditasi">
                            <?= form_error('akreditasi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="nama_kaprodi">Nama Kaprodi</label>
                            <select name="nama_kaprodi" id="nama_kaprodi" class="form-control">
                                <?php foreach ($dosen as $p) : ?>
                                    <option value="<?= $p['id']; ?>" <?php if ($prodi['nama_kaprodi'] == $p['id']) {
                                                                            echo "selected";
                                                                        } ?>><?= $p['nama']; ?></option>
                                <?php endforeach; ?>
                                <?= form_error('nama_kaprodi', '<small class="text-danger pl-3">', '</small>'); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tahun_berdiri">Tahun Berdiri</label>
                            <input type="text" name="tahun_berdiri" value="<?= $prodi['tahun_berdiri']; ?>" class="form-control" id="tahun_berdiri" placeholder="Tahun Berdiri">
                            <?= form_error('tahun_berdiri', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="output_lulusan"> Output Lulusan</label>
                            <input type="text" name="output_lulusan" value="<?= $prodi['output_lulusan']; ?>" class="form-control" id="output_lulusan" placeholder="Output Lulusan">
                            <?= form_error('output_lulusan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>


                        <a href="<? base_url('prodi') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="edit" class="btn btn-primary float-right">Edit Prodi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>