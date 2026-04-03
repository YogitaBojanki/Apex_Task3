<?php
include("config.php");

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $res->fetch_assoc();

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Image upload
    if($_FILES['image']['name'] != ""){
        $img = time()."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$img);

        $conn->query("UPDATE users SET name='$name', email='$email', image='$img' WHERE id=$id");
    } else {
        $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
    }

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="col-md-4 mx-auto card p-4 shadow">

<h4>Edit User</h4>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" class="form-control mb-2" value="<?php echo $user['name']; ?>">

<input type="email" name="email" class="form-control mb-2" value="<?php echo $user['email']; ?>">

<input type="file" name="image" class="form-control mb-2">

<?php if($user['image']){ ?>
<img src="uploads/<?php echo $user['image']; ?>" width="80">
<?php } ?>

<button class="btn btn-primary w-100" name="update">Update</button>

</form>

</div>
</div>

</body>
</html>