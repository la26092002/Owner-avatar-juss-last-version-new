<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session to access cart data
session_start();

require __DIR__ . '/vendor/autoload.php';

$stripe_secret_key = "sk_test_51RMg4JQlIxdNlh3Cri080iJtqtv0dklLQX9cNCsMd95exhsSr3Tjm4sCVyYjm03x9bwBqO1EHgsn7SgydISxuwfa00xZyFhmge";

if (!$stripe_secret_key) {
    die("Stripe secret key is missing.");
}

\Stripe\Stripe::setApiKey($stripe_secret_key);

// Prepare line items from cart session
$line_items = [];

if(isset($_SESSION['cart_p_id'])) {
    // Get all cart arrays
    $cart_p_id = $_SESSION['cart_p_id'];
    $cart_p_name = $_SESSION['cart_p_name'];
    $cart_p_current_price = $_SESSION['cart_p_current_price'];
    $cart_p_qty = $_SESSION['cart_p_qty'];
    $cart_color_name = $_SESSION['cart_color_name'] ?? array_fill(0, count($cart_p_id), '');
    $cart_size_name = $_SESSION['cart_size_name'] ?? array_fill(0, count($cart_p_id), '');
    
    // Create line items for each product in cart
    foreach($cart_p_id as $key => $product_id) {
        $product_name = $cart_p_name[$key];
        $color = $cart_color_name[$key];
        $size = $cart_size_name[$key];
        
        // Add color and size to product name if they exist
        if(!empty($color)) {
            $product_name .= " - " . $color;
        }
        if(!empty($size)) {
            $product_name .= " - " . $size;
        }
        
        $line_items[] = [
            "quantity" => $cart_p_qty[$key],
            "price_data" => [
                "currency" => "usd", // Change to your currency if needed
                "unit_amount" => $cart_p_current_price[$key] * 100, // Stripe uses cents
                "product_data" => [
                    "name" => $product_name
                ]
            ]
        ];
    }
    
    // Add shipping cost as a separate line item if needed
    $shipping_cost = 1000; // Example: $10.00 in cents
    $line_items[] = [
        "quantity" => 1,
        "price_data" => [
            "currency" => "usd",
            "unit_amount" => $shipping_cost,
            "product_data" => [
                "name" => "Shipping Cost"
            ]
        ]
    ];
} else {
    die("Your cart is empty.");
}

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment",
        "success_url" => "http://localhost/success.php",
        "cancel_url" => "http://localhost/checkout.php",
        "locale" => "auto",
        "line_items" => $line_items
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
} catch (\Exception $e) {
    echo "Stripe Error: " . $e->getMessage();
}