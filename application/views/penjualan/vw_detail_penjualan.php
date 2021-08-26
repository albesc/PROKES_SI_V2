<div class="container-fluid">
    <div class="clearfix">
        <div class="float-left">
            <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
        </div>
        <div class="float-right">
            <a href="<?= base_url('Penjualan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
        </div>
    </div>

    <div class="row">
        <?= $this->session->flashdata('message');
        ?>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <img src="<?= base_url('assets/img/pembayaran/') . $penjualan['gambar']; ?>" style="width:400px" class="img-thumbnail">
                        </div>
                        <div class="col mr-2">
                            <div class="card-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="no_penjualan">No Penjualan</label>
                                        <input name="no_penjualan" type="text" value="<?= $penjualan['no_penjualan']; ?>" readonly class="form-control" id="no_penjualan">
                                    </div>
                                    <div class="form-group">
                                        <label for="pelanggan">Pelanggan</label>
                                        <input name="pelanggan" type="text" value="<?= $penjualan['nama']; ?>" readonly class="form-control" id="pelanggan">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input name="alamat" type="text" value="<?= $penjualan['alamat']; ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="total_bayar">Total Pembayaran</label>
                                        <input name="total_bayar" type="text" value="<?= $penjualan['total_bayar']; ?>" readonly class="form-control" id="harga">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Pilih Status</option>
                                            <option value="Pengemasan">Pengemasan</option>
                                            <option value="Proses Pengiriman">Proses Pengiriman</option>
                                            <option value="Dikirim">Dikirim</option>
                                        </select>
                                        <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <button type="submit" id="tambah" name="tambah" class="btn btn-primary float-right">Ubah Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12 col-md-12 mb-6">
            <div class="card-body">
                <div class="card border-left-primary shadow h-100 py-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>No Penjualan</td>
                                <td>Pelanggan</td>
                                <td>Buku</td>
                                <td>Jumlah</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($detail as $us) : ?>
                                <tr>
                                    <td><?= $i; ?>.</td>
                                    <td><?= $us['no_penjualan']; ?></td>
                                    <td><?= $us['nama']; ?></td>
                                    <td><?= $us['buku']; ?></td>
                                    <td><?= $us['jumlah']; ?></td>
                                    <td><?= $us['total']; ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>