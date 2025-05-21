<?php require_once('header.php'); ?>

<?php
// منع الوصول المباشر للصفحة
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // التحقق من صحة id
    $statement = $pdo->prepare("SELECT * FROM tbl_end_category WHERE ecat_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php
$p_ids = []; // التحقق من وجود المنتجات المرتبطة

// جلب جميع ecat_ids المرتبطة بـ ecat_id
$statement = $pdo->prepare("SELECT p_id FROM tbl_product WHERE ecat_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if(!empty($result)) {
    foreach ($result as $row) {
        $p_ids[] = $row['p_id'];
    }

    if (!empty($p_ids)) {
        for($i=0;$i<count($p_ids);$i++) {
            // حذف الصور المرتبطة بالمنتج
            $statement = $pdo->prepare("SELECT p_featured_photo FROM tbl_product WHERE p_id=?");
            $statement->execute(array($p_ids[$i]));
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $p_featured_photo = $result['p_featured_photo'];
                if (file_exists('../assets/uploads/'.$p_featured_photo)) {
                    unlink('../assets/uploads/'.$p_featured_photo);
                }
            }

            // حذف الصور الأخرى
            $statement = $pdo->prepare("SELECT photo FROM tbl_product_photo WHERE p_id=?");
            $statement->execute(array($p_ids[$i]));
            $photos = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($photos as $row) {
                if (file_exists('../assets/uploads/product_photos/'.$row['photo'])) {
                    unlink('../assets/uploads/product_photos/'.$row['photo']);
                }
            }

            // حذف جميع السجلات المتعلقة بالمنتجات
            $pdo->prepare("DELETE FROM tbl_product WHERE p_id=?")->execute(array($p_ids[$i]));
            $pdo->prepare("DELETE FROM tbl_product_photo WHERE p_id=?")->execute(array($p_ids[$i]));
            $pdo->prepare("DELETE FROM tbl_product_size WHERE p_id=?")->execute(array($p_ids[$i]));
            $pdo->prepare("DELETE FROM tbl_product_color WHERE p_id=?")->execute(array($p_ids[$i]));
            $pdo->prepare("DELETE FROM tbl_rating WHERE p_id=?")->execute(array($p_ids[$i]));

            // حذف الدفعات المرتبطة
            $statement = $pdo->prepare("SELECT payment_id FROM tbl_order WHERE product_id=?");
            $statement->execute(array($p_ids[$i]));
            $orders = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($orders as $order) {
                $pdo->prepare("DELETE FROM tbl_payment WHERE payment_id=?")->execute(array($order['payment_id']));
            }

            // حذف الطلبات المرتبطة
            $pdo->prepare("DELETE FROM tbl_order WHERE product_id=?")->execute(array($p_ids[$i]));
        }
    }
}

// حذف الفئة الأخيرة (end category)
$statement = $pdo->prepare("DELETE FROM tbl_end_category WHERE ecat_id=?");
$statement->execute(array($_REQUEST['id']));

header('location: end-category.php');
?>
