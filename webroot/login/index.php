<?php
// Simple, intentionally insecure login for learning
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    if ($user === 'admin' && $pass === 'admin123') {
        echo "Welcome Admin";
    } else {
        echo "Invalid credentials!";
    }
    exit;
}
?>
<!doctype html>
<html><body>
<form method="POST">
  <label>User: <input name="user" /></label><br/>
  <label>Pass: <input name="pass" type="password" /></label><br/>
  <button>Login</button>
</form>
</body></html>
