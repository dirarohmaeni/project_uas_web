<?php
if (!isset($_SESSION['login'])) {
    header("Location: login");
    exit;
}
?>

<div class="container mt-5">

    <h3 class="mb-4 fw-bold" style="color:#9d174d;">Dashboard D-Restauran</h3>
    <p class="text-muted mb-4">Login sebagai: <strong><?= $_SESSION['role'] ?? 'admin' ?></strong></p>

    <div class="row g-4">

        <!-- Card Menu -->
        <div class="col-md-4">
            <div class="card text-center p-4 h-100">
                <h5 class="mb-2">📋 Menu</h5>
                <p class="text-muted mb-4">
                    Lihat semua menu makanan & minuman
                </p>
                <a href="index.php?url=data/barang" class="btn btn-primary">Lihat Menu</a>
            </div>
        </div>

        <!-- Card Tambah Menu -->
        <?php if ($_SESSION['role'] == 'admin'): ?>
<div class="col-md-4">
    <div class="card text-center p-4 h-100">
        <h5 class="mb-2">➕ Tambah Menu</h5>
        <p class="text-muted mb-4">
            Tambahkan menu baru
        </p>
        <a href="index.php?url=data/barang" class="btn btn-primary">Tambah Menu</a>
    </div>
</div>
<?php endif; ?>

        <!-- Card Logout -->
        <div class="col-md-4">
            <div class="card text-center p-4 h-100">
                <h5 class="mb-2">🚪 Logout</h5>
                <p class="text-muted mb-4">
                    Keluar dari sistem
                </p>
                <a href="logout"
                   onclick="return confirm('Yakin ingin logout?')"
                   class="btn btn-danger rounded-pill">
                    Logout
                </a>
            </div>
        </div>

    </div>
</div>
