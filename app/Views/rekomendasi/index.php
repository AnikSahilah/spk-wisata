<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Filter Rekomendasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background: #e0e7ff;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-section {
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="py-5">
    <div class="container">
        <div class="mb-4">
            <a href="<?= site_url('/') ?>" class="btn btn-outline-primary">&larr; Kembali ke Landing</a>
        </div>

        <div class="form-section">
            <h2 class="mb-4 text-center">Filter Rekomendasi Wisata</h2>

            <!-- Tampilkan pesan error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= site_url('rekomendasi') ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-12">
                        <h5>Filter Berdasarkan Sub-Kriteria</h5>

                        <?php foreach ($subKriteria as $namaKriteria => $items): ?>
                            <div class="mb-4">
                                <label class="form-label"><?= esc($namaKriteria) ?></label>

                                <?php if (in_array($namaKriteria, ['Fasilitas', 'Akses'])): ?>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach ($items as $item): ?>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="checkbox"
                                                    name="sub_kriteria[<?= esc($namaKriteria) ?>][]"
                                                    id="<?= esc($namaKriteria) . '_' . $item['id'] ?>"
                                                    value="<?= $item['id'] ?>">
                                                <label class="form-check-label"
                                                    for="<?= esc($namaKriteria) . '_' . $item['id'] ?>">
                                                    <?= esc($item['nama']) ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <select name="sub_kriteria[<?= esc($namaKriteria) ?>]" class="form-select">
                                        <option value="">Pilih <?= esc($namaKriteria) ?></option>
                                        <?php foreach ($items as $item): ?>
                                            <option value="<?= $item['id'] ?>"><?= esc($item['nama']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5">Cari Rekomendasi</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>