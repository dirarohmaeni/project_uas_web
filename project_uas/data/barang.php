<?php
require_once 'config/database.php';
$db = (new Database())->connect();

$limit = 3; // jumlah data per halaman
$page  = $_GET['page'] ?? 1;
$page  = max(1, (int)$page);
$start = ($page - 1) * $limit;

$keyword = $_GET['keyword'] ?? '';

if ($keyword) {
    // Hitung total data hasil search
    $count = $db->prepare("
        SELECT COUNT(*) FROM barang
        WHERE nama LIKE ? OR kategori LIKE ?
    ");
    $count->execute(["%$keyword%", "%$keyword%"]);
    $total_data = $count->fetchColumn();

    // Ambil data
    $stmt = $db->prepare("
        SELECT * FROM barang
        WHERE nama LIKE ? OR kategori LIKE ?
        ORDER BY created_at DESC
        LIMIT $start, $limit
    ");
    $stmt->execute(["%$keyword%", "%$keyword%"]);
    $data = $stmt->fetchAll();
} else {
    // Hitung total data
    $total_data = $db->query("SELECT COUNT(*) FROM barang")->fetchColumn();

    // Ambil data
    $data = $db->query("
        SELECT * FROM barang
        ORDER BY created_at DESC
        LIMIT $start, $limit
    ")->fetchAll();
}

$total_page = ceil($total_data / $limit);
?>

<div class="container mt-5">
    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">🍽️ Data Menu</h4>
            <!-- Form Cari -->
    <form method="get" class="d-flex gap-2 align-items-center">
        <input type="hidden" name="url" value="data/barang">

        <input type="text"
               name="keyword"
               class="form-control"
               placeholder="Cari menu..."
               style="max-width:220px"
               value="<?= htmlspecialchars($keyword ?? '') ?>">

        <button class="btn btn-primary px-4">
            🔍 Cari
        </button>

        <!-- Tombol Tambah (ADMIN ONLY) -->
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="index.php?url=data/add" class="btn btn-tambah-menu">
                + Tambah Menu
            </a>
        <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table produk-table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Tanggal</th>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <th>Aksi</th>
                            <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data) == 0): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Data produk belum tersedia
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php $no=1; foreach ($data as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>

                        <td>
                            <img src="/PROJECT_UAS/images/<?= htmlspecialchars($d['gambar']) ?>"width="60"alt="gambar menu">
                        </td>

                        <td><?= htmlspecialchars($d['nama']) ?></td>

                        <td>
                            <span class="produk-badge"><?= $d['kategori'] ?></span>
                        </td>

                        <td>Rp <?= number_format($d['harga'],0,',','.') ?></td>

                        <td style="max-width:250px">
                            <?= htmlspecialchars($d['deskripsi']) ?>
                        </td>

                        <td><?= date('d M Y', strtotime($d['created_at'])) ?></td>

                        <!-- Aksi (HANYA ADMIN) -->
    <?php if ($_SESSION['role'] === 'admin'): ?>
    <td class="text-center">
        <a href="index.php?url=data/edit&id=<?= $d['id'] ?>"
           class="btn btn-edit">
            Edit
        </a>

        <a href="index.php?url=data/delete&id=<?= $d['id'] ?>"
           onclick="return confirm('Yakin hapus?')"
           class="btn btn-hapus">
            Hapus
        </a>
    </td>
    <?php endif; ?>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- Pagination -->
<nav class="mt-4">
    <ul class="pagination justify-content-center custom-pagination">

        <!-- Prev -->
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link"
                   href="index.php?url=data/barang&page=<?= $page-1 ?>&keyword=<?= $keyword ?>">
                    ‹
                </a>
            </li>
        <?php endif; ?>

        <!-- Number -->
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                <a class="page-link"
                   href="index.php?url=data/barang&page=<?= $i ?>&keyword=<?= $keyword ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <?php if ($page < $total_page): ?>
            <li class="page-item">
                <a class="page-link"
                   href="index.php?url=data/barang&page=<?= $page+1 ?>&keyword=<?= $keyword ?>">
                    ›
                </a>
            </li>
        <?php endif; ?>

    </ul>
</nav>
        </div>

    </div>
</div>
