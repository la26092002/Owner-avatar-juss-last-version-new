<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
    $error_message = '';
    $success_message = '';

    if(empty($_POST['color_name'])) {
        $valid = 0;
        $error_message .= "Color Name can not be empty<br>";
    } else {
    	// Duplicate Color checking
    	$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_name=?");
    	$statement->execute(array($_POST['color_name']));
    	$total = $statement->rowCount();
    	if($total) {
    		$valid = 0;
        	$error_message .= "Color Name already exists<br>";
    	}
    }

    // Check for image upload error
    if(!empty($_FILES['color_img']['name'])) {
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['color_img']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if(!in_array($file_ext, $allowed_ext)) {
            $valid = 0;
            $error_message .= "Only JPG, JPEG, PNG, GIF, and WEBP files are allowed<br>";
        }
    }

    if($valid == 1) {

        // Handle image upload
        $final_name = '';
        if(!empty($_FILES['color_img']['name'])) {
            $path = $_FILES['color_img']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $final_name = 'color_' . time() . '.' . $ext;

            // Ensure upload directory exists
            $upload_path = '../assets/uploads/colors/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            move_uploaded_file($_FILES['color_img']['tmp_name'], $upload_path . $final_name);
        }

        // Insert into tbl_color
        $statement = $pdo->prepare("INSERT INTO tbl_color (color_name, color_img) VALUES (?, ?)");
        $statement->execute(array($_POST['color_name'], $final_name));

    	$success_message = 'Color is added successfully.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Color</h1>
	</div>
	<div class="content-header-right">
		<a href="color.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-12">

			<?php if($error_message): ?>
			<div class="callout callout-danger">
				<p><?php echo $error_message; ?></p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
				<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Color Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="color_name">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Color Image</label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="color_img" accept="image/*">
							</div>
						</div>

						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>

			</form>

		</div>
	</div>
</section>

<?php require_once('footer.php'); ?>
