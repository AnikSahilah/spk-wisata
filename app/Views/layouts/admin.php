<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Panel - Wisata Bondowoso</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        /* Reset & base */
        /* Reset & base */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f9fbff;
            color: #1e293b;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            user-select: none;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #e0ebff;
            box-shadow: 2px 0 8px rgb(100 116 139 / 0.1);
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 0 1.5rem;
            /* hilangkan padding top/bottom supaya header bisa sesuaikan tinggi */
            display: flex;
            flex-direction: column;
            gap: 1rem;
            color: #0f172a;
            z-index: 1000;
            transition: width 0.3s ease;
        }

        /* Sidebar header (judul + icon) */
        .sidebar h2 {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 700;
            font-size: 1.25rem;
            color: #2563eb;
            height: 64px;
            /* samakan tinggi topbar */
            margin: 0;
            padding: 0;
            white-space: nowrap;
            /* supaya tidak pecah baris */
            user-select: none;
        }

        /* Icon di sidebar header */
        .sidebar h2 svg,
        .sidebar h2 i {
            font-size: 1.8rem;
            width: 28px;
            height: 28px;
        }

        /* Sidebar links */
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 0.8rem 1rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            color: #3b82f6;
            border-radius: 8px;
            transition: background-color 0.25s ease, color 0.25s ease;
            user-select: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #3b82f6;
            color: #ffffff;
            box-shadow: 0 4px 8px rgb(59 130 246 / 0.3);
            padding-left: 1.5rem;
        }

        .sidebar a i {
            font-size: 1.3rem;
            transition: color 0.3s ease;
        }

        .sidebar a:hover i,
        .sidebar a.active i {
            color: hsl(220, 14.3%, 95.9%);
        }

        /* Topbar */
        .topbar {
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            height: 64px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgb(100 116 139 / 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 900;
        }

        .topbar h4 {
            font-weight: 600;
            font-size: 1.1rem;
            color: #1e293b;
            user-select: none;
        }

        .topbar .btn {
            font-weight: 600;
            border-radius: 8px;
            font-size: 0.875rem;
            padding: 0.35rem 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-outline-primary {
            color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-outline-primary:hover {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .btn-danger {
            background-color: #ef4444;
            border-color: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            border-color: #dc2626;
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding: 5rem 3rem 3rem 3rem;
            min-height: calc(100vh - 64px);
            background-color: #f9fbff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgb(100 116 139 / 0.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 1.5rem 1rem;
                flex-direction: row;
                overflow-x: auto;
                gap: 0.5rem;
                box-shadow: none;
            }

            .sidebar h2 {
                display: none;
            }

            .sidebar a {
                flex: 1 0 auto;
                font-size: 0.9rem;
                padding: 0.6rem 0.8rem;
                justify-content: center;
                border-radius: 6px;
            }

            .topbar {
                left: 0;
                padding: 0 1rem;
            }

            .main-content {
                margin-left: 0;
                padding: 4rem 1.5rem 2rem;
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <nav class="sidebar" aria-label="Sidebar Navigation">
        <div class="sidebar-header d-flex align-items-center gap-2 mb-4" style="white-space: nowrap;">
            <!-- SVG Gunung Berapi -->
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 64 64" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linejoin="round" class="volcano-icon">
                <path d="M12 48 L32 12 L52 48 Z" fill="#bfdbfe" />
                <path d="M32 12 L28 28 L36 28 L32 12 Z" fill="#3b82f6" />
                <path d="M20 48 L44 48" stroke="#2563eb" stroke-width="3" stroke-linecap="round" />
            </svg>

            <h2 class="sidebar-title m-0" style="white-space: nowrap;">Admin Panel</h2>
        </div>

        <a href="/admin/dashboard" class="<?= uri_string() === 'admin/dashboard' ? 'active' : '' ?>" aria-current="page">
            <i class="bi bi-house-door-fill"></i>
            <span>Dashboard</span>
        </a>
        <a href="/admin/wisata" class="<?= uri_string() === 'admin/wisata' ? 'active' : '' ?>">
            <i class="bi bi-geo-alt-fill"></i>
            <span>Wisata</span>
        </a>
        <a href="/admin/kriteria" class="<?= uri_string() === 'admin/kriteria' ? 'active' : '' ?>">
            <i class="bi bi-list-check"></i>
            <span>Kriteria</span>
        </a>
        <a href="/admin/sub-kriteria" class="<?= uri_string() === 'admin/sub-kriteria' ? 'active' : '' ?>">
            <i class="bi bi-funnel-fill"></i>
            <span>Sub Kriteria</span>
        </a>
        <a href="/admin/nilai-alternatif" class="<?= uri_string() === 'admin/nilai-alternatif' ? 'active' : '' ?>">
            <i class="bi bi-check2-circle"></i>
            <span>Nilai Alternatif</span>
        </a>
    </nav>

    <header class="topbar">
        <h4>Selamat Datang, Admin</h4>
        <div>
            <a href="/admin/profil" class="btn btn-sm btn-outline-primary me-2" role="button">Profil</a>
            <a href="/admin/logout" class="btn btn-sm btn-danger" role="button">Keluar</a>
        </div>
    </header>

    <main class="main-content">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>