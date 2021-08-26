<!-- Begin Page Content-->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $judul; ?></h1>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header justify-content-center">
                Form Ubah Data Dosen
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $dosen['id']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" value="<?= $dosen['nama']; ?>" class="form-control" id="nama" placeholder="Nama Dosen">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" value="<?= $dosen['nip']; ?>" class="form-control" id="nip" placeholder="NIP">
                            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="inisial">Inisial</label>
                            <input type="text" name="inisial" value="<?= $dosen['inisial']; ?>" class="form-control" id="inisial" placeholder="Inisial">
                            <?= form_error('inisial', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="program_studi">Program Studi</label>
                            <input type="text" name="prodi" value="<?= $dosen['prodi']; ?>" class="form-control" id="prodi" placeholder="Program Studi">
                            <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="<?= $dosen['email']; ?>" class="form-control" id="email" placeholder="Email">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kompetensi">Kompetensi</label>
                            <input type="text" name="kompetensi" value="<?= $dosen['kompetensi']; ?>" class="form-control" id="kompetensi" placeholder="Kompetensi">
                            <?= form_error('kompetensi', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <img src="<?= base_url('assets/img/dosen/') . $dosen['gambar']; ?>" style="width: 100px" class="img-thumbnail">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                <label for="gambar" class="custom-file-label">Choose File</label>
                            </div>
                        </div>
                        <a href="<? base_url('dosen') ?>" class="btn btn-danger">Tutup</a>
                        <button type="submit" name="edit" class="btn btn-primary float-right">Update Dosen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>