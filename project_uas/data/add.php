<?php
require_once 'config/database.php';
$db = (new Database())->connect();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?url=dashboard");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama      = $_POST['nama'];
    $harga     = $_POST['harga'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if ($gambar != '') {
        move_uploaded_file($tmp, "images/" . $gambar);
    }

    $stmt = $db->prepare("
        INSERT INTO barang (nama, harga, kategori, deskripsi, gambar, created_at)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    $stmt->execute([$nama, $harga, $kategori, $deskripsi, $gambar]);

    header("Location: index.php?url=data/barang");
    exit;
}
?>

<div class="container mt-5">
    <div class="card p-4">

        <h4 class="mb-4">➕ Tambah Menu</h4>

        <form action="index.php?url=data/add" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Dessert">Dessert</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Gambar Menu</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary rounded-pill px-4">Simpan</button>
                <a href="index.php?url=data/barang" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
</div>
