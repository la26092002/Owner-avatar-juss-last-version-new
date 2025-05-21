<?php require_once('header.php'); ?>

<?php
// Initialize variables
$error_message = '';
$success_message = '';

if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($total == 0) {
        header('location: logout.php');
        exit;
    }
}

// Get current service data
$statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $title = $row['title'];
    $content = $row['content'];
    $photo = $row['photo'];
}

if(isset($_POST['form1'])) {
    $valid = 1;

    // Validate title
    if(empty($_POST['title'])) {
        $valid = 0;
        $error_message .= 'Le titre ne peut pas être vide<br>';
    }

    // Validate content
    if(empty($_POST['content'])) {
        $valid = 0;
        $error_message .= 'Le contenu ne peut pas être vide<br>';
    }

    // Validate photo upload if a new one is provided
    if(!empty($_FILES['photo']['name'])) {
        // Check for upload errors
        if($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            $valid = 0;
            $error_message .= 'Erreur lors du téléchargement du fichier<br>';
        } else {
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
            
            // Check file extension
            if(!in_array($ext, $allowed_exts)) {
                $valid = 0;
                $error_message .= 'Vous devez télécharger un fichier jpg, jpeg, gif ou png<br>';
            }
            
            // Check file size (2MB max)
            if($_FILES['photo']['size'] > 2097152) {
                $valid = 0;
                $error_message .= 'Le fichier ne doit pas dépasser 2MB<br>';
            }
            
            // Verify the file is actually an image
            $check = getimagesize($_FILES['photo']['tmp_name']);
            if($check === false) {
                $valid = 0;
                $error_message .= 'Le fichier n\'est pas une image valide<br>';
            }
        }
    }

    if($valid == 1) {
        try {
            // Begin transaction
            $pdo->beginTransaction();
            
            if(!empty($_FILES['photo']['name'])) {
                // Delete old photo
                if(file_exists('../assets/uploads/'.$photo)) {
                    unlink('../assets/uploads/'.$photo);
                }
                
                // Generate new unique filename
                $unique_id = uniqid();
                $final_name = 'service-'.$unique_id.'.'.$ext;
                $target_path = '../assets/uploads/'.$final_name;
                
                // Move uploaded file
                if(!move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
                    throw new Exception('Erreur lors de l\'enregistrement de la nouvelle image');
                }
                
                // Update with new photo
                $statement = $pdo->prepare("UPDATE tbl_service SET title=?, content=?, photo=? WHERE id=?");
                $statement->execute([
                    htmlspecialchars($_POST['title']),
                    htmlspecialchars($_POST['content']),
                    $final_name,
                    $_REQUEST['id']
                ]);
            } else {
                // Update without changing photo
                $statement = $pdo->prepare("UPDATE tbl_service SET title=?, content=? WHERE id=?");
                $statement->execute([
                    htmlspecialchars($_POST['title']),
                    htmlspecialchars($_POST['content']),
                    $_REQUEST['id']
                ]);
            }
            
            // Commit transaction
            $pdo->commit();
            
            $success_message = 'Le service est mis à jour avec succès!';
            
            // Refresh the data
            $statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
            $statement->execute(array($_REQUEST['id']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $title = $row['title'];
                $content = $row['content'];
                $photo = $row['photo'];
            }
        } catch(Exception $e) {
            // Rollback transaction on error
            $pdo->rollBack();
            $error_message = 'Une erreur est survenue: '.$e->getMessage();
        }
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Modifier le Service</h1>
    </div>
    <div class="content-header-right">
        <a href="service.php" class="btn btn-primary btn-sm">Tout Voir</a>
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
                <input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Titre <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="title" value="<?php echo htmlspecialchars($title); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Contenu <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="content" style="height:140px;"><?php echo htmlspecialchars($content); ?></textarea>
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Photo Existante</label>
                            <div class="col-sm-9" style="padding-top:5px">
                                <?php if($photo): ?>
                                <img src="../assets/uploads/<?php echo $photo; ?>" alt="Service Photo" style="width:180px;">
                                <?php else: ?>
                                <p>Aucune photo disponible</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nouvelle Photo </label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" name="photo" accept="image/jpeg,image/png,image/gif">(Seuls les formats jpg, jpeg, gif et png sont autorisés, max 2MB)
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Mettre à jour</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>