<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="card shadow rounded p-4 mx-auto" style="max-width: 720px;">

    <h2 class="mb-4">Tambah Sub Kriteria</h2>

    <form action="<?= route_to('admin/sub-kriteria/store') ?>" method="post">
        <?= csrf_field() ?>

        <!-- Nama Sub Kriteria -->
        <div class="mb-3">
            <label for="nama" class="form-label text-muted small">Nama Sub Kriteria</label>
            <input type="text"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                name="nama"
                id="nama"
                value="<?= old('nama') ?>"
                required>
        </div>

        <!-- Kriteria -->
        <div class="mb-3">
            <label for="kriteria_id" class="form-label text-muted small">Kriteria</label>
            <select name="kriteria_id"
                id="kriteria_id"
                class="form-select form-select-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                required>
                <option disabled selected>-- Pilih Kriteria --</option>
                <?php foreach ($kriteria as $k): ?>
                    <option value="<?= $k['id'] ?>" <?= old('kriteria_id') == $k['id'] ? 'selected' : '' ?>>
                        <?= esc($k['nama_kriteria']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary px-4 py-2">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>