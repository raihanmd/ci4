<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
    <div class="row">
        <div class="row">
            <div class="col-5 col-sm-12 col-md-8 col-lg-5">
                <h2 class="mt-2">
                    <a href="<?= base_url('/anime'); ?>" style="text-decoration: none; color: black;">Daftar Komik</a>
                </h2>
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari sesuatu..." name="keyword">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" name="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col">
            <!-- <a href="/komik/create" class="btn btn-primary mt-2">Tambah Komik</a> -->
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Studio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach($anime as $a): ?>
                    <tr>
                    <th scope="row"><?= $a['id']; ?></th>
                    <td><?= $a['judul']; ?></td>
                    <td><?= $a['studio']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- param 1 = nama tabel param 2 = file pagination -->
            <?= ($searching == true) ? $pager->links('anime', 'anime_pagination') :  '' ; ?>
        </div>
    </div>
<?= $this->endSection(); ?>