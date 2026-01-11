<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = (new Database())->connect();

    $stmt = $db->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->execute([
        $_POST['username'],
        md5($_POST['password'])
    ]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        $_SESSION['login'] = true;
        $_SESSION['role']  = $user['role'];
        header("Location: dashboard");
    } else {
        $error = "Login gagal!";
    }
}
?>

<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-4">
<div class="card p-4">
<h4 class="text-center mb-3">Login</h4>

<?php if(isset($error)): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
    <button class="btn btn-primary w-100">Login</button>
</form>
</div>
</div>
</div>
</div>
