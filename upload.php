<?php include "config.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<form method="POST" enctype="multipart/form-data">
    Select Image:
    <input type="file" name="image"><br>
    <button name="upload">Upload</button>
</form>

<?php
if(isset($_POST['upload'])) {
    $file = $_FILES['image'];

    $filename = $file['name'];
    $tmp = $file['tmp_name'];

    $path = "uploads/" . $filename;

    move_uploaded_file($tmp, $path);

    $id = $_SESSION['user']['id'];

    $stmt = $conn->prepare("UPDATE users SET profile_pic=? WHERE id=?");
    $stmt->bind_param("si", $path, $id);
    $stmt->execute();

    echo "Uploaded!";
}
?>