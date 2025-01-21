<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['photo'])) {
        $file = $_FILES['photo'];
        $uploadPath = __DIR__ . '/uploads/' . $file['name'];
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            echo "Fichier téléversé avec succès : " . $uploadPath;
        } else {
            echo "Échec du téléversement.";
        }
    } else {
        echo "Aucun fichier détecté.";
    }
}
?>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="photo">
    <button type="submit">Téléverser</button>
</form>
