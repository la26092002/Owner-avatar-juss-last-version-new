<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['size_name'])) {
        $valid = 0;
        $error_message .= "Le nom de la taille ne peut pas être vide<br>";
    } else {
		// Duplicate Size checking
    	// current size name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_size_name = $row['size_name'];
		}

		$statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_name=? and size_name!=?");
    	$statement->execute(array($_POST['size_name'],$current_size_name));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= 'Le nom de la taille existe déjà<br>';
    	}
    }

    if($valid == 1) {    	
		// updating into the database
		$statement = $pdo->prepare("UPDATE tbl_size SET size_name=? WHERE size_id=?");
		$statement->execute(array($_POST['size_name'],$_REQUEST['id']));

    	$success_message = 'La taille est mise à jour avec succès.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_size WHERE size_id=?");
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
		<h1>Edit Size</h1>
	</div>
	<div class="content-header-right">
		<a href="size.php" class="btn btn-primary btn-sm">Tout Voir</a>
	</div>
</section>


<?php							
foreach ($result as $row) {
	$size_name = $row['size_name'];
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

        <form class="form-horizontal" action="" method="post">

        <div class="box box-info">

            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Nom de la Taille <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="size_name" value="<?php echo $size_name; ?>">
                    </div>
                </div>
                <div class="form-group">
                	<label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-success pull-left" name="form1">Mise à Jour</button>
                    </div>
                </div>

            </div>

        </div>

        </form>



    </div>
  </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Supprimer la Confirmation</h4>
            </div>
            <div class="modal-body">
			Voulez-vous vraiment supprimer cet élément?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a class="btn btn-danger btn-ok">Supprimer</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>