<?php require_once('header.php'); ?>

<?php
$colors = $pdo->query("SELECT * FROM tbl_color ORDER BY color_name")->fetchAll();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $photoCount = count($_FILES['photo']['name']);
    for ($i = 0; $i < $photoCount; $i++) {
        $fileName = $_FILES['photo']['name'][$i];
        $tmpName = $_FILES['photo']['tmp_name'][$i];
        $colorId = $_POST['color'][$i] ?? null;

        if (!empty($fileName)) {
            $uploadDir = '../assets/uploads/product_photos/';
            $uniqueName = time() . '_' . basename($fileName);
            $uploadPath = $uploadDir . $uniqueName;

            if (move_uploaded_file($tmpName, $uploadPath)) {
                $stmt = $pdo->prepare("INSERT INTO tbl_product_photo (photo, p_id, color_id) VALUES (?, ?, ?)");
                $stmt->execute([$uniqueName, 14, $colorId ?: null]);
            }
        }
    }

    echo "<div class='alert alert-success'>Photos uploaded successfully!</div>";
}
?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-3 control-label">Product Photos</label>
        <div class="col-sm-6">
            <table id="photoTable">
                <tbody>
                    <tr>
                        <td style="padding-bottom:10px;">
                            <input type="file" name="photo[]" class="form-control" style="width:60%; display:inline-block;">
                            <select name="color[]" class="form-control" style="width:30%; display:inline-block;">
                                <option value="">Select Color</option>
                                <?php foreach ($colors as $c): ?>
                                    <option value="<?= $c['color_id'] ?>"><?= htmlspecialchars($c['color_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="btn btn-danger btn-xs remove-photo" style="display:inline-block;">X</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" id="addPhoto" class="btn btn-success btn-xs">Add Photo</button>
            <button type="button" id="previewPhotos" class="btn btn-info btn-xs" style="margin-left: 10px;">Preview Photos</button>
            <div id="photoPreview" style="margin-top: 15px;"></div>

            <!-- Submit Button -->
            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary">Submit All Photos</button>
            </div>
        </div>
    </div>
</form>

<!-- JavaScript -->
<script>
const colorOptions = <?php
    $options = '<option value="">Select Color</option>';
    foreach ($colors as $c) {
        $id = htmlspecialchars($c['color_id']);
        $name = htmlspecialchars($c['color_name']);
        $options .= "<option value='{$id}'>{$name}</option>";
    }
    echo json_encode($options);
?>;

document.addEventListener('DOMContentLoaded', function () {
    const photoTable = document.querySelector('#photoTable tbody');
    const addPhotoBtn = document.getElementById('addPhoto');
    const previewBtn = document.getElementById('previewPhotos');
    const previewDiv = document.getElementById('photoPreview');

    addPhotoBtn.addEventListener('click', function () {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td style="padding-bottom:10px;">
                <input type="file" name="photo[]" class="form-control" style="width:60%; display:inline-block;">
                <select name="color[]" class="form-control" style="width:30%; display:inline-block;">
                    ${colorOptions}
                </select>
                <button type="button" class="btn btn-danger btn-xs remove-photo" style="display:inline-block;">X</button>
            </td>
        `;
        photoTable.appendChild(newRow);
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

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const image = document.createElement('img');
                    image.src = e.target.result;
                    image.style.maxWidth = '100px';
                    image.style.marginRight = '10px';
                    image.style.border = '1px solid #ccc';
                    image.style.borderRadius = '4px';
                    image.style.padding = '3px';

                    const info = document.createElement('p');
                    info.textContent = 'Color ID: ' + (colorId || 'Not selected');

                    const container = document.createElement('div');
                    container.style.display = 'inline-block';
                    container.style.textAlign = 'center';
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
