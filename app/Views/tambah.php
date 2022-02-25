<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h3 class="my-3">Form Tambah Data Komik</h3>
            <form action="/komik/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul'); ?>" autofocus>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('penulis'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.png" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" name="sampul" id="sampul" class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" onchange="previewImg()">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">Tambah</button>
                        <a href="/komik" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>