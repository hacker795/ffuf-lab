<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin123') {
        echo "SUCCESS_LOGIN";
    } else {
        echo "FAIL_LOGIN";
    }

    exit;
}
?>

<!doctype html>
<html>
<body>

<h2>Login Panel</h2>

<form method="POST" action="/login/">
  <label>Username: <input name="username" /></label><br/>
  <label>Password: <input name="password" type="password" /></label><br/>
  <button type="submit">Login</button>
</form>

</body>
</html>
