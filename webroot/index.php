<?php

echo "Welcome to FuzzCorp Web Portal";

if (isset($_GET['debug']) && $_GET['debug'] == "1") {
    echo "\nSECRET: GET Debug mode is ON!\nSensitive GET data exposed!\n";
}

if (isset($_POST['debug']) && $_POST['debug'] == "1") {
    echo "\nSECRET: POST Debug mode enabled!\nSensitive POST data exposed!\n";
}

if (isset($_SERVER['HTTP_X_DEBUG']) && $_SERVER['HTTP_X_DEBUG'] == "1") {
    echo "\nSECRET: X-Debug header detected!\nSensitive header data exposed!\n";
}

if (isset($_COOKIE['admin']) && $_COOKIE['admin'] === "true") {
    echo "\nSECRET: Admin cookie detected!\nAdmin access granted!\n";
}

if (isset($_SERVER['HTTP_USER_AGENT']) &&
    strpos($_SERVER['HTTP_USER_AGENT'], 'FuzzCorpBot') !== false) {
    echo "\nSECRET: Trusted internal User-Agent detected!\n";
}

?>
