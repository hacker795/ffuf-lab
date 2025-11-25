<?php
echo "Debug API Endpoint\n";

if(isset($_GET['test'])){
    echo "You sent test=" . $_GET['test'];
}
?>
