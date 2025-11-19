<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://localhost:8000',
    'cookies' => true,
    'allow_redirects' => false,
]);

// Ambil email user terakhir
$pdo = new PDO('mysql:host=127.0.0.1;dbname=edgarage_db', 'root', '');
$stmt = $pdo->query("SELECT email FROM users ORDER BY id DESC LIMIT 1");
$user_email = $stmt->fetchColumn();

echo "Testing login dengan email: $user_email\n";
echo "Password: password123\n\n";

// Step 1: GET home page untuk CSRF
echo "Step 1: Mengambil home page untuk CSRF token...\n";
$response = $client->get('/');
$html = (string) $response->getBody();

preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $html, $matches);
$csrfToken = $matches[1] ?? null;

if (!$csrfToken) {
    echo "❌ CSRF token tidak ditemukan di home!\n";
    exit(1);
}

echo "✓ CSRF token ditemukan\n\n";

// Step 2: POST login
echo "Step 2: Mengirim form login...\n";
$response = $client->post('/login', [
    'form_params' => [
        '_token' => $csrfToken,
        'email' => $user_email,
        'password' => 'password123',
    ]
]);

$statusCode = $response->getStatusCode();
echo "Status Code: " . $statusCode . "\n";

if ($statusCode === 302 || $statusCode === 200) {
    $location = $response->getHeader('Location');
    echo "✓ Login berhasil! Redirect ke: " . ($location[0] ?? 'home') . "\n";
} else {
    echo "❌ Login gagal!\n";
    echo "Response Body: " . substr((string)$response->getBody(), 0, 500) . "\n";
}
