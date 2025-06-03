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

        .range-label {
            display: flex;
            justify-content: space-between;
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

            <!-- Tampilkan pesan error dari server -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= site_url('rekomendasi') ?>" method="post" onsubmit="return validateBobot()">
                <?= csrf_field() ?>

                <div class="row">
                    <!-- Subkriteria Pilihan -->
                    <div class="col-md-6">
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

                    <!-- Bobot Slider -->
                    <div class="col-md-6">
                        <h5>Atur Bobot Kriteria</h5>

                        <?php foreach ($kriteria as $k): ?>
                            <?php if ($k['nama_kriteria'] === 'Jenis Wisata') continue; ?>
                            <div class="mb-4">
                                <label for="slider-<?= $k['id'] ?>"
                                    class="form-label"><?= esc($k['nama_kriteria']) ?></label>
                                <div class="range-label">
                                    <span>0</span>
                                    <span id="value-<?= $k['id'] ?>">0.00</span>
                                    <span>1</span>
                                </div>
                                <input type="range"
                                    class="form-range bobot-slider"
                                    id="slider-<?= $k['id'] ?>"
                                    name="bobot[<?= $k['id'] ?>]"
                                    min="0"
                                    max="1"
                                    step="0.01"
                                    value="0"
                                    oninput="handleSliderChange()" />
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <div id="bobot-warning" class="text-danger mb-2" style="display: none;">Total bobot harus sama dengan 1.</div>
                    <button type="submit" class="btn btn-primary px-5">Cari Rekomendasi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function getTotalBobot(exclude = null) {
            let total = 0;
            document.querySelectorAll('.bobot-slider').forEach(slider => {
                if (slider !== exclude) {
                    total += parseFloat(slider.value);
                }
            });
            return parseFloat(total.toFixed(2));
        }

        function updateSliderValues() {
            document.querySelectorAll('.bobot-slider').forEach(slider => {
                const id = slider.id.split('-')[1];
                document.getElementById(`value-${id}`).innerText = parseFloat(slider.value).toFixed(2);
            });
        }

        function updateSliderStates() {
            const sliders = document.querySelectorAll('.bobot-slider');

            sliders.forEach(slider => {
                slider.disabled = false;

                slider.addEventListener('mousedown', () => {
                    slider.setAttribute('data-start', slider.value);
                });

                slider.addEventListener('input', () => {
                    const current = parseFloat(slider.value);
                    const totalOther = getTotalBobot(slider);
                    const maxAvailable = parseFloat((1 - totalOther).toFixed(2));

                    if (current > maxAvailable) {
                        slider.value = maxAvailable;
                    }

                    // Update label nilai
                    const id = slider.id.split('-')[1];
                    document.getElementById(`value-${id}`).innerText = parseFloat(slider.value).toFixed(2);
                });
            });
        }

        function handleSliderChange() {
            updateSliderValues();
            updateSliderStates();
        }

        function validateBobot() {
            const total = getTotalBobot();
            const warning = document.getElementById('bobot-warning');

            if (Math.abs(total - 1) > 0.01) {
                warning.style.display = 'block';
                return false;
            }

            warning.style.display = 'none';
            return true;
        }

        window.addEventListener('DOMContentLoaded', () => {
            const sliders = document.querySelectorAll('.bobot-slider');

            sliders.forEach(slider => {
                const id = slider.id.split('-')[1];
                document.getElementById(`value-${id}`).innerText = parseFloat(slider.value).toFixed(2);
                slider.addEventListener('input', handleSliderChange);
            });

            updateSliderValues();
            updateSliderStates();
        });
    </script>
</body>

</html>