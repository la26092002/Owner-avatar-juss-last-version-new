<?php
ob_start();
session_start();
include("../../admin/inc/config.php");
include("../../admin/inc/functions.php");

// Check if the form was submitted
if (!isset($_REQUEST['msg'])) {
    if (empty($_POST['amount'])) {
        header('location: ../../checkout.php');
        exit;
    } else {
        $payment_date = date('Y-m-d H:i:s');
        $payment_id = time();

        // Insert payment details
        $statement = $pdo->prepare("INSERT INTO tbl_payment (
            customer_id,
            customer_name,
            customer_email,
            payment_date,
            txnid,
            paid_amount,
            bank_transaction_info,
            payment_method,
            payment_status,
            shipping_status,
            payment_id
        ) VALUES (?, ?, ?, ?, '', ?, ?, 'Bank Deposit', 'Pending', 'Pending', ?)");
        $statement->execute(array(
            $_SESSION['customer']['cust_id'],
            $_SESSION['customer']['cust_name'],
            $_SESSION['customer']['cust_email'],
            $payment_date,
            $_POST['amount'],
            $_POST['transaction_info'],
            $payment_id
        ));

        // Insert order details
        foreach ($_SESSION['cart_p_id'] as $i => $product_id) {
            $statement = $pdo->prepare("INSERT INTO tbl_order (
                product_id,
                product_name,
                size,
                color,
                quantity,
                unit_price,
                payment_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $statement->execute(array(
                $_SESSION['cart_p_id'][$i],
                $_SESSION['cart_p_name'][$i],
                $_SESSION['cart_size_name'][$i],
                $_SESSION['cart_color_name'][$i],
                $_SESSION['cart_p_qty'][$i],
                $_SESSION['cart_p_current_price'][$i],
                $payment_id
            ));

            // Update stock quantity
            $statement = $pdo->prepare("UPDATE tbl_product SET p_qty = p_qty - ? WHERE p_id = ?");
            $statement->execute(array($_SESSION['cart_p_qty'][$i], $_SESSION['cart_p_id'][$i]));
        }

        // Clear cart session data
        unset($_SESSION['cart_p_id']);
        unset($_SESSION['cart_size_id']);
        unset($_SESSION['cart_size_name']);
        unset($_SESSION['cart_color_id']);
        unset($_SESSION['cart_color_name']);
        unset($_SESSION['cart_p_qty']);
        unset($_SESSION['cart_p_current_price']);
        unset($_SESSION['cart_p_name']);
        unset($_SESSION['cart_p_featured_photo']);

        header('location: ../../payment_success.php');
        exit;
    }
}
?>
