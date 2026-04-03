<?php
include("config.php");
// Check login
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit(); 
}

$user = $_SESSION['user'];

// Fetch users
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">User Dashboard</span>
    <span class="text-white">
        Welcome, <?= $user['name']; ?> (<?= $user['role']; ?>)
    </span>
    <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</nav>
<br>
<!-- Role Badge -->
<p>
    Role: 
    <span class="badge bg-<?php echo ($user['role']=='admin') ? 'primary' : 'secondary'; ?>">
        <?php echo $user['role']; ?>
    </span>
</p>

<!-- Table -->
<div class="card shadow p-4 rounded-4">
    <h4 class="mb-3 text-primary">User Management</h4>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Image</th>
                <?php if($user['role'] == 'admin'){ ?>
                <th>Action</th>
                <?php } ?>
            </tr>
        </thead>

        <tbody>
        <?php while($row = $result->fetch_assoc()){ ?>
            <tr class="text-center">
                <td><?= $row['id']; ?></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                    <span class="badge bg-info"><?= $row['role']; ?></span>
                </td>

                <td>
                <?php if($row['image']){ ?>
                    <img src="uploads/<?= $row['image']; ?>" width="60" height="60" class="rounded-circle">
                <?php } else { ?>
                    <span class="text-muted">No Image</span>
                <?php } ?>
                </td>

                <?php if($user['role'] == 'admin'){ ?>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                    <a href="delete.php?id=<?= $row['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirmDelete()">Delete</a>
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</div>

<script>
function confirmDelete(){
    return confirm("Are you sure you want to delete this user?");
}
</script>

</body>
</html>