<?php
require_once 'config/database.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?url=dashboard");
    exit;
}

$db = (new Database())->connect();


$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php?url=barang");
    exit;
}

$data = $db->prepare("SELECT * FROM barang WHERE id=?");
$data->execute([$id]);
$menu = $data->fetch();

if (!$menu) {
    header("Location: barang");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama      = $_POST['nama'];
    $harga     = $_POST['harga'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    // Upload gambar baru (opsional)
    $gambar = $menu['gambar'];
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "images/" . $gambar);
    }

    $stmt = $db->prepare("
        UPDATE barang
        SET nama=?, harga=?, kategori=?, deskripsi=?, gambar=?
        WHERE id=?
    ");
    $stmt->execute([$nama, $harga, $kategori, $deskripsi, $gambar, $id]);

    header("Location: index.php?url=data/barang");
exit;
}
?>

<div class="container mt-5">
    <div class="card p-4">

        <h4 class="mb-4">✏️ Edit Menu</h4>

        <form method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input type="text" name="nama" class="form-control"
                       value="<?= htmlspecialchars($menu['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control"
                       value="<?= $menu['harga'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="Makanan" <?= $menu['kategori']=='Makanan'?'selected':'' ?>>
                        Makanan
                    </option>
                    <option value="Minuman" <?= $menu['kategori']=='Minuman'?'selected':'' ?>>
                        Minuman
                    </option>
                    <option value="Dessert" <?= $menu['kategori']=='Minuman'?'selected':'' ?>>
                        Dessert
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($menu['deskripsi']) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Menu</label><br>
                <img src="images/img/<?= htmlspecialchars($menu['gambar']) ?>" width="100">
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary rounded-pill px-4">Update</button>
                <a href="index.php?url=data/barang" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
</div>
