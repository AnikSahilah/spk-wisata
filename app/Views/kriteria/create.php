<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4 text-center font-lora">
    <h2 class="mb-4">Tambah Kriteria</h2>
    <form action="/admin/kriteria/store" method="post" class="d-inline-block text-start" style="max-width: 500px; width: 100%;">
        <?= csrf_field() ?>
        <?= view('kriteria/form') ?>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>