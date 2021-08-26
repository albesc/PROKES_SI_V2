<!-- Begin Page Content-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header justify-content-center">
                Form Ubah Data Jurusan
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $jurusan['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama Jurusan</label>
                            <input type="text" name="nama" value="<?= $jurusan['nama']; ?>" class="form-control" id="nama" placeholder="Nama Jurusan">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="singkatan">Singkatan</label>
                            <input type="text" name="singkatan" value="<?= $jurusan['singkatan']; ?>" class="form-control" id="singkatan" placeholder="Singkatan">
                            <?= form_error('singkatan', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                            <label for="nama_kajur">Kepala Jurusan</label>
                            <select name="nama_kajur" id="menu_id" class="form-control">
                                <?php foreach ($dosen as $p) : ?>
                                    <option value="<?= $p['id']; ?>" <?php if ($jurusan['nama_kajur'] == $p['id']) {
                                                                            echo "selected";
                                                                        } ?>> <?= $p['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <?= form_error('nama_kajur', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <a href="<? base_url('jurusan') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="edit" class="btn btn-primary float-right">Update Jurusan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>