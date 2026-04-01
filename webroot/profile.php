<?php

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    if($id === "admin" && isset($_GET['secret'])) {
        echo "FLAG{full_access_granted}";
    }
    elseif($id === "admin") {
        echo "Access Denied - Missing Something";
    }
    elseif($id === "backup") {
        echo "Backup Access Found";
    }
    elseif($id === "debug") {
        echo "Debug Mode Enabled";
    }
    elseif(is_numeric($id)) {
        echo "User Profile ID: " . $id;
    }
    else {
        echo "Invalid User - try harder";
    }

} elseif(isset($_GET['secret'])) {

    echo "Hidden Feature Activated!";

} else {

    echo "User endpoint loaded. Try accessing with valid parameters.";
}

?>
