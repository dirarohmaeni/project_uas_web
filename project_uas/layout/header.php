<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>D-Restaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/PROJECT_UAS/assets/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-gradient shadow-sm">
    <div class="container">
        <!-- Logo / Brand -->
        <a class="navbar-brand fw-bold" href="dashboard">
            🍽️ D-Restaurant
        </a>

        <!-- Toggle Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                <li class="nav-item">
                    <a href="index.php?url=dashboard" class="nav-link">Dashboard</a>
                </li>

                <li class="nav-item">
                    <a href="index.php?url=data/barang" class="nav-link">Menu</a>
                </li>

                <li class="nav-item ms-lg-3">
                    <a href="index.php?url=logout" class="btn btn-light">Logout</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
