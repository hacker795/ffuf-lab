<?php
// Internal API - returns an example secret (teaching purpose)
echo json_encode([
    "service" => "internal",
    "status" => "ok",
    "note" => "This is an internal API, do not expose"
]);
?>
