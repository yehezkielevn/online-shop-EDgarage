<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://localhost:8000',
    'cookies' => true,
    'allow_redirects' => false,
]);

// Step 1: GET /register untuk dapat CSRF token
echo "Step 1: Mengambil register page untuk CSRF token...\n";
$response = $client->get('/register');
$html = (string) $response->getBody();

// Extract CSRF token
preg_match('/<input type="hidden" name="csrf_token" value="([^"]+)"/', $html, $matches);
if (empty($matches[1])) {
    preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $html, $matches);
}

$csrfToken = $matches[1] ?? null;

if (!$csrfToken) {
    echo "❌ CSRF token tidak ditemukan!\n";
    exit(1);
}

echo "✓ CSRF token: " . substr($csrfToken, 0, 20) . "...\n\n";

// Step 2: POST /register dengan form data
echo "Step 2: Mengirim form registrasi...\n";
$response = $client->post('/register', [
    'form_params' => [
        '_token' => $csrfToken,
        'name' => 'Test User ' . time(),
        'email' => 'testuser' . time() . '@example.com',
        'nomor_hp' => '081234567890',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]
]);

$statusCode = $response->getStatusCode();
echo "Status Code: " . $statusCode . "\n";

if ($statusCode === 302 || $statusCode === 201 || $statusCode === 200) {
    echo "✓ Registrasi berhasil!\n";
    $location = $response->getHeader('Location');
    echo "Redirect ke: " . ($location[0] ?? 'N/A') . "\n";
} else {
    echo "❌ Registrasi gagal!\n";
    echo "Response: " . substr((string)$response->getBody(), 0, 500) . "...\n";
}
