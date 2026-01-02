<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    // Correct credentials
    if ($user === 'admin' && $pass === 'admin123') {

        // SUCCESS → redirect to dashboard (no status needed)
        header("Location: /dashboard.php");
        exit;

    } else {

        // FAILURE → redirect back with status flag
        header("Location: /login/?status=invalid");
        exit;
    }
}
?>
<!doctype html>
<html>
<body>

<?php
if (isset($_GET['status']) && $_GET['status'] === 'invalid') {
    echo "<p style='color:red'>Invalid credentials!</p>";
}
?>

<form method="POST" action="/login/">
  <label>User: <input name="user" /></label><br/>
  <label>Pass: <input name="pass" type="password" /></label><br/>
  <button type="submit">Login</button>
</form>

</body>
</html>
