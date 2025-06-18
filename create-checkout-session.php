<?php
require 'vendor/autoload.php'; // if using Composer

\Stripe\Stripe::setApiKey('sk_test_YourSecretKey'); // Replace with your secret key

header('Content-Type: application/json');

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Library Membership Fee',
                ],
                'unit_amount' => 5000, // $50.00
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/success.html',
        'cancel_url' => 'http://localhost/cancel.html',
    ]);

    echo json_encode(['id' => $session->id]);
} catch (Error $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>