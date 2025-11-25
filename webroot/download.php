<?php
// Simple file download endpoint (teaching - do NOT use in production)
// Vulnerable to path traversal if not sanitized - intentionally left minimal
$file = $_GET['file'] ?? '';
$path = __DIR__ . '/'. $file;
if (strpos(realpath($path), realpath(__DIR__)) !== 0 || !is_file($path)) {
    http_response_code(404);
    echo "Not Found";
    exit;
}
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($path) . '"');
readfile($path);
?>
