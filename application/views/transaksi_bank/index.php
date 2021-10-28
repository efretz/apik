<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Transaksi Bank</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Transaksi Bank</li>
          </ol>
        </div>
      </div>
  </section>

  <section class="content">

    <div class="row">
      <div class="col">
        <?php if ($this->session->flashdata('pesan')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> <?= $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
            <a href="<?= base_url('transaksi_bank/create/'); ?>" class="btn btn-sm btn-outline-success">Tambah</a>
            <a href="<?= base_url('transaksi_bank/import/'); ?>" class="btn btn-sm btn-outline-success ml-1">Impor CSV</a>
          </div>
          <div class="col-lg-6">
            <form action="" method="post" autocomplete="off">
              <div class="input-group">
                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama">
                <button class="btn btn-sm btn-outline-secondary" type="submit">Cari</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover table-sm">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Uraian</th>
              <th scope="col">Debet</th>
              <th scope="col">Kredit</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = $page + 1;
            foreach ($transaksi_bank as $r) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $r['tanggal']; ?></td>
                <td><?= $r['uraian']; ?></td>
                <td><?= $r['debet']; ?></td>
                <td><?= $r['kredit']; ?></td>
                <td>
                  <a href="<?= base_url('transaksi_bank/update/') . $r['id']; ?>" class="btn btn-sm btn-outline-warning">Ubah</a>
                  <a href="<?= base_url('transaksi_bank/delete/') . $r['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?');">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <?= $name == null ? $pagination : ''; ?>
      </div>
    </div>

  </section>
</div>