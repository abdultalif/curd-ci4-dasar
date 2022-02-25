<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="my-4">Detail Buku Komik</h3>
            <div class="card" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $detail['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b>Judul :</b> <?= $detail['judul']; ?></h5>
                            <p class="card-text"><b>Penulis :</b> <?= $detail['penulis']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit :</b> <?= $detail['penerbit']; ?></small></p>
                            <a href="/komik/edit/<?= $detail['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/komik/<?= $detail['id_komik'] ?>" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda Yakin ???')">Delete</button>
                            </form>
                            <br><br>
                            <a href="/komik">Kembali Ke daftar komik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>