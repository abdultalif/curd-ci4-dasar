<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h1 class="mt-3">Daftar Orang</h1>
    <div class="row">
        <div class="col-6">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan Nama" name="nama">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1 + (6 * ($currentpage - 1));
                    foreach ($orang as $o) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>