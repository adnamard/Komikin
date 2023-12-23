<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('pesan') ?>
    </div>
<?php endif; ?>
<h1>Welcome Customer</h1>

<?= $this->endSection(); ?>