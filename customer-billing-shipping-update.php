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
$i=1;
$statement = $pdo->prepare("SELECT * FROM tbl_language");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	define('LANG_VALUE_'.$i,$row['lang_value']);
	$i++;
}

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
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
	$time = $diff/(3600);
	if($time>24) {

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
			$final = $p_qty+$row1['quantity'];

			$statement = $pdo->prepare("UPDATE tbl_product SET p_qty=? WHERE p_id=?");
			$statement->execute(array($final,$row1['product_id']));
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
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

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

	$cur_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	
	if($cur_page == 'index.php' || $cur_page == 'login.php' || $cur_page == 'registration.php' || $cur_page == 'cart.php' || $cur_page == 'checkout.php' || $cur_page == 'forget-password.php' || $cur_page == 'reset-password.php' || $cur_page == 'product-category.php' || $cur_page == 'product.php') {
		?>
		<title><?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}

	if($cur_page == 'about.php') {
		?>
		<title><?php echo $about_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $about_meta_keyword; ?>">
		<meta name="description" content="<?php echo $about_meta_description; ?>">
		<?php
	}
	if($cur_page == 'faq.php') {
		?>
		<title><?php echo $faq_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $faq_meta_keyword; ?>">
		<meta name="description" content="<?php echo $faq_meta_description; ?>">
		<?php
	}
	if($cur_page == 'contact.php') {
		?>
		<title><?php echo $contact_meta_title; ?></title>
		<meta name="keywords" content="<?php echo $contact_meta_keyword; ?>">
		<meta name="description" content="<?php echo $contact_meta_description; ?>">
		<?php
	}
	if($cur_page == 'product.php')
	{
		$statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) 
		{
		    $og_photo = $row['p_featured_photo'];
		    $og_title = $row['p_name'];
		    $og_slug = 'product.php?id='.$_REQUEST['id'];
			$og_description = substr(strip_tags($row['p_description']),0,200).'...';
		}
	}

	if($cur_page == 'dashboard.php') {
		?>
		<title>Dashboard - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-profile-update.php') {
		?>
		<title>Update Profile - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-billing-shipping-update.php') {
		?>
		<title>Update Billing and Shipping Info - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-password-update.php') {
		?>
		<title>Update Password - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	if($cur_page == 'customer-order.php') {
		?>
		<title>Orders - <?php echo $meta_title_home; ?></title>
		<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
		<meta name="description" content="<?php echo $meta_description_home; ?>">
		<?php
	}
	?>
	
	<?php if($cur_page == 'blog-single.php'): ?>
		<meta property="og:title" content="<?php echo $og_title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo BASE_URL.$og_slug; ?>">
		<meta property="og:description" content="<?php echo $og_description; ?>">
		<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
	<?php endif; ?>

	<?php if($cur_page == 'product.php'): ?>
		<meta property="og:title" content="<?php echo $og_title; ?>">
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?php echo BASE_URL.$og_slug; ?>">
		<meta property="og:description" content="<?php echo $og_description; ?>">
		<meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
	<?php endif; ?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	<?php if (!empty ($before_head)) {?>
<?php echo $before_head; ?>
<?php }?>
</head>
<body>
<?php if (!empty ($after_body)) {?>
<?php echo $after_body; ?>
<?php }?>
<!--
<div id="preloader">
	<div id="status"></div>
</div>-->

<!-- top bar -->
<div class="top">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="left">
					<ul><?php if (!empty ($contact_phone)) {?>
						<li><i class="fa fa-phone"></i> <?php echo $contact_phone; ?></li>
						<?php }?>
						<?php if (!empty ($contact_email)) {?>
						<li><i class="fa fa-envelope-o"></i> <?php echo $contact_email; ?></li>
					<?php }?>
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="right">
					<ul>
						<?php
						$statement = $pdo->prepare("SELECT * FROM tbl_social");
						$statement->execute();
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach ($result as $row) {
							?>
							<?php if($row['social_url'] != ''): ?>
							<li><a href="<?php echo $row['social_url']; ?>"><i class="<?php echo $row['social_icon']; ?>"></i></a></li>
							<?php endif; ?>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="header">
	<div class="container">
		<div class="row inner">
			<div class="col-md-4 logo">
				<a href="index.php"><img src="assets/uploads/<?php echo $logo; ?>" alt="logo image"></a>
			</div>
			
			<div class="col-md-5 right">
				<ul>
					
					<?php
					if(isset($_SESSION['customer'])) {
						?>
						<li><i class="fa fa-user"></i> <?php echo LANG_VALUE_13; ?> <?php echo $_SESSION['customer']['cust_name']; ?></li>
						<li><a href="dashboard.php"><i class="fa fa-home"></i> <?php echo LANG_VALUE_89; ?></a></li>
						<?php
					} else {
						?>
						<li><a href="login.php"><i class="fa fa-sign-in"></i> <?php echo LANG_VALUE_9; ?></a></li>
						<li><a href="registration.php"><i class="fa fa-user-plus"></i> <?php echo LANG_VALUE_15; ?></a></li>
						<?php	
					}
					?>

					<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> <?php echo LANG_VALUE_18; ?> (<?php echo LANG_VALUE_1; ?><?php
					if(isset($_SESSION['cart_p_id'])) {
						$table_total_price = 0;
						$i=0;
	                    foreach($_SESSION['cart_p_qty'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_qty[$i] = $value;
	                    }                    $i=0;
	                    foreach($_SESSION['cart_p_current_price'] as $key => $value) 
	                    {
	                        $i++;
	                        $arr_cart_p_current_price[$i] = $value;
	                    }
	                    for($i=1;$i<=count($arr_cart_p_qty);$i++) {
	                    	$row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
	                        $table_total_price = $table_total_price + $row_total_price;
	                    }
						echo $table_total_price;
					} else {
						echo '0.00';
					}
					?>)</a></li>
				</ul>
			</div>
			<div class="col-md-3 search-area">
				<form class="navbar-form navbar-left" role="search" action="search-result.php" method="get">
					<?php $csrf->echoInputField(); ?>
					<div class="form-group">
						<input type="text" class="form-control search-top" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text">
					</div>
					<button type="submit" class="btn "><?php echo LANG_VALUE_3; ?></button>
				</form>
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
								<li><a href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category"><?php echo $row['tcat_name']; ?></a>
									<ul>
										<?php
										$statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
										$statement1->execute(array($row['tcat_id']));
										$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
										foreach ($result1 as $row1) {
											?>
											<li><a href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category"><?php echo $row1['mcat_name']; ?></a>
												
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
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
    header('location: '.BASE_URL.'logout.php');
    exit;
} else {
    // If customer is logged in, but admin make him inactive, then force logout this user.
    $statement = $pdo->prepare("SELECT * FROM tbl_customer WHERE cust_id=? AND cust_status=?");
    $statement->execute(array($_SESSION['customer']['cust_id'],0));
    $total = $statement->rowCount();
    if($total) {
        header('location: '.BASE_URL.'logout.php');
        exit;
    }
}
?>

<?php
if (isset($_POST['form1'])) {


    // update data into the database
    $statement = $pdo->prepare("UPDATE tbl_customer SET 
                            cust_b_name=?, 
                            cust_b_cname=?, 
                            cust_b_phone=?, 
                            cust_b_country=?, 
                            cust_b_address=?, 
                            cust_b_city=?, 
                            cust_b_state=?, 
                            cust_b_zip=?,
                            cust_s_name=?, 
                            cust_s_cname=?, 
                            cust_s_phone=?, 
                            cust_s_country=?, 
                            cust_s_address=?, 
                            cust_s_city=?, 
                            cust_s_state=?, 
                            cust_s_zip=? 

                            WHERE cust_id=?");
    $statement->execute(array(
                            strip_tags($_POST['cust_b_name']),
                            strip_tags($_POST['cust_b_cname']),
                            strip_tags($_POST['cust_b_phone']),
                            strip_tags($_POST['cust_b_country']),
                            strip_tags($_POST['cust_b_address']),
                            strip_tags($_POST['cust_b_city']),
                            strip_tags($_POST['cust_b_state']),
                            strip_tags($_POST['cust_b_zip']),
                            strip_tags($_POST['cust_s_name']),
                            strip_tags($_POST['cust_s_cname']),
                            strip_tags($_POST['cust_s_phone']),
                            strip_tags($_POST['cust_s_country']),
                            strip_tags($_POST['cust_s_address']),
                            strip_tags($_POST['cust_s_city']),
                            strip_tags($_POST['cust_s_state']),
                            strip_tags($_POST['cust_s_zip']),
                            $_SESSION['customer']['cust_id']
                        ));  
   
    $success_message = LANG_VALUE_122;

    $_SESSION['customer']['cust_b_name'] = strip_tags($_POST['cust_b_name']);
    $_SESSION['customer']['cust_b_cname'] = strip_tags($_POST['cust_b_cname']);
    $_SESSION['customer']['cust_b_phone'] = strip_tags($_POST['cust_b_phone']);
    $_SESSION['customer']['cust_b_country'] = strip_tags($_POST['cust_b_country']);
    $_SESSION['customer']['cust_b_address'] = strip_tags($_POST['cust_b_address']);
    $_SESSION['customer']['cust_b_city'] = strip_tags($_POST['cust_b_city']);
    $_SESSION['customer']['cust_b_state'] = strip_tags($_POST['cust_b_state']);
    $_SESSION['customer']['cust_b_zip'] = strip_tags($_POST['cust_b_zip']);
    $_SESSION['customer']['cust_s_name'] = strip_tags($_POST['cust_s_name']);
    $_SESSION['customer']['cust_s_cname'] = strip_tags($_POST['cust_s_cname']);
    $_SESSION['customer']['cust_s_phone'] = strip_tags($_POST['cust_s_phone']);
    $_SESSION['customer']['cust_s_country'] = strip_tags($_POST['cust_s_country']);
    $_SESSION['customer']['cust_s_address'] = strip_tags($_POST['cust_s_address']);
    $_SESSION['customer']['cust_s_city'] = strip_tags($_POST['cust_s_city']);
    $_SESSION['customer']['cust_s_state'] = strip_tags($_POST['cust_s_state']);
    $_SESSION['customer']['cust_s_zip'] = strip_tags($_POST['cust_s_zip']);

}
?>

<div class="page">
    <div class="container">
        <div class="row">            
            <div class="col-md-12"> 
                <?php require_once('customer-sidebar.php'); ?>
            </div>
            <div class="col-md-12">
                <div class="user-content">
                    <?php
                    if($error_message != '') {
                        echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$error_message."</div>";
                    }
                    if($success_message != '') {
                        echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>".$success_message."</div>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h3><?php echo LANG_VALUE_86; ?></h3>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_102; ?></label>
                                    <input type="text" class="form-control" name="cust_b_name" value="<?php echo $_SESSION['customer']['cust_b_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_103; ?></label>
                                    <input type="text" class="form-control" name="cust_b_cname" value="<?php echo $_SESSION['customer']['cust_b_cname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_104; ?></label>
                                    <input type="text" class="form-control" name="cust_b_phone" value="<?php echo $_SESSION['customer']['cust_b_phone']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_106; ?></label>
                                    <select name="cust_b_country" class="form-control">
                                        <?php
                                        $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                            ?>
                                            <option value="<?php echo $row['country_id']; ?>" <?php if($row['country_id'] == $_SESSION['customer']['cust_b_country']) {echo 'selected';} ?>><?php echo $row['country_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_105; ?></label>
                                    <textarea name="cust_b_address" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $_SESSION['customer']['cust_b_address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_107; ?></label>
                                    <input type="text" class="form-control" name="cust_b_city" value="<?php echo $_SESSION['customer']['cust_b_city']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_108; ?></label>
                                    <input type="text" class="form-control" name="cust_b_state" value="<?php echo $_SESSION['customer']['cust_b_state']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_109; ?></label>
                                    <input type="text" class="form-control" name="cust_b_zip" value="<?php echo $_SESSION['customer']['cust_b_zip']; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo LANG_VALUE_87; ?></h3>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_102; ?></label>
                                    <input type="text" class="form-control" name="cust_s_name" value="<?php echo $_SESSION['customer']['cust_s_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_103; ?></label>
                                    <input type="text" class="form-control" name="cust_s_cname" value="<?php echo $_SESSION['customer']['cust_s_cname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_104; ?></label>
                                    <input type="text" class="form-control" name="cust_s_phone" value="<?php echo $_SESSION['customer']['cust_s_phone']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_106; ?></label>
                                    <select name="cust_s_country" class="form-control">
                                        <?php
                                        $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                            ?>
                                            <option value="<?php echo $row['country_id']; ?>" <?php if($row['country_id'] == $_SESSION['customer']['cust_s_country']) {echo 'selected';} ?>><?php echo $row['country_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_105; ?></label>
                                    <textarea name="cust_s_address" class="form-control" cols="30" rows="10" style="height:100px;"><?php echo $_SESSION['customer']['cust_s_address']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_107; ?></label>
                                    <input type="text" class="form-control" name="cust_s_city" value="<?php echo $_SESSION['customer']['cust_s_city']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_108; ?></label>
                                    <input type="text" class="form-control" name="cust_s_state" value="<?php echo $_SESSION['customer']['cust_s_state']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo LANG_VALUE_109; ?></label>
                                    <input type="text" class="form-control" name="cust_s_zip" value="<?php echo $_SESSION['customer']['cust_s_zip']; ?>">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="<?php echo LANG_VALUE_5; ?>" name="form1">
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>