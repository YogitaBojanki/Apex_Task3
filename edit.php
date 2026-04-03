<?php include "config.php"; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();
?>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $user['name']; ?>"><br>
    <button name="update">Update</button>
</form>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
if(isset($_POST['update'])) {
    $name = $_POST['name'];

    $stmt = $conn->prepare("UPDATE users SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>