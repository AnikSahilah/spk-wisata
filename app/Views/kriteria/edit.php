<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4 font-lora">
    <div class="card shadow rounded p-4 mx-auto" style="max-width: 720px;">
        <h4 class="mb-4 text-center">Edit Kriteria</h4>

        <form action="/admin/kriteria/update/<?= $kriteria['id'] ?>" method="post">
            <?= csrf_field() ?>

            <!-- Form isiannya dari view partial -->
            <?= view('kriteria/form', ['kriteria' => $kriteria]) ?>

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary px-4">Update</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>