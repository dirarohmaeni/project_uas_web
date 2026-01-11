<?php
require_once 'layout/header.php';

$url = $_GET['url'] ?? 'login';

switch ($url) {
    case 'login':
        include 'modules/auth/login.php';
        break;
    case 'logout':
        include 'modules/auth/logout.php';
        break;
    case 'dashboard':
        include 'dashboard.php';
        break;
    case 'data/barang':
        include 'data/barang.php';
        break;
    case 'data/add':
        include 'data/add.php';
        break;
    case 'data/edit':
        include 'data/edit.php';
        break;
    case 'data/delete':
        include 'data/delete.php';
        break;
    default:
        echo "<h3 class='text-center mt-5'>404 - Halaman Tidak Ditemukan</h3>";
}

require_once 'layout/footer.php';
