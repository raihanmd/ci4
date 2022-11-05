    
<?php 
$this->extend('layout/template');
?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col">
        <h3>Contact</h3>
        <?php foreach($alamat as $d) : ?>
            <ul>
                <li><?= $d['tipe']; ?></li>
                <li><?= $d['alamat']; ?></li>
                <li><?= $d['kota']; ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>