<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success">
        <?= session('success') ?>
    </div>
<?php elseif (session()->has('error')) : ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php endif; ?>
<div class="container-client">
    <div class="row-client">
        <div class="col" style="width:auto">
            <h3 style="display: flex;justify-content: center;align-items: center;margin-bottom:3">Riwayat Pembelian</h3>
            <br></br>

            <?php
            // Array untuk data bayar_keberapa sebagai kunci
            $dataPerBayarKeberapa = [];

            // Mengelompokkan data berdasarkan bayar_keberapa
            foreach ($riwayatTransaksi as $item) {
                $transaksi = $item['transaksi'];
                $dataPerBayarKeberapa[$transaksi][] = $item;
            }
            ?>

            <?php foreach ($dataPerBayarKeberapa as $transaksi => $items) : ?>
                <?php foreach ($items as $item) : ?>
                    <h4>Transaksi-<?= $transaksi ?></h4>
                    <div class="card mb-3" style="border-radius:50px;">
                        <div class="row g-0" style="width:650px">
                            <div class="col-md-4" style="width:auto;border-radius:70px;">
                                <img src="/img/<?= $item['bukti_pembayaran']; ?>" class=" img-fluid" style="max-width: 200px; border-radius:50px;" alt="...">
                            </div>
                            <div class="col-md-8" style="padding-left: 10px;">
                                <div class="card-body">
                                    <p class="card-text">Nama : <?= $item['username']; ?></p>
                                    <p class="card-text">Email : <?= $item['email']; ?></p>
                                    <p>-- Komik yang Dibeli --</p>
                                    <p class="card-text">Judul Komik : <?= $item['judul']; ?></p>
                                    <p class="card-text">Harga Komik : <?= $item['harga']; ?></p>
                                    <p class="mb-2"><strong>Status:</strong> <span class="<?= getStatusColorClass($item['status_id']); ?> p-1 rounded"><?= $item['status']; ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php
function getStatusColorClass($status)
{
    switch ($status) {
        case 1:
            return 'bg-warning'; // Warna kuning
        case 2:
            return 'bg-success'; // Warna hijau
        case 3:
            return 'bg-danger'; // Warna merah
        default:
            return ''; // Warna default
    }
}
?>

<?= $this->endSection(); ?>