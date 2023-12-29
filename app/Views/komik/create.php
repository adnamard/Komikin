<?= $this->extend('layout/templateadmin'); ?> #Kita kasih tau CI kalo kita bakalan render template
<?= $this->section('contentadmin') ?>


<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah data Komik</h2>
            <!--Validation Flash data ditampilin, pake cara kayak daftar komik -->

            <form action="/Admin/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?> <!-- Agar form tidak diinput dari mpihak ketiga -->

                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('judul') ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul'); ?>" autofocus>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('judul'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('penulis') ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('penulis'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= validation_show_error('genre') ? 'is-invalid' : ''; ?>" id="genre" name="genre" value="<?= old('genre'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('genre'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="sinopsis" class="col-sm-2 col-form-label">Sinopsis</label>
                    <div class="col-sm-10">
                        <textarea class="form-control <?= validation_show_error('sinopsis') ? 'is-invalid' : ''; ?>" id="sinopsis" name="sinopsis" rows="6"><?= old('sinopsis'); ?></textarea>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('sinopsis'); ?>
                        </div>
                    </div>
                </div>



                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= validation_show_error('harga') ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= validation_show_error('harga'); ?>
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <div class="mb-3">
                            <div class="custom-file">
                                <label for="Sampul" class="form-label"></label>
                                <input class="form-control <?= validation_show_error('sampul') ? 'is-invalid' : ''; ?>" type="file" id="sampul" name="sampul">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <?= validation_show_error('sampul'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>