<!-- app/Views/admin/dashboard.php -->
<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="row mb-5">
    <div class="col-12">
        <div class="card modern-info-card p-4 text-center shadow-sm">
            <h4 class="fw-semibold mb-2 info-title">Admin Panel Management</h4>
            <p class="mb-0 info-text">
                Kelola data perhitungan dan rekomendasi wisata dengan mudah dan efisien melalui panel admin ini.
            </p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card modern-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-wrapper border-primary text-primary">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <div>
                    <h6 class="card-title mb-1">Jumlah Wisata</h6>
                    <p class="card-text mb-0"><?= esc($jumlahWisata) ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card modern-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-wrapper border-success text-success">
                    <i class="bi bi-list-check"></i>
                </div>
                <div>
                    <h6 class="card-title mb-1">Jumlah Kriteria</h6>
                    <p class="card-text mb-0"><?= esc($jumlahKriteria) ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card modern-card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="icon-wrapper border-warning text-warning">
                    <i class="bi bi-filter-circle"></i>
                </div>
                <div>
                    <h6 class="card-title mb-1">Jumlah Sub Kriteria</h6>
                    <p class="card-text mb-0"><?= esc($jumlahSubKriteria) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');

    /* Card info atas */
    .modern-info-card {
        background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
        border-radius: 8px;
        box-shadow: 0 6px 18px rgba(162, 191, 219, 0.4);
        font-weight: 500;
        color: #334155;
        /* warna teks soft dark */
        user-select: none;
        font-family: 'Lora', serif;
        padding: 3rem 2rem;
    }

    .info-title {
        font-weight: 700;
        font-size: 2rem;
        letter-spacing: 0.03em;
        margin-bottom: 0.5rem;
    }

    .info-text {
        font-size: 1.1rem;
        line-height: 1.5;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Card statistik */
    .modern-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
        border: none;
        cursor: default;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        height: 120px;
    }

    .modern-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }

    .card-body {
        padding: 1.4rem 2rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.8rem;
        border: 2.5px solid;
    }

    .border-primary {
        border-color: #3b82f6;
    }

    .border-success {
        border-color: #22c55e;
    }

    .border-warning {
        border-color: #facc15;
    }

    .text-primary {
        color: #3b82f6;
    }

    .text-success {
        color: #22c55e;
    }

    .text-warning {
        color: #facc15;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.05rem;
        color: #374151;
        margin-bottom: 0.2rem;
    }

    .card-text {
        font-weight: 700;
        font-size: 2rem;
        color: #111827;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .icon-wrapper {
            width: 40px;
            height: 40px;
            font-size: 1.4rem;
            border-radius: 10px;
        }

        .card-text {
            font-size: 1.5rem;
        }
    }
</style>

<?= $this->endSection() ?>