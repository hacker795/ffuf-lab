<?php
header("Content-Type: application/json");

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

$response = ["status" => "ok"];

if (isset($data['debug'])) {
    $response["secret"] = "API debug mode enabled";
}

if (isset($data['admin'])) {
    $response["admin"] = "Admin level access granted";
}

echo json_encode($response);
?>

