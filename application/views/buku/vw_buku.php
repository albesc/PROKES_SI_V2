  <!-- Begin Page Content -->
  <div class="container-fluid">
      <!-- Page Heading -->
      <!--<h1 class="h3 mb-4 text-gray-800">Halaman Mahasiswa</h1>
                    <div class="row">
                        <div class="col-md-6"><a href="<?= base_url() ?>mahasiswa/tambah" class="btn btn-info mb-2">Tambah Mahasiswa</a></div>
                        <div class="col-md-12"> -->
      <?= $this->session->flashdata('message'); ?>
      <div class="clearfix">
          <div class="float-left">
              <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
          </div>
          <div class="float-right">
              <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Mahasiswa</a>
          </div>
      </div>
      <div class="card shadow mb-4">
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                          <tr>
                              <td>No</td>
                              <td>Gambar</td>
                              <td>Nama</td>
                              <td>Pengarang</td>
                              <td>Stok</td>
                              <td>Harga Buku</td>
                              <td>Action</td>
                          </tr>
                      </thead>
                      <tbody>
                          <?= $this->session->flashdata('message'); ?>
                          <?php $i = 1; ?>
                          <?php foreach ($buku as $bk) : ?>
                              <tr>
                                  <td><?= $i; ?></td>
                                  <td><img src="<?= base_url('assets/img/buku/') . $bk['gambar']; ?>" style="width:100px" class="img-thumbnail"></td>
                                  <td><?= $bk['nama'] ?></td>
                                  <td><?= $bk['pengarang'] ?></td>
                                  <td><?= $bk['stok'] ?></td>
                                  <td><?= $bk['harga'] ?></td>
                                  <td>
                                      <a href="<?= base_url('buku/delete/') . $bk['id']; ?>" class="badge badge-danger">Hapus</a>
                                      <a href="<?= base_url('buku/edit/') . $bk['id']; ?>" class="badge badge-warning">Edit</a>
                                  </td>
                              </tr>
                              <?php $i++; ?>
                          <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>