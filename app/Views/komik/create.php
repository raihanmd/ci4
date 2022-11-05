<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<form action="/komik/save" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <div class="row">
        <div class="col-12 col-lg-8">
            <h2 class="my-4">Form Tambah Komik</h2>
            <div class="row g-3 align-items-center mt-3">
                <div class="mb-3 row">
                    <div class="col-6 form-group row">
                        <label for="judul" class="col-form-label">Judul</label>
                    </div>
                    <div class="col-6 form-group row">
                        <input type="text" id="judul" value="<?= old('judul'); ?>" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" aria-describedby="passwordHelpInline" name="judul" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-6 form-group row">
                        <label for="penulis" class="col-form-label">Penulis</label>
                    </div>
                    <div class="col-6 form-group row">
                        <input type="text" id="penulis" value="<?= old('penulis'); ?>" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" aria-describedby="passwordHelpInline" name="penulis">
                        <div class="invalid-feedback">
                            <?= $validation->getError('penulis'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-6 form-group row">
                        <label for="penerbit" class="col-form-label">Penerbit</label>
                    </div>
                    <div class="col-6 form-group row">
                        <input type="text" id="penerbit" value="<?= old('penerbit'); ?>" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" aria-describedby="passwordHelpInline" name="penerbit">
                        <div class="invalid-feedback">
                            <?= $validation->getError('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-6 form-group row">
                        <label for="sampul" class="col-form-label">Sampul</label>
                    </div>
                    <div class="col-6 form-group row">
                        <img src="/img/default.png" class="img-thumbnail img-preview" alt="">
                        <input type="file" name="sampul" id="sampul" class="form-control" onchange="previewImg();">
                        <div class="<?= ($validation->hasError('sampul')) ? 'invalid-feedback d-block' : 'd-none'; ?>"><?= $validation->getError('sampul'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>