<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4 text-center font-lora">
    <h2 class="mb-4">Edit Kriteria</h2>
    <form action="/admin/kriteria/update/<?= $kriteria['id'] ?>" method="post" class="d-inline-block text-start" style="max-width: 500px; width: 100%;">
        <?= csrf_field() ?>
        <?= view('kriteria/form', ['kriteria' => $kriteria]) ?>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>