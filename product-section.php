<?php
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = (int)$_GET['id'];
    $type = $_GET['type'];
    $mcat_ids = [];
    $cat_name = '';

    if ($type === 'top-category') {
        $stmt = $pdo->prepare("SELECT tcat_name FROM tbl_top_category WHERE tcat_id = ?");
        $stmt->execute([$id]);
        $cat_name = $stmt->fetchColumn();

        $stmt = $pdo->prepare("SELECT mcat_id FROM tbl_mid_category WHERE tcat_id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $mcat_ids[] = $row['mcat_id'];
        }
    } elseif ($type === 'mid-category') {
        $stmt = $pdo->prepare("SELECT mcat_name FROM tbl_mid_category WHERE mcat_id = ?");
        $stmt->execute([$id]);
        $cat_name = $stmt->fetchColumn();

        $mcat_ids[] = $id;
    } else {
        exit;
    }
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_product_category; ?>)">
    <div class="inner">
        <h1><?php echo LANG_VALUE_50; ?> <?php echo htmlspecialchars($cat_name); ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('sidebar-category.php'); ?>
            </div>
            <div class="col-md-9">
                <h3><?php echo htmlspecialchars($cat_name); ?></h3>
                <div class="product product-cat">
                    <div class="row">

<?php
$prod_count = 0;

foreach ($mcat_ids as $mcat_id) {
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE mcat_id=? AND p_is_active=1");
    $statement->execute([$mcat_id]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $prod_count += count($result);

    foreach ($result as $row) {
        ?>
        <div class="col-md-4 item item-product-cat">
            <div class="inner">
                <div class="thumb">
                    <div class="photo" style="background-image:url(assets/uploads/<?php echo htmlspecialchars($row['p_featured_photo']); ?>);"></div>
                    <div class="overlay"></div>
                </div>
                <div class="text">
                    <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo htmlspecialchars($row['p_name']); ?></a></h3>
                    <h4>
                        <?php echo htmlspecialchars($row['p_current_price']); ?> <?php echo LANG_VALUE_1; ?>
                        <?php if (!empty($row['p_old_price'])): ?>
                        <del><?php echo htmlspecialchars($row['p_old_price']); ?> <?php echo LANG_VALUE_1; ?></del>
                        <?php endif; ?>
                    </h4>
                    <div class="rating">
                        <?php
                        $t_rating = 0;
                        $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                        $statement1->execute([$row['p_id']]);
                        $tot_rating = $statement1->rowCount();
                        $avg_rating = $tot_rating > 0 ? array_sum(array_column($statement1->fetchAll(PDO::FETCH_ASSOC), 'rating')) / $tot_rating : 0;

                        
                        ?>
                    </div>

                    <?php if ($row['p_qty'] == 0): ?>
                        <div class="out-of-stock">
                            <div class="inner">
                                <?php echo LANG_VALUE_4; // typically "Out of Stock" ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i> <?php echo LANG_VALUE_154; ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

if ($prod_count == 0) {
    echo '<div class="pl_15">'.LANG_VALUE_153.'</div>'; // "No product found in this category"
}
?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
