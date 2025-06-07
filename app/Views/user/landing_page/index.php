<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Landing Page Wisata Bondowoso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts (optional) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            scroll-behavior: smooth;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
        }

        .transition {
            transition: all 0.3s ease-in-out;
        }

        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url("<?= base_url('assets/images/background.jpg') ?>") center/cover no-repeat;
            height: 70vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        footer {
            background-color: #f8f9fa;
            padding: 1.5rem 0;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
        }

        .btn-detail {
            margin-top: 10px;
        }

        .section-heading {
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 2rem;
        }

        .nav-link:hover {
            color: #ffd700 !important;
        }

        .bg-soft-blue {
            background-color: #e6f2ff;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .text-justify {
            text-align: justify;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"
        style="background-color: rgba(24, 23, 23, 0.8); backdrop-filter: blur(12px); z-index: 1030;">
        <div class="container">
            <a class="navbar-brand" href="#beranda">
                <img src="assets/images/logo.png" alt="Logo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinasi">Destinasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                </ul>
                <a href="<?= base_url('login') ?>" class="btn btn-outline-light">Login</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (Beranda) -->
    <section id="beranda" class="hero">
        <div class="container">
            <h1 class="display-4">Selamat Datang di Wisata Bondowoso</h1>
            <p class="lead">Jelajahi keindahan dan keunikan destinasi wisata lokal</p>
            <a href="<?= base_url('rekomendasi/filter-form') ?>" class="btn btn-primary btn-lg mt-4 shadow-sm"
                style="font-weight: 700; background-color: #6c9ef8; border-color: #6c9ef8;">
                Lihat Rekomendasi
            </a>
        </div>
    </section>

    <!-- DESTINASI SECTION -->
    <section id="destinasi" class="container py-5">
        <h2 class="text-center section-heading">Destinasi Populer</h2>
        <div class="row">
            <?php foreach ($wisata as $w): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded-2 overflow-hidden card-hover bg-light">
                        <div class="position-relative">
                            <img src="<?= base_url('assets/images/' . $w['gambar']) ?>" class="card-img-top" alt="<?= esc($w['nama_wisata']) ?>" style="height: 220px; object-fit: cover;">
                            <span class="position-absolute top-0 end-0 m-2 badge bg-primary px-3 py-2 rounded-pill d-flex align-items-center gap-1" style="font-size: 0.85rem;">
                                💰 Rp <?= number_format($w['harga_tiket'], 0, ',', '.') ?>
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold text-dark text-center"><?= esc($w['nama_wisata']) ?></h5>
                            <p class="card-text text-muted flex-grow-1 text-justify" style="font-size: 0.93rem;">
                                <?= esc(strlen($w['deskripsi']) > 100 ? substr(strip_tags($w['deskripsi']), 0, 100) . '...' : strip_tags($w['deskripsi'])) ?>
                            </p>
                            <a href="<?= base_url('wisata/' . $w['id']) ?>" class="btn btn-outline-primary btn-sm mt-auto rounded-pill">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- TENTANG SECTION -->
    <section id="tentang" class="bg-soft-blue py-5">
        <div class="container">
            <h2 class="text-center section-heading mb-5">Tentang Wisata Bondowoso</h2>
            <div class="card shadow-sm border-0">
                <div class="row g-0">
                    <!-- Bagian Kiri: Deskripsi -->
                    <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                        <h4 class="fw-bold mb-3">Mengenal Lebih Dekat</h4>
                        <p class="mb-3 text-justify">
                            Wisata Bondowoso adalah portal resmi destinasi wisata di Kabupaten Bondowoso. Kami
                            menyediakan informasi lengkap mengenai tempat-tempat menarik, budaya, kuliner, dan event lokal.
                        </p>
                        <p class="text-justify">
                            Dengan komitmen untuk mempromosikan keindahan alam dan kekayaan budaya Bondowoso, kami
                            berupaya memberikan pengalaman terbaik bagi wisatawan. Jelajahi berbagai destinasi
                            pilihan dan nikmati pesona alam serta keramahan masyarakat setempat.
                        </p>
                    </div>

                    <!-- Bagian Kanan: Gambar -->
                    <div class="col-md-6">
                        <img src="<?= base_url('assets/images/tentang.jpg') ?>" alt="Tentang Wisata Bondowoso"
                            class="img-fluid rounded-end h-100 w-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> Wisata Bondowoso. Semua hak dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>