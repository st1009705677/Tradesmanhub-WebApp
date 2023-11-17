<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey("sk_test_YOUR_SECRET_KEY");

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:4242';

$checkout_session = \Stripe\Checkout\Session::create([
 'payment_method_types' => ['card'],
 'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'unit_amount' => 1000,
      'product_data' => [
        'name' => 'Product Name',
        'images' => ["https://i.imgur.com/EHyR2nP.