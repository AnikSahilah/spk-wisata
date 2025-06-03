<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<style>
    .container {
        max-width: 960px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .card-custom {
        background: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
        padding: 2rem;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 0.5rem;
    }

    .card-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }

    .btn-add {
        background-color: #1e3a8a;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-add:hover {
        background-color: #163570;
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    thead {
        background-color: #f8fafc;
    }

    th,
    td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
        text-align: left;
    }

    th {
        font-weight: 600;
        color: #475569;
    }

    td {
        color: #334155;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f5f9;
    }

    .action-icons {
        display: flex;
        gap: 0.5rem;
    }

    .action-icons a,
    .action-icons button {
        color: #1e3a8a;
        background: none;
        border: none;
        font-size: 1.1rem;
        padding: 0;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .action-icons a:hover,
    .action-icons button:hover {
        color: #0f172a;
    }

    .text-muted {
        color: #94a3b8;
        font-style: italic;
    }

    .alert {
        margin-top: 1rem;
    }

    img.thumbnail {
        max-width: 100px;
        border-radius: 0.25rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 576px) {
        .card-custom {
            padding: 1rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
            width: 100%;
        }

        thead {
            display: none;
        }

        tbody tr {
            margin-bottom: 1rem;
            background: #f8fafc;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        td {
            position: relative;
            padding-left: 50%;
            text-align: left;
        }

        td::before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            top: 0.75rem;
            font-weight: 600;
            color: #2563eb;
        }

        .action-icons {
            justify-content: flex-end;
        }
    }
</style>

<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="card-custom">
        <div class="card-header">
            <h2>Data Wisata</h2>
            <a href="/admin/wisata/create" class="btn-add">
                <i class="bi bi-plus-lg"></i> Tambah Wisata
            </a>
        </div>

        <table class="table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Wisata</th>
                    <th>Alamat</th>
                    <th>Gambar</th>
                    <th>Sub Kriteria</th>
                    <th style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($wisata)): ?>
                    <?php $i = 1;
                    foreach ($wisata as $w): ?>
                        <tr>
                            <td data-label="#"> <?= $i++ ?> </td>
                            <td data-label="Nama Wisata"><?= esc($w['nama_wisata']) ?></td>
                            <td data-label="Alamat"><?= esc($w['alamat']) ?></td>
                            <td data-label="Gambar">
                                <?php if (!empty($w['gambar'])): ?>
                                    <img src="/assets/images/<?= esc($w['gambar']) ?>" alt="<?= esc($w['nama_wisata']) ?>" class="thumbnail" />
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Sub Kriteria"><?= esc($w['sub_kriteria_nama']) ?></td>
                            <td data-label="Aksi">
                                <div class="action-icons">
                                    <a href="/admin/wisata/edit/<?= $w['id'] ?>" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="/admin/wisata/delete/<?= $w['id'] ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data wisata.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>