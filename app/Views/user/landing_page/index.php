<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Landing Page Wisata Bondowoso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts (optional) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            /* ruang untuk navbar fixed */
            scroll-behavior: smooth;
            /* native smooth scroll */
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

        /* Tambah hover warna navbar */
        .nav-link:hover {
            color: #ffd700 !important;
        }

        .bg-soft-blue {
            background-color: #e6f2ff;
            /* biru muda halus */
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark"
        style="position: absolute; top: 0; left: 0; right: 0; background-color: rgba(24, 23, 23, 0.4); backdrop-filter: blur(12px); z-index: 10;">

        <div class="container">
            <a class="navbar-brand fw-bold" href="#beranda">WisataBondowoso</a>
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
            <a href="<?= base_url('rekomendasi/filter-form') ?>" class="btn btn-primary btn-lg mt-4 shadow-sm" style="font-weight: 700; background-color: #6c9ef8; border-color: #6c9ef8;">
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
                    <div class="card shadow-sm h-100">
                        <img src="<?= base_url('assets/images/' . $w['gambar']) ?>" class="card-img-top" alt="<?= esc($w['nama_wisata']) ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= esc($w['nama_wisata']) ?></h5>
                            <p class="card-text">
                                <?= esc(strlen($w['alamat']) > 100 ? substr(strip_tags($w['alamat']), 0, 100) . '...' : strip_tags($w['alamat'])) ?>
                            </p>
                            <a href="<?= base_url('wisata/detail/' . $w['id']) ?>" class="btn btn-primary mt-auto btn-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- TENTANG SECTION -->
    <section id="tentang" class="bg-soft-blue py-5">
        <div class="container">
            <h2 class="text-center section-heading">Tentang Wisata Bondowoso</h2>
            <p class="lead text-center mb-4">
                Wisata Bondowoso adalah portal resmi destinasi wisata di Kabupaten Bondowoso. Kami
                menyediakan informasi lengkap mengenai tempat-tempat menarik, budaya, kuliner, dan event lokal.
            </p>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p>
                        Dengan komitmen untuk mempromosikan keindahan alam dan kekayaan budaya Bondowoso, kami
                        berupaya memberikan pengalaman terbaik bagi wisatawan. Jelajahi berbagai destinasi
                        pilihan dan nikmati pesona alam serta keramahan masyarakat setempat.
                    </p>
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