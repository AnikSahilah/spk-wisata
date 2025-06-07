<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Detail Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        /* Styles yang sudah ada... */
        .container {
            max-width: 1200px;
            padding-left: 15px;
            padding-right: 15px;
            margin: auto;
        }

        .card-uniform {
            width: 100%;
            margin-bottom: 2rem;
            box-sizing: border-box;
        }

        .detail-wisata-img {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            padding: 15px;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
            height: 100%;
        }

        .detail-wisata-img img {
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
            border-radius: 0.5rem;
        }

        .detail-wisata-title {
            color: black !important;
            font-weight: 700;
        }

        .fasilitas-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding-left: 0;
            list-style: none;
            margin: 0;
        }

        .fasilitas-list li {
            background-color: rgb(58, 175, 248);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .rating-highlight {
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            padding: 15px;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
            margin-top: 1rem;
        }

        .star-label {
            cursor: pointer;
            color: gray;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .star-label.selected,
        .star-label.hovered {
            color: gold;
            transform: scale(1.3);
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">

        <!-- Tombol kembali dengan icon -->
        <div style="margin-bottom:1.5rem; text-align:center;">
            <a href="<?= site_url('/') ?>" title="Kembali" aria-label="Kembali" style="font-size:1.5rem; color:#0d6efd; text-decoration:none;">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </a>
        </div>

        <!-- DETAIL WISATA -->
        <div class="card shadow-sm rounded card-uniform">
            <div class="row g-0 align-items-stretch">
                <div class="col-md-6">
                    <div class="h-100 w-100 overflow-hidden">
                        <img src="<?= base_url('assets/images/' . $wisata['gambar']) ?>"
                            alt="<?= esc($wisata['nama_wisata']) ?>"
                            class="img-fluid h-100 w-100"
                            style="object-fit: cover; border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem;" />
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-between p-4">
                    <h2 class="card-title detail-wisata-title mb-4"><?= esc($wisata['nama_wisata']) ?></h2>
                    <p class="lead text-secondary mb-4"><?= esc($wisata['deskripsi']) ?></p>

                    <div class="row g-3 mb-3">
                        <div class="col-12 d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill text-primary me-2 fs-5"></i>
                            <div>
                                <strong>Alamat:</strong><br />
                                <a href="<?= esc($wisata['alamat']) ?>" target="_blank" class="text-decoration-none">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i> Lihat di Google Maps
                                </a>
                            </div>
                        </div>
                        <div class="col-12 d-flex align-items-start">
                            <i class="bi bi-tags-fill text-success me-2 fs-5"></i>
                            <div><strong>Jenis Wisata:</strong><br /><?= isset($jenisWisata) ? esc($jenisWisata['nama']) : '-' ?></div>
                        </div>
                        <div class="col-12 d-flex align-items-start">
                            <i class="bi bi-cash-coin text-warning me-2 fs-5"></i>
                            <div><strong>Harga Tiket:</strong><br /><?= esc($wisata['harga_tiket']) ?></div>
                        </div>
                        <div class="col-12 d-flex align-items-start">
                            <i class="bi bi-bus-front-fill text-info me-2 fs-5"></i>
                            <div><strong>Akses:</strong><br /><?= esc($wisata['akses']) ?></div>
                        </div>
                        <div class="col-12 d-flex align-items-start">
                            <i class="bi bi-clock-fill text-danger me-2 fs-5"></i>
                            <div><strong>Jam Operasional:</strong><br /><?= esc($wisata['jam_operasional']) ?></div>
                        </div>
                        <div class="col-12 d-flex align-items-start">
                            <i class="bi bi-tools text-secondary me-2 fs-5"></i>
                            <div>
                                <strong>Fasilitas:</strong><br />
                                <?php if (!empty($wisata['fasilitas'])): ?>
                                    <ul class="fasilitas-list">
                                        <?php foreach (explode(',', $wisata['fasilitas']) as $f): ?>
                                            <li><?= esc(trim($f)) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <span class="text-muted">Tidak tersedia</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="rating-highlight">
                        <h5 class="mb-1">Rating Wisata:</h5>
                        <span class="fs-4 text-warning"><?= $rating ? str_repeat('⭐', round($rating->avg_rating)) : '⭐⭐⭐⭐⭐' ?></span>
                        <span class="ms-2">(<?= $rating ? round($rating->avg_rating, 1) : '0.0' ?> dari <?= $rating ? $rating->total_ulasan : '0' ?> ulasan)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM ULASAN -->
        <div id="form-ulasan" class="card shadow-sm card-uniform">
            <div class="card-body">
                <h4 class="card-title mb-3">Tinggalkan Ulasan Anda</h4>

                <!-- Flash Message: Sukses -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                <?php endif; ?>

                <!-- Flash Message: Error -->
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('ulasan/simpan') ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="wisata_id" value="<?= $wisata['id'] ?>" />

                    <div class="mb-3">
                        <label class="form-label d-block">Rating Anda:</label>
                        <div id="rating-stars" class="d-flex gap-2 fs-2">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>" class="d-none"
                                    <?= old('rating') == $i ? 'checked' : '' ?> required />
                                <label for="star<?= $i ?>" class="star-label <?= old('rating') >= $i ? 'selected' : '' ?>" data-star="<?= $i ?>">⭐</label>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Komentar:</label>
                        <textarea name="komentar" class="form-control shadow-sm" rows="3"
                            placeholder="Bagikan pengalaman Anda..." required><?= old('komentar') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary px-4">Kirim Ulasan</button>
                </form>
            </div>
        </div>

        <!-- ULASAN PENGUNJUNG -->
        <div class="card shadow-sm card-uniform">
            <div class="card-body">
                <h4 class="card-title mb-4">Ulasan Pengunjung</h4>
                <?php if (count($ulasan) > 0): ?>
                    <?php foreach ($ulasan as $u): ?>
                        <div class="border-start border-4 border-primary bg-white p-3 mb-3 shadow-sm rounded">
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-warning"><?= str_repeat('⭐', $u['rating']) ?></strong></div>
                                <small class="text-muted"><?= date('d M Y, H:i', strtotime($u['created_at'])) ?></small>
                            </div>
                            <p class="mt-2 mb-1"><?= esc($u['komentar']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted fst-italic">Belum ada ulasan. Jadilah yang pertama!</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const labels = document.querySelectorAll('.star-label');
            let selectedRating = parseInt(document.querySelector('input[name="rating"]:checked')?.value) || 0;

            labels.forEach(label => {
                const starValue = parseInt(label.dataset.star);

                label.addEventListener('click', () => {
                    selectedRating = starValue;
                    updateStars();
                });

                label.addEventListener('mouseover', () => updateStars(starValue));
                label.addEventListener('mouseout', () => updateStars());

                if (selectedRating && starValue <= selectedRating) {
                    label.classList.add('selected');
                }
            });

            function updateStars(hover = 0) {
                labels.forEach(label => {
                    const star = parseInt(label.dataset.star);
                    label.classList.remove('selected', 'hovered');
                    if (hover) {
                        if (star <= hover) label.classList.add('hovered');
                    } else {
                        if (star <= selectedRating) label.classList.add('selected');
                    }
                });
            }

            // Auto-scroll ke form jika ada flashdata
            <?php if (session()->getFlashdata('success') || session()->getFlashdata('errors')): ?>
                const formUlasan = document.getElementById('form-ulasan');
                if (formUlasan) {
                    formUlasan.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            <?php endif; ?>

            // Alert hilang otomatis
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(el => el.classList.remove('show'));
            }, 5000);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>