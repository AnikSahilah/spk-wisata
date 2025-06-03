<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="card shadow rounded p-4 mx-auto" style="max-width: 720px;">

    <h2 class="mb-4">Tambah Wisata</h2>

    <form action="/admin/wisata/store" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Nama Wisata -->
        <div class="mb-3">
            <label for="nama_wisata" class="form-label text-muted small">Nama Wisata</label>
            <input type="text"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="nama_wisata"
                name="nama_wisata"
                value="<?= old('nama_wisata') ?>"
                required>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label for="alamat" class="form-label text-muted small">Alamat</label>
            <input type="text"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="alamat"
                name="alamat"
                value="<?= old('alamat') ?>"
                required>
        </div>

        <!-- Gambar Wisata -->
        <div class="mb-3">
            <label for="gambar" class="form-label text-muted small">Gambar Wisata</label>
            <input type="file"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="gambar"
                name="gambar"
                accept="image/*"
                required>
        </div>

        <!-- Sub Kriteria -->
        <div class="mb-3">
            <label for="sub_kriteria_id" class="form-label text-muted small">Sub Kriteria</label>
            <select
                class="form-select form-select-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="sub_kriteria_id"
                name="sub_kriteria_id"
                required>
                <option disabled selected>-- Pilih Sub Kriteria --</option>
                <?php foreach ($subkriteria as $sk): ?>
                    <option value="<?= $sk['id'] ?>" <?= old('sub_kriteria_id') == $sk['id'] ? 'selected' : '' ?>>
                        <?= esc($sk['nama']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary px-4 py-2">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>