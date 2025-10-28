<?php
// require_once '';
require_once '../classes/Login.php';

$auth = new Login();
$error = "";
// var_dump(base_url);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $login = $auth->login($username, $password);

    if ($login['status'] === 'success') {
        // redirect( base_url . "admin/");
        echo  "<script>location.href = './dashboard'</script>";
    } else {
        $error = $login['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f0f0f0;
      font-family: Arial, sans-serif;
    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 25px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<div class="login-box">
  <h3 class="text-center mb-4">Admin Login</h3>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="POST">
    <div class="mb-3">
      <label>Username</label>
      <input type="text" name="username" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button class="btn btn-primary w-100">Sign In</button>
  </form>
</div>
</body>
</html>