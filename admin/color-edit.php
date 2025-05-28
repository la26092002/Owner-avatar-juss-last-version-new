<?php require_once('header.php'); ?>

<?php
// Initialize variables
$error_message = '';
$success_message = '';
$color_name = '';
$color_img = '';

if (!isset($_GET['id'])) {
    header('location: logout.php');
    exit;
}

$id = $_GET['id'];

// Fetch existing color data
$statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_id = ?");
$statement->execute([$id]);
$color = $statement->fetch(PDO::FETCH_ASSOC);

if (!$color) {
    header('location: logout.php');
    exit;
} else {
    $color_name = $color['color_name'];
    $color_img = $color['color_img'] ?? '';
}

if (isset($_POST['form1'])) {
    $input_color_name = trim($_POST['color_name']);

    if (empty($input_color_name)) {
        $error_message .= "Color Name cannot be empty.<br>";
    } else {
        // Check for duplicate color name
        $statement = $pdo->prepare("SELECT * FROM tbl_color WHERE color_name = ? AND color_id != ?");
        $statement->execute([$input_color_name, $id]);
        if ($statement->rowCount() > 0) {
            $error_message .= "Color name already exists.<br>";
        }
    }

    // Image upload handling
    if (!empty($_FILES['color_img']['name'])) {
        $file_name = $_FILES['color_img']['name'];
        $file_tmp = $_FILES['color_img']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($file_ext, $allowed_exts)) {
            $error_message .= "Invalid image file type. Allowed: jpg, jpeg, png, gif.<br>";
        } else {
            $new_image_name = 'color_' . time() . '.' . $file_ext;
            $upload_path = '../assets/uploads/colors/' . $new_image_name;
            move_uploaded_file($file_tmp, $upload_path);

            // Optionally delete old image
            if (!empty($color_img) && file_exists('../assets/uploads/colors/' . $color_img)) {
                unlink('../assets/uploads/colors/' . $color_img);
            }

            $color_img = $new_image_name;
        }
    }

    if (empty($error_message)) {
        $statement = $pdo->prepare("UPDATE tbl_color SET color_name = ?, color_img = ? WHERE color_id = ?");
        $statement->execute([$input_color_name, $color_img, $id]);

        $success_message = "Color has been updated successfully.";
        $color_name = $input_color_name;
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Color</h1>
    </div>
    <div class="content-header-right">
        <a href="color.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if (!empty($error_message)): ?>
                <div class="callout callout-danger"><p><?php echo $error_message; ?></p></div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="callout callout-success"><p><?php echo $success_message; ?></p></div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Color Name <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="color_name" value="<?php echo htmlspecialchars($color_name); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Color Image</label>
                            <div class="col-sm-4">
                                <input type="file" name="color_img">
                                <?php if (!empty($color_img)): ?>
                                    <p><img src="../assets/uploads/colors/<?php echo $color_img; ?>" alt="Color Image" width="100"></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-success" name="form1">Update</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
