<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="card shadow rounded p-4 mx-auto mt-4" style="max-width: 720px;">

    <h2 class="mb-4">Edit Sub Kriteria</h2>

    <!-- <form action="<?= route_to('admin/sub-kriteria/update', $subkriteria['id']) ?>" method="post"> -->
    <form action="/admin/sub-kriteria/update/<?= $subkriteria['id'] ?>" method="post">
        <?= csrf_field() ?>

        <!-- Nama Sub Kriteria -->
        <div class="mb-3">
            <label for="nama" class="form-label text-muted small">Nama Sub Kriteria</label>
            <input type="text"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="nama"
                name="nama"
                value="<?= old('nama', esc($subkriteria['nama'])) ?>"
                required>
        </div>

        <!-- Kriteria -->
        <div class="mb-3">
            <label for="kriteria_id" class="form-label text-muted small">Kriteria</label>
            <select
                class="form-select form-select-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="kriteria_id"
                name="kriteria_id"
                required>
                <option disabled>-- Pilih Kriteria --</option>
                <?php foreach ($kriteria as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= (old('kriteria_id', $subkriteria['kriteria_id']) == $k['id']) ? 'selected' : '' ?>>
                        <?= esc($k['nama_kriteria']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary px-4 py-2">Update</button>
    </form>
</div>

<?= $this->endSection() ?>