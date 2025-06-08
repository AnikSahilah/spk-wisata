<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="card shadow rounded p-4 mx-auto" style="max-width: 720px;">

    <h2 class="mb-4">Edit Wisata</h2>

    <form action="/admin/wisata/update/<?= esc($wisata['id']) ?>" method="post" enctype="multipart/form-data">
        <?php if (session('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <?= csrf_field() ?>

        <!-- Nama Wisata -->
        <div class="mb-3">
            <label for="nama_wisata" class="form-label text-muted small">Nama Wisata</label>
            <input type="text"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="nama_wisata"
                name="nama_wisata"
                value="<?= old('nama_wisata', esc($wisata['nama_wisata'])) ?>"
                required>
        </div>

        <!-- Alamat -->
        <div class="mb-3">
            <label for="alamat" class="form-label text-muted small">Alamat</label>
            <input type="text"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="alamat"
                name="alamat"
                value="<?= old('alamat', esc($wisata['alamat'])) ?>"
                required>
        </div>

        <!-- Gambar Wisata -->
        <div class="mb-3">
            <label for="gambar" class="form-label text-muted small">Gambar Wisata</label><br>
            <img src="/assets/images/<?= esc($wisata['gambar']) ?>" alt="Gambar Saat Ini" width="100" class="mb-2 rounded shadow-sm"><br>
            <input type="file"
                class="form-control form-control-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="gambar"
                name="gambar"
                accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>

        <!-- Sub Kriteria -->
        <div class="mb-3">
            <label for="sub_kriteria_id" class="form-label text-muted small">Sub Kriteria</label>
            <select
                class="form-select form-select-sm border border-secondary-subtle px-3 py-2 shadow-sm"
                id="sub_kriteria_id"
                name="sub_kriteria_id"
                required>
                <option disabled>-- Pilih Sub Kriteria --</option>
                <?php foreach ($subkriteria as $sk): ?>
                    <option value="<?= $sk['id'] ?>" <?= (old('sub_kriteria_id', $wisata['sub_kriteria_id']) == $sk['id']) ? 'selected' : '' ?>>
                        <?= esc($sk['nama']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary px-4 py-2">Perbarui</button>
    </form>
</div>

<?= $this->endSection() ?>