<?php
ob_start();
session_start();
include("admin/inc/config.php");











// Check if 'id' and 'type' are set
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = (int)$_GET['id']; // Cast to integer for safety
    $type = $_GET['type'];
    $mcat_ids = [];
    $cat_name = ''; // Initialize category name variable

    if ($type === 'top-category') {
        // Get top category name
        $stmt = $pdo->prepare("SELECT tcat_name FROM tbl_top_category WHERE tcat_id = ?");
        $stmt->execute([$id]);
        $cat_name = $stmt->fetchColumn();

        // Get all mcat_id where tcat_id = id
        $stmt = $pdo->prepare("SELECT mcat_id, mcat_name FROM tbl_mid_category WHERE tcat_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($result as $row) {
            $mcat_ids[] = $row['mcat_id'];
        }
    } elseif ($type === 'mid-category') {
        // Get mid category name
        $stmt = $pdo->prepare("SELECT mcat_name FROM tbl_mid_category WHERE mcat_id = ?");
        $stmt->execute([$id]);
        $cat_name = $stmt->fetchColumn();

        // Just return that mcat_id directly
        $mcat_ids = [$id];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid type.']);
        exit;
    }

    // Output results
    if ($mcat_ids) {

       
        // Prepare the placeholders dynamically for the IN clause
        $placeholders = implode(',', array_fill(0, count($mcat_ids), '?'));

        $sql = "SELECT * FROM tbl_product WHERE mcat_id IN ($placeholders) AND p_is_active = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($mcat_ids);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($products) {
            echo json_encode([
                'status' => 'success', 
                'products' => $products,
                'category_name' => $cat_name
            ]);
        } else {
            echo json_encode([
                'status' => 'error', 
                'message' => 'No products found.',
                'category_name' => $cat_name
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error', 
            'message' => 'No matching categories found.',
            'category_name' => $cat_name
        ]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing parameters.']);
}
?>