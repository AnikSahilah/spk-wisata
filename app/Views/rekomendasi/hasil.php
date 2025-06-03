<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Hasil Rekomendasi Wisata</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@600&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            position: relative;
            font-family: 'Open Sans', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 40px 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
            /* Hapus background gradient lama */
            background: transparent;
        }

        /* Background warna glow blur */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 15% 30%, rgba(255, 0, 128, 0.07), transparent 40%),
                radial-gradient(circle at 40% 60%, rgba(255, 255, 0, 0.05), transparent 40%),
                radial-gradient(circle at 70% 30%, rgba(0, 255, 255, 0.05), transparent 50%),
                radial-gradient(circle at 85% 70%, rgba(128, 0, 255, 0.07), transparent 40%),
                linear-gradient(135deg,
                    rgba(0, 0, 0, 0.25),
                    rgba(0, 0, 0, 0.15),
                    rgba(0, 0, 0, 0.25));
            filter: blur(100px);
            z-index: -2;
            transform: scale(1.15);
            animation: shimmerGlow 25s ease-in-out infinite;
        }

        /* Background embun */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: -1;
            background:
                radial-gradient(circle, rgba(200, 220, 255, 0.2) 2px, transparent 3.5px),
                radial-gradient(circle, rgba(220, 235, 255, 0.15) 1.3px, transparent 2.8px);
            background-size: 40px 40px, 20px 20px;
            filter: blur(4px);
            animation: gentleMove 60s linear infinite;
            opacity: 0.45;
        }

        /* Animasi shimmer glow (sama seperti sebelumnya) */
        @keyframes shimmerGlow {

            0%,
            100% {
                filter: blur(100px) brightness(1);
                transform: scale(1.15) translateX(0);
            }

            50% {
                filter: blur(90px) brightness(1.1);
                transform: scale(1.2) translateX(20px);
            }
        }

        /* Animasi gerak pelan embun */
        @keyframes gentleMove {
            0% {
                background-position: 0 0, 0 0;
            }

            100% {
                background-position: 40px 40px, 20px 20px;
            }
        }

        /* Container tetap putih agar isi terbaca */
        .container {
            max-width: 960px;
            margin: auto;
            background: white;
            padding: 40px 50px;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1.9rem;
            text-align: center;
            color: #4f46e5;
            margin-bottom: 40px;
        }

        .card {
            border-radius: 16px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.1);
            display: flex;
            flex-direction: column;
            height: 400px;
            /* fixed height */
            overflow: hidden;
            /* cegah isi keluar */
            width: 100%;
            /* supaya full dalam kolom */
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
            border-radius: 16px 16px 0 0;
            flex-shrink: 0;
            /* supaya gambar gak mengecil */
        }

        .card-body {
            flex: 1 1 auto;
            padding: 20px 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* tombol di bawah */
            overflow: hidden;
            /* cegah isi keluar */
        }

        /* Judul supaya tidak pecah, max 1 baris */
        .card-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #4f46e5;
            font-size: 1.3rem;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Alamat dibatasi tinggi maksimum 3 baris dan dipotong jika lebih */
        .card-address {
            font-size: 0.95rem;
            color: #6b7280;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* batasi 3 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            flex-grow: 0;
        }

        /* Skor diberi margin bawah dan fixed height agar konsisten */
        .score {
            font-weight: 700;
            font-size: 1.1rem;
            color: #374151;
            margin-bottom: 16px;
            flex-shrink: 0;
            white-space: nowrap;
        }

        /* Tombol Detail selalu di bawah */
        .btn-detail {
            background: linear-gradient(45deg, #4f46e5, #6366f1);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 24px;
            color: white;
            transition: background 0.3s ease, transform 0.15s ease;
            box-shadow: 0 6px 12px rgba(99, 102, 241, 0.4);
            text-align: center;
            text-decoration: none;
            flex-shrink: 0;
        }

        .btn-detail:hover,
        .btn-detail:focus {
            background: linear-gradient(45deg, #3730a3, #4f46e5);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.5);
            outline: none;
            color: white;
        }

        .alert-warning {
            background-color: #fef3c7;
            border-radius: 12px;
            font-weight: 600;
            color: #92400e;
            margin-top: 30px;
            padding: 20px 25px;
            text-align: center;
            font-size: 1.05rem;
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.25);
        }

        .btn-back {
            display: inline-block;
            margin-top: 40px;
            text-decoration: none;
            padding: 12px 36px;
            background: linear-gradient(45deg, #4f46e5, #6366f1);
            color: white;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(99, 102, 241, 0.4);
            text-align: center;
        }

        .btn-back:hover {
            background: linear-gradient(45deg, #3730a3, #4f46e5);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.5);
            transform: translateY(-2px);
        }

        @media (max-width: 576px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Hasil Rekomendasi Wisata</h2>

        <?php if (!empty($result)): ?>
            <div class="row g-4">
                <?php foreach ($result as $row): ?>
                    <div class="col-12 col-md-6 col-lg-4 d-flex">
                        <div class="card">
                            <?php if (!empty($row['wisata']['gambar'])): ?>
                                <img src="<?= esc('assets/images/' . $row['wisata']['gambar']) ?>" alt="<?= esc($row['wisata']['nama_wisata']) ?>" class="card-img-top" />
                            <?php else: ?>
                                <img src="https://via.placeholder.com/400x180?text=No+Image" alt="No Image" class="card-img-top" />
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= esc($row['wisata']['nama_wisata']) ?></h5>
                                <p class="card-address"><?= esc($row['wisata']['alamat']) ?></p>
                                <p class="score">Skor SAW: <strong><?= number_format($row['score'], 4) ?></strong></p>
                                <a href="<?= site_url('wisata/detail/' . $row['wisata']['id']) ?>" class="btn-detail mt-auto">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                Tidak ada wisata yang cocok dengan filter yang dipilih.
            </div>
        <?php endif; ?>

        <div class="text-center">
            <a href="<?= site_url('rekomendasi/filter-form') ?>" class="btn-back">Kembali ke Filter</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>