<?php

echo "Welcome to FuzzCorp Web Portal";

if (isset($_GET['debug']) && $_GET['debug'] == "1") {
    echo "\nSECRET: Debug mode is ON!\nThis is sensitive data!\n";
}

?>
