<?php
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

if ($username === "admin" && $password === "secret") {
    echo "Login Successful!";
} else {
    echo "Invalid Login!";
}
?>
