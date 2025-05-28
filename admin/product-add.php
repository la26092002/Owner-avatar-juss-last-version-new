<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;

    if(empty($_POST['tcat_id'])) {
        $valid = 0;
        $error_message .= "Vous devez sélectionner une catégorie de niveau supérieur<br>";
    }

    if(empty($_POST['mcat_id'])) {
        $valid = 0;
        $error_message .= "Vous devez sélectionner une catégorie de niveau intermédiaire<br>";
    }

    if(empty($_POST['p_name'])) {
        $valid = 0;
        $error_message .= "Le nom du produit ne peut pas être vide<br>";
    }

    if(empty($_POST['p_current_price'])) {
        $valid = 0;
        $error_message .= "Le prix actuel ne peut pas être vide<br>";
    }

    if(empty($_POST['p_qty'])) {
        $valid = 0;
        $error_message .= "La quantité ne peut pas être vide<br>";
    }

    $path = $_FILES['p_featured_photo']['name'];
    $path_tmp = $_FILES['p_featured_photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'Vous devez télécharger un fichier jpg, jpeg, gif ou png<br>';
        }
    } else {
        $valid = 0;
        $error_message .= 'Vous devez avoir à sélectionner une photo en vedette<br>';
    }

    if($valid == 1) {
        $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product'");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row) {
            $ai_id=$row[10];
        }

        // Handle product photos with colors
        if(isset($_FILES['photo']['name']) && is_array($_FILES['photo']['name'])) {
            $photoCount = count($_FILES['photo']['name']);
            for ($i = 0; $i < $photoCount; $i++) {
                $fileName = $_FILES['photo']['name'][$i];
                $tmpName = $_FILES['photo']['tmp_name'][$i];
                $colorId = $_POST['photo_color'][$i] ?? null;

                if (!empty($fileName)) {
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    if(in_array(strtolower($ext), ['jpg', 'png', 'jpeg', 'gif'])) {
                        $uploadDir = '../assets/uploads/product_photos/';
                        $uniqueName = 'product-photo-'.$ai_id.'-'.time().'-'.$i.'.'.$ext;
                        $uploadPath = $uploadDir . $uniqueName;

                        if (move_uploaded_file($tmpName, $uploadPath)) {
                            $stmt = $pdo->prepare("INSERT INTO tbl_product_photo (photo, p_id, color_id) VALUES (?, ?, ?)");
                            $stmt->execute([$uniqueName, $ai_id, $colorId ?: null]);
                            
                            // Also add to product colors if not already present
                            if ($colorId) {
                                $check = $pdo->prepare("SELECT * FROM tbl_product_color WHERE p_id = ? AND color_id = ?");
                                $check->execute([$ai_id, $colorId]);
                                if (!$check->fetch()) {
                                    $stmt = $pdo->prepare("INSERT INTO tbl_product_color (color_id, p_id) VALUES (?, ?)");
                                    $stmt->execute([$colorId, $ai_id]);
                                }
                            }
                        }
                    }
                }
            }
        }

        $final_name = 'product-featured-'.$ai_id.'-'.time().'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

        //Saving data into the main table tbl_product
        $statement = $pdo->prepare("INSERT INTO tbl_product(
                                    p_name,
                                    p_old_price,
                                    p_current_price,
                                    p_qty,
                                    p_featured_photo,
                                    p_description,
                                    p_short_description,
                                    p_feature,
                                    p_condition,
                                    p_return_policy,
                                    p_total_view,
                                    p_is_featured,
                                    p_is_active,
                                    mcat_id
                                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                                    $_POST['p_name'],
                                    $_POST['p_old_price'],
                                    $_POST['p_current_price'],
                                    $_POST['p_qty'],
                                    $final_name,
                                    $_POST['p_description'],
                                    $_POST['p_short_description'],
                                    $_POST['p_feature'],
                                    $_POST['p_condition'],
                                    $_POST['p_return_policy'],
                                    0,
                                    $_POST['p_is_featured'],
                                    $_POST['p_is_active'],
                                    $_POST['mcat_id']
                                ));

        if (!empty($_POST['size'])) {
            foreach ($_POST['size'] as $value) {
                $statement = $pdo->prepare("INSERT INTO tbl_product_size (size_id,p_id) VALUES (?,?)");
                $statement->execute(array($value, $ai_id));
            }
        }

        $success_message = 'Le produit a été ajouté avec succès.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Product</h1>
    </div>
    <div class="content-header-right">
        <a href="product.php" class="btn btn-primary btn-sm">Tout Voir</a>
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
                            <label for="" class="col-sm-3 control-label">Nom de la Catégorie de Niveau Supérieur <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="tcat_id" class="form-control select2 top-cat">
                                    <option value="">Sélectionnez La Catégorie de Niveau Supérieur</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_top_category ORDER BY tcat_name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);    
                                    foreach ($result as $row) {
                                        ?>
                                        <option value="<?php echo $row['tcat_id']; ?>"><?php echo $row['tcat_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Nom de la Catégorie de Niveau Intermédiaire <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="mcat_id" class="form-control select2 mid-cat">
                                    <option value="">Sélectionnez La Catégorie de Niveau Intermédiaire</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Nom de Produit <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_name" class="form-control">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Ancien Prix <br><span style="font-size:10px;font-weight:normal;">(EUR)</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_old_price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Prix Actuel <span>*</span><br><span style="font-size:10px;font-weight:normal;">(EUR)</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_current_price" class="form-control">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Quantité <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_qty" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Sélectionnez la Taille</label>
                            <div class="col-sm-4">
                                <select name="size[]" class="form-control select2" multiple="multiple">
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_size ORDER BY size_id ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);            
                                    foreach ($result as $row) {
                                        ?>
                                        <option value="<?php echo $row['size_id']; ?>"><?php echo $row['size_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Photo Sélectionnée <span>*</span></label>
                            <div class="col-sm-4" style="padding-top:4px;">
                                <input type="file" name="p_featured_photo">
                            </div>
                        </div>
                        
                        <!-- Enhanced Photo Management Section -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Autres Photos avec Couleurs</label>
                            <div class="col-sm-6">
                                <table id="photoTable">
                                    <tbody>
                                        <tr>
                                            <td style="padding-bottom:10px;">
                                                <div style="display: flex; gap: 10px;">
                                                    <input type="file" name="photo[]" class="form-control" style="flex: 2;">
                                                    <select name="photo_color[]" class="form-control select2" style="flex: 1;" required>
                                                        <option value="">Sélectionnez Couleur</option>
                                                        <?php 
                                                        $colors = $pdo->query("SELECT * FROM tbl_color ORDER BY color_name")->fetchAll();
                                                        foreach ($colors as $c): ?>
                                                            <option value="<?= $c['color_id'] ?>"><?= htmlspecialchars($c['color_name']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <button type="button" class="btn btn-danger btn-xs remove-photo">X</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="button" id="addPhoto" class="btn btn-success btn-xs">Ajouter Photo</button>
                                <button type="button" id="previewPhotos" class="btn btn-info btn-xs" style="margin-left: 10px;">Aperçu Photos</button>
                                <div id="photoPreview" style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;"></div>
                            </div>
                        </div>
                        <!-- End Enhanced Photo Management Section -->

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea name="p_description" class="form-control" cols="30" rows="10" id="editor1"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Brève Description</label>
                            <div class="col-sm-8">
                                <textarea name="p_short_description" class="form-control" cols="30" rows="10" id="editor2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Caractéristiques</label>
                            <div class="col-sm-8">
                                <textarea name="p_feature" class="form-control" cols="30" rows="10" id="editor3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Conditions Générales</label>
                            <div class="col-sm-8">
                                <textarea name="p_condition" class="form-control" cols="30" rows="10" id="editor4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Politique de Retour</label>
                            <div class="col-sm-8">
                                <textarea name="p_return_policy" class="form-control" cols="30" rows="10" id="editor5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Est En Vedette?</label>
                            <div class="col-sm-8">
                                <select name="p_is_featured" class="form-control" style="width:auto;">
                                    <option value="0">No</option>
                                    <option value="1">Oui</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Est Active?</label>
                            <div class="col-sm-8">
                                <select name="p_is_active" class="form-control" style="width:auto;">
                                    <option value="0">No</option>
                                    <option value="1">Oui</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Ajouter un Produit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
// Store color options HTML
const colorOptions = `<?php
    $options = '<option value="">Sélectionnez Couleur</option>';
    foreach ($colors as $c) {
        $id = htmlspecialchars($c['color_id']);
        $name = htmlspecialchars($c['color_name']);
        $options .= "<option value=\'{$id}\'>{$name}</option>";
    }
    echo $options;
?>`;

document.addEventListener('DOMContentLoaded', function () {
    const photoTable = document.querySelector('#photoTable tbody');
    const addPhotoBtn = document.getElementById('addPhoto');
    const previewBtn = document.getElementById('previewPhotos');
    const previewDiv = document.getElementById('photoPreview');

    addPhotoBtn.addEventListener('click', function () {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td style="padding-bottom:10px;">
                <div style="display: flex; gap: 10px;">
                    <input type="file" name="photo[]" class="form-control" style="flex: 2;" required>
                    <select name="photo_color[]" class="form-control select2" style="flex: 1;" required>
                        ${colorOptions}
                    </select>
                    <button type="button" class="btn btn-danger btn-xs remove-photo">X</button>
                </div>
            </td>
        `;
        photoTable.appendChild(newRow);
        $('.select2').select2(); // Initialize select2 on new elements
    });

    photoTable.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-photo')) {
            const row = e.target.closest('tr');
            row.remove();
        }
    });

    previewBtn.addEventListener('click', function () {
        const rows = document.querySelectorAll('#photoTable tbody tr');
        previewDiv.innerHTML = '';

        rows.forEach(row => {
            const fileInput = row.querySelector('input[type="file"]');
            const colorSelect = row.querySelector('select');
            const file = fileInput.files[0];
            const colorId = colorSelect.value;
            const colorName = colorSelect.options[colorSelect.selectedIndex]?.text || 'Non sélectionné';

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const image = document.createElement('img');
                    image.src = e.target.result;
                    image.style.maxWidth = '150px';
                    image.style.maxHeight = '150px';
                    image.style.border = '1px solid #ccc';
                    image.style.borderRadius = '4px';
                    image.style.padding = '3px';

                    const info = document.createElement('p');
                    info.textContent = 'Couleur: ' + colorName;
                    info.style.margin = '5px 0';
                    info.style.fontSize = '12px';

                    const container = document.createElement('div');
                    container.style.display = 'flex';
                    container.style.flexDirection = 'column';
                    container.style.alignItems = 'center';
                    container.style.margin = '10px';
                    container.appendChild(image);
                    container.appendChild(info);

                    previewDiv.appendChild(container);
                };
                reader.readAsDataURL(file);
            }
        });
    });
});
</script>

<?php require_once('footer.php'); ?>