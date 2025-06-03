<div class="card shadow rounded p-4 mx-auto" style="max-width: 720px;">

    <form action="<?= isset($action) ? $action : '/admin/kriteria/store' ?>" method="post">
        <?= csrf_field() ?>

        <!-- Nama Kriteria -->
        <div class="mb-3">
            <label for="nama_kriteria" class="form-label text-muted small">Nama Kriteria</label>
            <input type="text"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                name="nama_kriteria"
                id="nama_kriteria"
                value="<?= isset($kriteria) ? esc($kriteria['nama_kriteria']) : '' ?>"
                required>
        </div>

        <!-- Tipe -->
        <div class="mb-3">
            <label for="type" class="form-label text-muted small">Tipe</label>
            <select name="type"
                id="type"
                class="form-select form-select-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                required>
                <option disabled <?= !isset($kriteria) ? 'selected' : '' ?>>-- Pilih Tipe --</option>
                <option value="benefit" <?= isset($kriteria) && $kriteria['type'] == 'benefit' ? 'selected' : '' ?>>Benefit</option>
                <option value="cost" <?= isset($kriteria) && $kriteria['type'] == 'cost' ? 'selected' : '' ?>>Cost</option>
            </select>
        </div>
    </form>
</div>