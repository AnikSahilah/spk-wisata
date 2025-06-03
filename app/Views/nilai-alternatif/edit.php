<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4 text-center font-lora">
    <h2 class="mb-4">Edit Nilai Alternatif</h2>

    <form action="<?= site_url('admin/nilai-alternatif/update/' . $nilai['id']) ?>" method="post"
        class="d-inline-block text-start" style="max-width: 500px; width: 100%;">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="wisata_id" class="form-label">Wisata</label>
            <select name="wisata_id" id="wisata_id" class="form-select" required>
                <option value="">-- Pilih Wisata --</option>
                <?php foreach ($wisata as $w): ?>
                    <option value="<?= $w['id'] ?>" <?= $w['id'] == $nilai['wisata_id'] ? 'selected' : '' ?>>
                        <?= esc($w['nama_wisata']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="sub_kriteria_id" class="form-label">Sub Kriteria</label>
            <select name="sub_kriteria_id" id="sub_kriteria_id" class="form-select" required>
                <option value="">-- Pilih Sub Kriteria --</option>
                <?php foreach ($subkriteria as $sk): ?>
                    <option value="<?= $sk['id'] ?>" <?= $sk['id'] == $nilai['sub_kriteria_id'] ? 'selected' : '' ?>>
                        <?= esc($sk['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" step="0.01" name="nilai" id="nilai" class="form-control" value="<?= esc($nilai['nilai']) ?>" required>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= site_url('admin/nilai-alternatif') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>