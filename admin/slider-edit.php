<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.'.$ext);
        if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $error_message .= 'Vous devez télécharger un fichier jpg, jpeg, gif ou png<br>';
        }
    }

    if($valid == 1) {
        try {
            if($path != '') {
                // Delete old photo if it exists
                if(file_exists('../assets/uploads/'.$_POST['current_photo']) && $_POST['current_photo'] != '') {
                    if(!unlink('../assets/uploads/'.$_POST['current_photo'])) {
                        throw new Exception("Failed to delete old image");
                    }
                }

                // Upload new photo
                $final_name = 'slider-'.$_REQUEST['id'].'.'.$ext;
                if(!move_uploaded_file($path_tmp, '../assets/uploads/'.$final_name)) {
                    throw new Exception("Failed to upload new image");
                }

                // Update with photo
                $statement = $pdo->prepare("UPDATE tbl_slider SET photo=?, heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?");
                $statement->execute(array(
                    $final_name,
                    $_POST['heading'],
                    $_POST['content'],
                    $_POST['button_text'],
                    $_POST['button_url'],
                    $_POST['position'],
                    $_REQUEST['id']
                ));
            } else {
                // Update without changing photo
                $statement = $pdo->prepare("UPDATE tbl_slider SET heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?");
                $statement->execute(array(
                    $_POST['heading'],
                    $_POST['content'],
                    $_POST['button_text'],
                    $_POST['button_url'],
                    $_POST['position'],
                    $_REQUEST['id']
                ));
            }

            $success_message = 'Le curseur est mis à jour avec succès!';
        } catch(Exception $e) {
            $valid = 0;
            $error_message = 'Erreur: '.$e->getMessage();
        }
    }
}
?>

[... rest of your existing HTML/PHP code ...]

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Modifier le Curseur</h1>
	</div>
	<div class="content-header-right">
		<a href="slider.php" class="btn btn-primary btn-sm">Tout Voir</a>
	</div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$photo       = $row['photo'];
	$heading     = $row['heading'];
	$content     = $row['content'];
	$button_text = $row['button_text'];
	$button_url  = $row['button_url'];
	$position    = $row['position'];
}
?>

<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php if($error_message): ?>
			<div class="callout callout-danger">
				<p>
				<?php echo $error_message; ?>
				</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
				<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Photo Existante</label>
							<div class="col-sm-9" style="padding-top:5px">
								<img src="../assets/uploads/<?php echo $photo; ?>" alt="Slider Photo" style="width:400px;">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Photo </label>
							<div class="col-sm-6" style="padding-top:5px">
								<input type="file" name="photo">(Seuls les formats jpg, jpeg, gif et png sont autorisés)
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Rubrique </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="heading" value="<?php echo $heading; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Contenu </label>
							<div class="col-sm-6">
								<textarea class="form-control" name="content" style="height:140px;"><?php echo $content; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Texte du Bouton </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="button_text" value="<?php echo $button_text; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">URL Bouton </label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="button_url" value="<?php echo $button_url; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Position </label>
							<div class="col-sm-6">
								<select name="position" class="form-control">
									<option value="Left" <?php if($position == 'Left') {echo 'selected';} ?>>Gauche</option>
									<option value="Center" <?php if($position == 'Center') {echo 'selected';} ?>>Centre</option>
									<option value="Right" <?php if($position == 'Right') {echo 'selected';} ?>>Droite</option>
								</select>
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