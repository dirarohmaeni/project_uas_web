<?php
session_start();
require_once 'config/database.php';

// 🔐 CEK LOGIN & ROLE ADMIN
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?url=dashboard");
    exit;
}

// ❌ CEK ID
if (!isset($_GET['id'])) {
    header("Location: index.php?url=barang");
    exit;
}

$id = $_GET['id'];

// KONEKSI DB
$db = (new Database())->connect();

// HAPUS DATA
$stmt = $db->prepare("DELETE FROM barang WHERE id = ?");
$stmt->execute([$id]);

// KEMBALI KE HALAMAN LIST
header("Location: index.php?url=data/barang");
exit;
