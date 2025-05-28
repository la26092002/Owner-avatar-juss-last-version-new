<?php require_once('header.php'); ?>

<?php
if( !isset($_REQUEST['id']) || !isset($_REQUEST['id1']) ) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE pp_id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php
    // Getting photo info to get the color_id and unlink from folder
    $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE pp_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
    foreach ($result as $row) {
        $photo = $row['photo'];
        $color_id = $row['color_id'];
        $p_id = $row['p_id'];
    }

    // Unlink the photo
    if($photo!='') {
        unlink('../assets/uploads/product_photos/'.$photo);    
    }

    // Delete from tbl_product_photo
    $statement = $pdo->prepare("DELETE FROM tbl_product_photo WHERE pp_id=?");
    $statement->execute(array($_REQUEST['id']));

    // Check if this was the last photo with this color for this product
    if($color_id) {
        // Count how many photos remain with this color for this product
        $statement = $pdo->prepare("SELECT COUNT(*) AS color_count FROM tbl_product_photo WHERE p_id = ? AND color_id = ?");
        $statement->execute(array($p_id, $color_id));
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if($result['color_count'] == 0) {
            // No more photos with this color exist for this product, so remove the color relation
            $statement = $pdo->prepare("DELETE FROM tbl_product_color WHERE p_id = ? AND color_id = ?");
            $statement->execute(array($p_id, $color_id));
        }
    }

    header('location: product-edit.php?id='.$_REQUEST['id1']);
?>