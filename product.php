<?php
ob_start();
session_start();
include("admin/inc/config.php");
include("admin/inc/functions.php");
include("admin/inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

// Getting all language variables into array as global variable
$i = 1;
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    define('LANG_VALUE_' . $i, $row['lang_value']);
    $i++;
}

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $logo = $row['logo'];
    $favicon = $row['favicon'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $meta_title_home = $row['meta_title_home'];
    $meta_keyword_home = $row['meta_keyword_home'];
    $meta_description_home = $row['meta_description_home'];
    $before_head = $row['before_head'];
    $after_body = $row['after_body'];
}

// Checking the order table and removing the pending transaction that are 24 hours+ old. Very important
$current_date_time = date('Y-m-d H:i:s');
$statement = $pdo->prepare("SELECT * FROM tbl_payment WHERE payment_status=?");
$statement->execute(array('Pending'));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $ts1 = strtotime($row['payment_date']);
    $ts2 = strtotime($current_date_time);
    $diff = $ts2 - $ts1;
    $time = $diff / (3600);
    if ($time > 24) {

        // Return back the stock amount
        $statement1 = $pdo->prepare("SELECT * FROM tbl_order WHERE payment_id=?");
        $statement1->execute(array($row['payment_id']));
        $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result1 as $row1) {
            $statement2 = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
            $statement2->execute(array($row1['product_id']));
            $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result2 as $row2) {
                $p_qty = $row2['p_qty'];
            }
            $final = $p_qty + $row1['quantity'];

            $statement = $pdo->prepare("UPDATE tbl_product SET p_qty=? WHERE p_id=?");
            $statement->execute(array($final, $row1['product_id']));
        }

        // Deleting data from table
        $statement1 = $pdo->prepare("DELETE FROM tbl_order WHERE payment_id=?");
        $statement1->execute(array($row['payment_id']));

        $statement1 = $pdo->prepare("DELETE FROM tbl_payment WHERE id=?");
        $statement1->execute(array($row['id']));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/uploads/<?php echo $favicon; ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/jquery.bxslider.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/rating.css">
    <link rel="stylesheet" href="assets/css/spacing.css">
    <link rel="stylesheet" href="assets/css/bootstrap-touch-slider.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/tree-menu.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">




    <style>
        /* Force override for Add to Cart button */
        .btn-cart1 input[type="submit"],
        .btn-cart1 input[type="submit"]:hover,
        .btn-cart1 input[type="submit"]:focus {
            background-color: #FFC0CB !important;
            color: #000 !important;
            border: none !important;
        }

        .btn-cart1 input[type="submit"]:hover {
            background-color: #ff9aae !important;
        }

        /* styles.css */
        body {
            font-style: italic;
        }












        /* Style de la barre noire originale (inchangé) */
        .top {
            background-color: #000;
            width: 100%;
            overflow: hidden;
            height: 40px;
            display: flex;
            align-items: center;
        }

        /* Style de la nouvelle barre rose */
        .top-rose {
            background-color: #FFC0CB;
            /* Rose */
            width: 100%;
            overflow: hidden;
            height: 50px;
            /* Plus grande */
            display: flex;
            align-items: center;
        }

        /* Animation et texte pour la barre noire (originale) */
        .full-width-marquee {
            width: 100%;
            white-space: nowrap;
            position: relative;
        }

        .marquee-text {
            display: inline-block;
            padding-left: 100%;
            color: white;
            /* Texte blanc */
            font-size: 18px;
            font-weight: bold;
            /* Gras */
            font-style: italic;
            /* Italique */
            line-height: 1.3;
            animation: marquee 20s linear infinite;
        }

        /* Style spécifique pour le texte de la barre rose */
        .marquee-text-rose {
            display: inline-block;
            padding-left: 100%;
            color: #000;
            /* Texte noir */
            font-size: 22px;
            /* Plus grand */
            font-weight: bold;
            font-style: italic;
            /* Italique */
            line-height: 1.3;
            animation: marquee 20s linear infinite;
            /* Même animation */
        }

        /* Animation commune (réutilisée) */
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }








        ////////image  part 

        .spcl_section {
            width: 100%;
            padding: 60px 0;
            background-color: #f8f9fa;
            /* ou une autre couleur de fond */
        }

        .img-box img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .detail-box {
                text-align: center;
            }

            .col-md-6 {
                padding: 20px;
            }

            .img-box {
                margin-top: 20px;
            }
        }






        .option-group label:hover {
            border-color: #FFC0CB;
            transition: all 0.3s ease;
        }



        .btn-cart1 input[type="submit"] {
            background-color: #FFC0CB;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-cart1 input[type="submit"]:hover {
            background-color: #ff9aae;
            /* Slightly darker pink on hover */
        }



















        /* Size and Color Selection Options */
        .option-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .option-group input[type="radio"] {
            display: none;
        }

        /* Size Labels (unchanged) */
        .option-group label {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 50px;
            height: 50px;
            border: 2px solid #FFC0CB;

            text-align: center;
            font-weight: bold;
            cursor: pointer;
            padding: 5px;
            font-size: 12px;
            text-transform: capitalize;
            transition: all 0.3s ease;
            background-color: white;
            color: black;
            /* Default text color */
        }

        /* Color Labels - White by default with colored border */
        .option-group input[type="radio"][name="color_id"]+label {
            background-color: white !important;
            border: 2px solid var(--color-value);
            /* Will show the color as border */
            color: black;
            /* Dark text for visibility */
            position: relative;
        }

        /* Show color as a small circle inside the white button */
        .option-group input[type="radio"][name="color_id"]+label::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;

            background-color: var(--color-value);
            top: 4px;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Selected State - Pink background */
        .option-group input[type="radio"]:checked+label {
            background-color: #FFC0CB !important;
            border-color: #FFC0CB !important;
            color: black;
            transform: scale(1.05);
            box-shadow: 0 0 5px rgba(255, 192, 203, 0.7);
        }

        /* Hover State */
        .option-group label:hover {
            border-color: #ff9aae;
            transform: scale(1.03);
        }
    </style>




    <?php

    $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $about_meta_title = $row['about_meta_title'];
        $about_meta_keyword = $row['about_meta_keyword'];
        $about_meta_description = $row['about_meta_description'];
        $faq_meta_title = $row['faq_meta_title'];
        $faq_meta_keyword = $row['faq_meta_keyword'];
        $faq_meta_description = $row['faq_meta_description'];
        $blog_meta_title = $row['blog_meta_title'];
        $blog_meta_keyword = $row['blog_meta_keyword'];
        $blog_meta_description = $row['blog_meta_description'];
        $contact_meta_title = $row['contact_meta_title'];
        $contact_meta_keyword = $row['contact_meta_keyword'];
        $contact_meta_description = $row['contact_meta_description'];
        $pgallery_meta_title = $row['pgallery_meta_title'];
        $pgallery_meta_keyword = $row['pgallery_meta_keyword'];
        $pgallery_meta_description = $row['pgallery_meta_description'];
        $vgallery_meta_title = $row['vgallery_meta_title'];
        $vgallery_meta_keyword = $row['vgallery_meta_keyword'];
        $vgallery_meta_description = $row['vgallery_meta_description'];
    }

    $cur_page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

    if ($cur_page == 'index.php' || $cur_page == 'login.php' || $cur_page == 'registration.php' || $cur_page == 'cart.php' || $cur_page == 'checkout.php' || $cur_page == 'forget-password.php' || $cur_page == 'reset-password.php' || $cur_page == 'product-category.php' || $cur_page == 'product.php') {
        ?>
        <title><?php echo $meta_title_home; ?></title>
        <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
        <meta name="description" content="<?php echo $meta_description_home; ?>">
        <?php
    }

    if ($cur_page == 'about.php') {
        ?>
        <title><?php echo $about_meta_title; ?></title>
        <meta name="keywords" content="<?php echo $about_meta_keyword; ?>">
        <meta name="description" content="<?php echo $about_meta_description; ?>">
        <?php
    }
    if ($cur_page == 'faq.php') {
        ?>
        <title><?php echo $faq_meta_title; ?></title>
        <meta name="keywords" content="<?php echo $faq_meta_keyword; ?>">
        <meta name="description" content="<?php echo $faq_meta_description; ?>">
        <?php
    }
    if ($cur_page == 'contact.php') {
        ?>
        <title><?php echo $contact_meta_title; ?></title>
        <meta name="keywords" content="<?php echo $contact_meta_keyword; ?>">
        <meta name="description" content="<?php echo $contact_meta_description; ?>">
        <?php
    }
    if ($cur_page == 'product.php') {
        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $og_photo = $row['p_featured_photo'];
            $og_title = $row['p_name'];
            $og_slug = 'product.php?id=' . $_REQUEST['id'];
            $og_description = substr(strip_tags($row['p_description']), 0, 200) . '...';
        }
    }

    if ($cur_page == 'dashboard.php') {
        ?>
        <title>Dashboard - <?php echo $meta_title_home; ?></title>
        <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
        <meta name="description" content="<?php echo $meta_description_home; ?>">
        <?php
    }
    if ($cur_page == 'customer-profile-update.php') {
        ?>
        <title>Update Profile - <?php echo $meta_title_home; ?></title>
        <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
        <meta name="description" content="<?php echo $meta_description_home; ?>">
        <?php
    }
    if ($cur_page == 'customer-billing-shipping-update.php') {
        ?>
        <title>Update Billing and Shipping Info - <?php echo $meta_title_home; ?></title>
        <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
        <meta name="description" content="<?php echo $meta_description_home; ?>">
        <?php
    }
    if ($cur_page == 'customer-password-update.php') {
        ?>
        <title>Update Password - <?php echo $meta_title_home; ?></title>
        <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
        <meta name="description" content="<?php echo $meta_description_home; ?>">
        <?php
    }
    if ($cur_page == 'customer-order.php') {
        ?>
        <title>Orders - <?php echo $meta_title_home; ?></title>
        <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
        <meta name="description" content="<?php echo $meta_description_home; ?>">
        <?php
    }
    ?>

    <?php if ($cur_page == 'blog-single.php'): ?>
        <meta property="og:title" content="<?php echo $og_title; ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo BASE_URL . $og_slug; ?>">
        <meta property="og:description" content="<?php echo $og_description; ?>">
        <meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
    <?php endif; ?>

    <?php if ($cur_page == 'product.php'): ?>
        <meta property="og:title" content="<?php echo $og_title; ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo BASE_URL . $og_slug; ?>">
        <meta property="og:description" content="<?php echo $og_description; ?>">
        <meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <?php if (!empty($before_head)) { ?>
        <?php echo $before_head; ?>
    <?php } ?>
</head>

<body>
    <?php if (!empty($after_body)) { ?>
        <?php echo $after_body; ?>
    <?php } ?>
    <!--
<div id="preloader">
    <div id="status"></div>
</div>-->

    <!-- top bar -->




    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="full-width-marquee">
                        <div class="marquee-text">
                            Obtenez une expérience complète qui allie sécurité, esthétique et innovation.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="header">
        <div class="container">
            <div class="row inner">
                <div class="col-md-4 logo">
                    <a href="index.php">
                        <img src="assets/uploads/<?php echo $logo; ?>" alt="logo image">
                    </a>
                </div>

                <!-- Éléments alignés à droite -->
                <div class="col-md-4 right text-right">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <?php
                        if (isset($_SESSION['customer'])) {
                            ?>
                            <li style="display: inline-block; margin-left: 15px;"><a href="dashboard.php"
                                    style="color: #FFFFFF; text-decoration: none;"><i class="fa fa-home"></i> </a></li>
                            <?php
                        } else {
                            ?>
                            <li style="display: inline-block; margin-left: 15px;"><a href="login.php"
                                    style="color: #FFFFFF; text-decoration: none;"><i class="fa fa-sign-in"></i> </a></li>
                            <li style="display: inline-block; margin-left: 15px;"><a href="registration.php"
                                    style="color: #FFFFFF; text-decoration: none;"><i class="fa fa-user-plus"></i> </a></li>
                            <?php
                        }
                        ?>

                        <li style="display: inline-block; margin-left: 15px;"><a href="cart.php"
                                style="color: #FFFFFF; text-decoration: none;"><i class="fa fa-shopping-cart"></i> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="nav">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pl_0 pr_0">
                    <div class="menu-container">
                        <div class="menu">
                            <ul>
                                <?php
                                //changer par inverse 
                                $statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    ?>
                                    <li><a
                                            href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category"><?php echo $row['tcat_name']; ?></a>
                                        <ul>
                                            <?php
                                            $statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
                                            $statement1->execute(array($row['tcat_id']));
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                                ?>
                                                <li><a
                                                        href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category"><?php echo $row1['mcat_name']; ?></a>

                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>

                                <?php
                                $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $about_title = $row['about_title'];
                                    $faq_title = $row['faq_title'];
                                    $blog_title = $row['blog_title'];
                                    $contact_title = $row['contact_title'];
                                    $pgallery_title = $row['pgallery_title'];
                                    $vgallery_title = $row['vgallery_title'];
                                }
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (!isset($_REQUEST['id'])) {
        header('location: index.php');
        exit;
    } else {
        // Check the id is valid or not
        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
        $statement->execute(array($_REQUEST['id']));
        $total = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($total == 0) {
            header('location: index.php');
            exit;
        }
    }

    foreach ($result as $row) {
        $p_name = $row['p_name'];
        $p_old_price = $row['p_old_price'];
        $p_current_price = $row['p_current_price'];
        $p_qty = $row['p_qty'];
        $p_featured_photo = $row['p_featured_photo'];
        $p_description = $row['p_description'];
        $p_short_description = $row['p_short_description'];
        $p_feature = $row['p_feature'];
        $p_condition = $row['p_condition'];
        $p_return_policy = $row['p_return_policy'];
        $p_total_view = $row['p_total_view'];
        $p_is_featured = $row['p_is_featured'];
        $p_is_active = $row['p_is_active'];

        $mcat_id = $row['mcat_id'];
    }

    // Getting all categories name for breadcrumb
    $statement = $pdo->prepare("SELECT
                        t1.mcat_id,
                        t1.mcat_name,
                        t1.tcat_id,

                        t2.tcat_id,
                        t2.tcat_name

                        FROM tbl_mid_category t1
                        JOIN tbl_top_category t2
                        ON t1.tcat_id = t2.tcat_id
                        WHERE t1.mcat_id=?");
    $statement->execute(array($mcat_id));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $mcat_name = $row['mcat_name'];
        $tcat_id = $row['tcat_id'];
        $tcat_name = $row['tcat_name'];
    }


    $p_total_view = $p_total_view + 1;

    $statement = $pdo->prepare("UPDATE tbl_product SET p_total_view=? WHERE p_id=?");
    $statement->execute(array($p_total_view, $_REQUEST['id']));


    $statement = $pdo->prepare("SELECT * FROM tbl_product_size WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $size[] = $row['size_id'];
    }

    $statement = $pdo->prepare("SELECT * FROM tbl_product_color WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $color[] = $row['color_id'];
    }


    if (isset($_POST['form_review'])) {

        $statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=? AND cust_id=?");
        $statement->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id']));
        $total = $statement->rowCount();

        if ($total) {
            $error_message = LANG_VALUE_68;
        } else {
            $statement = $pdo->prepare("INSERT INTO tbl_rating (p_id,cust_id,comment,rating) VALUES (?,?,?,?)");
            $statement->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id'], $_POST['comment'], $_POST['rating']));
            $success_message = LANG_VALUE_163;
        }

    }

    // Getting the average rating for this product
    $t_rating = 0;
    $statement = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
    $statement->execute(array($_REQUEST['id']));
    $tot_rating = $statement->rowCount();
    if ($tot_rating == 0) {
        $avg_rating = 0;
    } else {
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $t_rating = $t_rating + $row['rating'];
        }
        $avg_rating = $t_rating / $tot_rating;
    }

    if (isset($_POST['form_add_to_cart'])) {

        // getting the currect stock of this product
        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
        $statement->execute(array($_REQUEST['id']));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $current_p_qty = $row['p_qty'];
        }
        if ($_POST['p_qty'] > $current_p_qty):
            $temp_msg = 'Sorry! There are only ' . $current_p_qty . ' item(s) in stock';
            ?>
            <script type="text/javascript">alert('<?php echo $temp_msg; ?>');</script>
            <?php
        else:
            if (isset($_SESSION['cart_p_id'])) {
                $arr_cart_p_id = array();
                $arr_cart_size_id = array();
                $arr_cart_color_id = array();
                $arr_cart_p_qty = array();
                $arr_cart_p_current_price = array();

                $i = 0;
                foreach ($_SESSION['cart_p_id'] as $key => $value) {
                    $i++;
                    $arr_cart_p_id[$i] = $value;
                }

                $i = 0;
                foreach ($_SESSION['cart_size_id'] as $key => $value) {
                    $i++;
                    $arr_cart_size_id[$i] = $value;
                }

                $i = 0;
                foreach ($_SESSION['cart_color_id'] as $key => $value) {
                    $i++;
                    $arr_cart_color_id[$i] = $value;
                }


                $added = 0;
                if (!isset($_POST['size_id'])) {
                    $size_id = 0;
                } else {
                    $size_id = $_POST['size_id'];
                }
                if (!isset($_POST['color_id'])) {
                    $color_id = 0;
                } else {
                    $color_id = $_POST['color_id'];
                }
                for ($i = 1; $i <= count($arr_cart_p_id); $i++) {
                    if (($arr_cart_p_id[$i] == $_REQUEST['id']) && ($arr_cart_size_id[$i] == $size_id) && ($arr_cart_color_id[$i] == $color_id)) {
                        $added = 1;
                        break;
                    }
                }
                if ($added == 1) {
                    $error_message1 = 'Ce produit est déjà ajouté au panier.';
                } else {

                    $i = 0;
                    foreach ($_SESSION['cart_p_id'] as $key => $res) {
                        $i++;
                    }
                    $new_key = $i + 1;

                    if (isset($_POST['size_id'])) {

                        $size_id = $_POST['size_id'];

                        $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
                        $statement->execute(array($size_id));
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $size_name = $row['size_name'];
                        }
                    } else {
                        $size_id = 0;
                        $size_name = '';
                    }

                    if (isset($_POST['color_id'])) {
                        $color_id = $_POST['color_id'];
                        $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
                        $statement->execute(array($color_id));
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $color_name = $row['color_name'];
                        }
                    } else {
                        $color_id = 0;
                        $color_name = '';
                    }


                    $_SESSION['cart_p_id'][$new_key] = $_REQUEST['id'];
                    $_SESSION['cart_size_id'][$new_key] = $size_id;
                    $_SESSION['cart_size_name'][$new_key] = $size_name;
                    $_SESSION['cart_color_id'][$new_key] = $color_id;
                    $_SESSION['cart_color_name'][$new_key] = $color_name;
                    $_SESSION['cart_p_qty'][$new_key] = $_POST['p_qty'];
                    $_SESSION['cart_p_current_price'][$new_key] = $_POST['p_current_price'];
                    $_SESSION['cart_p_name'][$new_key] = $_POST['p_name'];
                    $_SESSION['cart_p_featured_photo'][$new_key] = $_POST['p_featured_photo'];

                    $success_message1 = 'Product is added to the cart successfully!';
                }

            } else {

                if (isset($_POST['size_id'])) {

                    $size_id = $_POST['size_id'];

                    $statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
                    $statement->execute(array($size_id));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $size_name = $row['size_name'];
                    }
                } else {
                    $size_id = 0;
                    $size_name = '';
                }

                if (isset($_POST['color_id'])) {
                    $color_id = $_POST['color_id'];
                    $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id=?");
                    $statement->execute(array($color_id));
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $color_name = $row['color_name'];
                    }
                } else {
                    $color_id = 0;
                    $color_name = '';
                }


                $_SESSION['cart_p_id'][1] = $_REQUEST['id'];
                $_SESSION['cart_size_id'][1] = $size_id;
                $_SESSION['cart_size_name'][1] = $size_name;
                $_SESSION['cart_color_id'][1] = $color_id;
                $_SESSION['cart_color_name'][1] = $color_name;
                $_SESSION['cart_p_qty'][1] = $_POST['p_qty'];
                $_SESSION['cart_p_current_price'][1] = $_POST['p_current_price'];
                $_SESSION['cart_p_name'][1] = $_POST['p_name'];
                $_SESSION['cart_p_featured_photo'][1] = $_POST['p_featured_photo'];

                $success_message1 = 'Product is added to the cart successfully!';
            }
        endif;
    }
    ?>

    <?php
    if ($error_message1 != '') {
        echo "<script>alert('" . $error_message1 . "')</script>";
    }

    if ($success_message1 != '') {
        echo "<script>
            alert('" . $success_message1 . "');
            window.location.href = 'product.php?id=" . $_REQUEST['id'] . "';
          </script>";
        exit();
    }

    ?>


    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb mb_30">
                        <ul>
                            <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                            <li>></li>
                            <li><a
                                    href="<?php echo BASE_URL . 'product-category.php?id=' . $tcat_id . '&type=top-category' ?>"><?php echo $tcat_name; ?></a>
                            </li>
                            <li>></li>
                            <li><a
                                    href="<?php echo BASE_URL . 'product-category.php?id=' . $mcat_id . '&type=mid-category' ?>"><?php echo $mcat_name; ?></a>
                            </li>
                            <li>></li>
                            <li><?php echo $p_name; ?></li>
                        </ul>
                    </div>

                    <div class="product">
                        <div class="row">
                            <div class="col-md-5">
                                <ul class="prod-slider">
                                    <?php if (!isset($_GET['color_id'])): ?>
                                        <li style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>);">
                                            <a class="popup" href="assets/uploads/<?php echo $p_featured_photo; ?>"></a>
                                        </li>

                                    <?php endif; ?>
                                    <?php
                                    $colorFilter = isset($_GET['color_id']) ? $_GET['color_id'] : null;

                                    if ($colorFilter) {
                                        $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=? AND color_id=?");
                                        $statement->execute([$_REQUEST['id'], $colorFilter]);
                                    } else {
                                        $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                        $statement->execute([$_REQUEST['id']]);
                                    }

                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        ?>
                                        <li
                                            style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>);">
                                            <a class="popup"
                                                href="assets/uploads/product_photos/<?php echo $row['photo']; ?>"></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <div id="prod-pager">
                                    <a data-slide-index="0" href="">
                                        <?php if (!isset($_GET['color_id'])): ?>
                                            <div class="prod-pager-thumb"
                                                style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>);">
                                            </div>
                                        <?php endif; ?>

                                    </a>
                                    <?php
                                    $i = 1;
                                    $colorFilter = isset($_GET['color_id']) ? $_GET['color_id'] : null;

                                    if ($colorFilter) {
                                        $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=? AND color_id=?");
                                        $statement->execute([$_REQUEST['id'], $colorFilter]);
                                    } else {
                                        $statement = $pdo->prepare("SELECT * FROM tbl_product_photo WHERE p_id=?");
                                        $statement->execute([$_REQUEST['id']]);
                                    }

                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        ?>
                                        <a data-slide-index="<?php echo $i; ?>" href="">
                                            <div class="prod-pager-thumb"
                                                style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>">
                                            </div>
                                        </a>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="p-title">
                                    <h2><?php echo $p_name; ?></h2>
                                </div>
                                <div class="p-review">
                                    <div class="rating">
                                        <?php
                                        if ($avg_rating == 0) {
                                            echo '';
                                        } elseif ($avg_rating == 1.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                        } elseif ($avg_rating == 2.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                        } elseif ($avg_rating == 3.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                        } elseif ($avg_rating == 4.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                        } else {
                                            for ($i = 1; $i <= 5; $i++) {
                                                ?>
                                                <?php if ($i > $avg_rating): ?>
                                                    <i class="fa fa-star-o"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-star"></i>
                                                <?php endif; ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="p-short-des">
                                    <p>
                                        <?php echo $p_short_description; ?>
                                    </p>
                                </div>
                                <form action="" method="post">
                                    <div class="p-quantity">
                                        <!-- ------------------------------------------- -->
                                        <style>
                                            .option-group {
                                                display: flex;
                                                flex-wrap: wrap;
                                                gap: 10px;
                                            }

                                            .option-group input[type="radio"] {
                                                display: none;
                                            }

                                            .option-group label {
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                width: 50px;
                                                height: 50px;
                                                border: 2px solid #ccc;

                                                text-align: center;
                                                font-weight: bold;
                                                cursor: pointer;
                                                padding: 5px;
                                                font-size: 12px;
                                                text-transform: capitalize;
                                                overflow: hidden;
                                                word-wrap: break-word;
                                                text-align: center;
                                            }

                                            .option-group input[type="radio"]:checked+label {
                                                background-color: #ff6600;
                                                border-color: #ff6600;
                                                color: #fff;
                                            }




















                                            /* Size and Color Selection Options */
                                            .option-group {
                                                display: flex;
                                                flex-wrap: wrap;
                                                gap: 10px;
                                                margin-top: 10px;
                                            }

                                            .option-group input[type="radio"] {
                                                display: none;
                                            }

                                            /* Size Labels */
                                            .option-group label {
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                min-width: 50px;
                                                height: 50px;
                                                border: 2px solid #FFC0CB;

                                                text-align: center;
                                                font-weight: bold;
                                                cursor: pointer;
                                                padding: 5px;
                                                font-size: 12px;
                                                text-transform: capitalize;
                                                transition: all 0.3s ease;
                                                background-color: white;
                                            }

                                            /* Color Labels - Make them circular color swatches */
                                            .option-group input[type="radio"][name="color_id"]+label {
                                                background-color: var(--color-value);
                                                /* Will be set inline */
                                                border: 2px solid #FFC0CB;
                                                color: black;
                                                text-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
                                            }

                                            /* Selected State */
                                            .option-group input[type="radio"]:checked+label {
                                                background-color: #FFC0CB;
                                                border-color: #FFC0CB;
                                                color: black;
                                                transform: scale(1.05);
                                                box-shadow: 0 0 5px rgba(255, 192, 203, 0.7);
                                            }

                                            /* Hover State */
                                            .option-group label:hover {
                                                border-color: #ff9aae;
                                                transform: scale(1.03);
                                            }
                                        </style>

                                        <div class="row">


                                        <?php if (isset($color)): ?>
                                                <div class="col-md-12 mb_20">
                                                    <strong><?php echo LANG_VALUE_53; ?></strong><br>
                                                    <style>
    /* Color Selection Options */
    

    
    /* Color image styling */
    .option-group input[type="radio"][name="color_id"] + label img {
        display: block;
        width: 100px;
        height: auto;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    /* Selected State - Pink glow effect */
    .option-group input[type="radio"][name="color_id"]:checked + label {
        border-color: #FFC0CB;
        box-shadow: 0 0 10px rgba(255, 192, 203, 0.8);
        transform: scale(1.05);
    }

    /* Hover State */
    .option-group input[type="radio"][name="color_id"] + label:hover {
        border-color: #FFC0CB;
    }

    /* Optional: Add a pink overlay when selected */
    .option-group input[type="radio"][name="color_id"]:checked + label::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 192, 203, 0.2);
        z-index: 1;
    }
</style>

<div class="option-group">
    <?php
    $selectedColorId = isset($_GET['color_id']) ? $_GET['color_id'] : null;

    $statement = $pdo->prepare("SELECT * FROM tbl_color");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        if (in_array($row['color_id'], $color)) {
            $isChecked = ($selectedColorId == $row['color_id']) ? 'checked' : '';
            ?>
            <input type="radio" id="color_<?php echo $row['color_id']; ?>"
                name="color_id" value="<?php echo $row['color_id']; ?>"
                onchange="updateColorId(this.value)" <?php echo $isChecked; ?>>
            <label for="color_<?php echo $row['color_id']; ?>">
                <img src="../assets/uploads/colors/<?php echo htmlspecialchars($row['color_img']); ?>" 
                     alt="<?php echo htmlspecialchars($row['color_name']); ?>" 
                     width="100">
            </label>
            <?php
        }
    }
    ?>
</div>

<script>
    function updateColorId(colorId) {
        const url = new URL(window.location.href);
        url.searchParams.set('color_id', colorId);
        window.location.href = url.toString();
    }
</script>
                                                </div>

                                                <script>
                                                    function updateColorId(colorId) {
                                                        const url = new URL(window.location.href);
                                                        url.searchParams.set('color_id', colorId);
                                                        window.location.href = url.toString();
                                                    }
                                                </script>
                                            <?php endif; ?>


                                            <?php if (isset($size)): ?>
                                                <div class="col-md-12 mb_20">
                                                    <strong><?php echo LANG_VALUE_52; ?></strong><br>
                                                    <div class="option-group">
                                                        <?php
                                                        $statement = $pdo->prepare("SELECT * FROM tbl_size");
                                                        $statement->execute();
                                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($result as $row) {
                                                            if (in_array($row['size_id'], $size)) {
                                                                ?>
                                                                <input type="radio" id="size_<?php echo $row['size_id']; ?>"
                                                                    name="size_id" value="<?php echo $row['size_id']; ?>">
                                                                <label
                                                                    for="size_<?php echo $row['size_id']; ?>"><?php echo $row['size_name']; ?></label>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>






                                            

                                        </div>

                                        <!-- ----------------------------------------- -->
                                    </div>
                                    <div class="p-price">
                                        <span style="font-size:14px;"><?php echo LANG_VALUE_54; ?></span><br>
                                        <span>
                                            <?php if ($p_old_price != ''): ?>
                                                <del><?php echo LANG_VALUE_1; ?><?php echo $p_old_price; ?></del>
                                            <?php endif; ?>
                                            <?php echo $p_current_price; ?> <?php echo LANG_VALUE_1; ?>
                                        </span>
                                    </div>
                                    <input type="hidden" name="p_current_price" value="<?php echo $p_current_price; ?>">
                                    <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
                                    <input type="hidden" name="p_featured_photo"
                                        value="<?php echo $p_featured_photo; ?>">
                                    <div class="p-quantity">
                                        <?php echo LANG_VALUE_55; ?> <br>
                                        <input type="number" class="input-text qty" step="1" min="1" max="" name="p_qty"
                                            value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                                    </div>
                                    <div class="btn-cart btn-cart1">
                                        <input type="submit" value="<?php echo LANG_VALUE_154; ?>"
                                            name="form_add_to_cart">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#description"
                                            aria-controls="description" role="tab"
                                            data-toggle="tab"><?php echo LANG_VALUE_59; ?></a></li>
                                    <li role="presentation"><a href="#feature" aria-controls="feature" role="tab"
                                            data-toggle="tab"><?php echo LANG_VALUE_60; ?></a></li>
                                    <li role="presentation"><a href="#condition" aria-controls="condition" role="tab"
                                            data-toggle="tab"><?php echo LANG_VALUE_61; ?></a></li>
                                    <li role="presentation"><a href="#return_policy" aria-controls="return_policy"
                                            role="tab" data-toggle="tab"><?php echo LANG_VALUE_62; ?></a></li>
                                    <!-- <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab"><?php echo LANG_VALUE_63; ?></a></li> -->
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="description"
                                        style="margin-top: -30px;">
                                        <p>
                                            <?php
                                            if ($p_description == '') {
                                                echo LANG_VALUE_70;
                                            } else {
                                                echo $p_description;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="feature" style="margin-top: -30px;">
                                        <p>
                                            <?php
                                            if ($p_feature == '') {
                                                echo LANG_VALUE_71;
                                            } else {
                                                echo $p_feature;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="condition" style="margin-top: -30px;">
                                        <p>
                                            <?php
                                            if ($p_condition == '') {
                                                echo LANG_VALUE_72;
                                            } else {
                                                echo $p_condition;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="return_policy" style="margin-top: -30px;">
                                        <p>
                                            <?php
                                            if ($p_return_policy == '') {
                                                echo LANG_VALUE_73;
                                            } else {
                                                echo $p_return_policy;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="review" style="margin-top: -30px;">

                                        <div class="review-form">
                                            <?php
                                            $statement = $pdo->prepare("SELECT * 
                                                            FROM tbl_rating t1 
                                                            JOIN tbl_customer t2 
                                                            ON t1.cust_id = t2.cust_id 
                                                            WHERE t1.p_id=?");
                                            $statement->execute(array($_REQUEST['id']));
                                            $total = $statement->rowCount();
                                            ?>
                                            <h2><?php echo LANG_VALUE_63; ?> (<?php echo $total; ?>)</h2>
                                            <?php
                                            if ($total) {
                                                $j = 0;
                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $row) {
                                                    $j++;
                                                    ?>
                                                    <div class="mb_10"><b><u><?php echo LANG_VALUE_64; ?>
                                                                <?php echo $j; ?></u></b></div>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th style="width:170px;"><?php echo LANG_VALUE_75; ?></th>
                                                            <td><?php echo $row['cust_name']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo LANG_VALUE_76; ?></th>
                                                            <td><?php echo $row['comment']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo LANG_VALUE_78; ?></th>
                                                            <td>
                                                                <div class="rating">
                                                                    <?php
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        ?>
                                                                        <?php if ($i > $row['rating']): ?>
                                                                            <i class="fa fa-star-o"></i>
                                                                        <?php else: ?>
                                                                            <i class="fa fa-star"></i>
                                                                        <?php endif; ?>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <?php
                                                }
                                            } else {
                                                echo LANG_VALUE_74;
                                            }
                                            ?>

                                            <h2><?php echo LANG_VALUE_65; ?></h2>
                                            <?php
                                            if ($error_message != '') {
                                                echo "<script>alert('" . $error_message . "')</script>";
                                            }
                                            if ($success_message != '') {
                                                echo "<script>alert('" . $success_message . "')</script>";
                                            }
                                            ?>
                                            <?php if (isset($_SESSION['customer'])): ?>

                                                <?php
                                                $statement = $pdo->prepare("SELECT * 
                                                                FROM tbl_rating
                                                                WHERE p_id=? AND cust_id=?");
                                                $statement->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id']));
                                                $total = $statement->rowCount();
                                                ?>
                                                <?php if ($total == 0): ?>
                                                    <form action="" method="post">
                                                        <div class="rating-section">
                                                            <input type="radio" name="rating" class="rating" value="1" checked>
                                                            <input type="radio" name="rating" class="rating" value="2" checked>
                                                            <input type="radio" name="rating" class="rating" value="3" checked>
                                                            <input type="radio" name="rating" class="rating" value="4" checked>
                                                            <input type="radio" name="rating" class="rating" value="5" checked>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea name="comment" class="form-control" cols="30" rows="10"
                                                                placeholder="Write your comment (optional)"
                                                                style="height:100px;"></textarea>
                                                        </div>
                                                        <input type="submit" class="btn btn-default" name="form_review"
                                                            value="<?php echo LANG_VALUE_67; ?>">
                                                    </form>
                                                <?php else: ?>
                                                    <span style="color:red;"><?php echo LANG_VALUE_68; ?></span>
                                                <?php endif; ?>


                                            <?php else: ?>
                                                <p class="error">
                                                    <?php echo LANG_VALUE_69; ?> <br>
                                                    <a href="login.php"
                                                        style="color:red;text-decoration: underline;"><?php echo LANG_VALUE_9; ?></a>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="product bg-gray pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline">
                        <h2><?php echo LANG_VALUE_155; ?></h2>
                        <h3><?php echo LANG_VALUE_156; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="product-carousel">

                        <?php
                        $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE mcat_id=? AND p_id!=?");
                        $statement->execute(array($mcat_id, $_REQUEST['id']));
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            ?>
                            <div class="item">
                                <div class="thumb">
                                    <div class="photo"
                                        style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);">
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="text">
                                    <h3><a
                                            href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a>
                                    </h3>
                                    <h4>
                                        <?php echo LANG_VALUE_1; ?>     <?php echo $row['p_current_price']; ?>
                                        <?php if ($row['p_old_price'] != ''): ?>
                                            <del>
                                                <?php echo LANG_VALUE_1; ?>         <?php echo $row['p_old_price']; ?>
                                            </del>
                                        <?php endif; ?>
                                    </h4>
                                    <div class="rating">
                                        <?php
                                        $t_rating = 0;
                                        $statement1 = $pdo->prepare("SELECT * FROM tbl_rating WHERE p_id=?");
                                        $statement1->execute(array($row['p_id']));
                                        $tot_rating = $statement1->rowCount();
                                        if ($tot_rating == 0) {
                                            $avg_rating = 0;
                                        } else {
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                                $t_rating = $t_rating + $row1['rating'];
                                            }
                                            $avg_rating = $t_rating / $tot_rating;
                                        }
                                        ?>
                                        <?php
                                        if ($avg_rating == 0) {
                                            echo '';
                                        } elseif ($avg_rating == 1.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                        } elseif ($avg_rating == 2.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                        } elseif ($avg_rating == 3.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        ';
                                        } elseif ($avg_rating == 4.5) {
                                            echo '
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        ';
                                        } else {
                                            for ($i = 1; $i <= 5; $i++) {
                                                ?>
                                                <?php if ($i > $avg_rating): ?>
                                                    <i class="fa fa-star-o"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-star"></i>
                                                <?php endif; ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <p><a
                                            href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo LANG_VALUE_154; ?></a>
                                    </p>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php require_once('footer.php'); ?>