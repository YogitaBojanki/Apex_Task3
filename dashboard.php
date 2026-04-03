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
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Dashboard</h3>
    <div>
        <span class="me-3">Welcome, <?php echo $user['name']; ?></span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</div>

<!-- Role Badge -->
<p>
    Role: 
    <span class="badge bg-<?php echo ($user['role']=='admin') ? 'primary' : 'secondary'; ?>">
        <?php echo $user['role']; ?>
    </span>
</p>

<!-- Table -->
<div class="card shadow p-3">
    <h5>User List</h5>

    <table class="table table-bordered table-hover mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>

                <?php if($user['role'] == 'admin'){ ?>
                <th>Action</th>
                <?php } ?>

            </tr>
        </thead>

        <tbody>
        <?php while($row = $result->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>

                <?php if($user['role'] == 'admin'){ ?>
                <td>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" 
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