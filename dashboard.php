<?php include "config.php"; ?>

<?php
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<h2>Welcome <?php echo $_SESSION['user']['name']; ?></h2>

<a href="logout.php">Logout</a>
<a href="upload.php">Upload Profile Pic</a>

<h3>Users List</h3>

<?php
$result = $conn->query("SELECT * FROM users");

while($row = $result->fetch_assoc()) {
?>
    <p>
        <?php echo $row['name']; ?>
        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
    </p>
<?php } ?>