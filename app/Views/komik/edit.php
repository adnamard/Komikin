<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah data Komik</h2>
            <!--Validation Flash data ditampilin, pake cara kayak daftar komik -->

            <form action="/admin/update/<?= $komik['id']; ?>" method="post">
                <?= csrf_field(); ?> <!-- Agar form tidak diinput dari mpihak ketiga -->

                <input type="hidden" name="slug" value="<?= $komik['judul']; ?>">
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('judul') ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $komik['judul']; ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-2 col-form-label">Genre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  " id="genre" name="genre" value="<?= (old('genre')) ? old('genre') : $komik['genre']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="genre" class="col-sm-2 col-form-label">Sinopsis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control  " id="sinopsis" name="sinopsis" value="<?= (old('sinopsis')) ? old('sinopsis') : $komik['sinopsis']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="genre" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="stok" name="stok" value="<?= (old('stok')) ? old('stok') : $komik['stok']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="genre" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $komik['harga']; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control " id="sampul" name="sampul" value="<?= (old('sampul')) ? old('sampul') : $komik['sampul']; ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>