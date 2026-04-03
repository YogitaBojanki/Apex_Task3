<?php include "config.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
$id = $_GET['id'];

$conn->query("DELETE FROM users WHERE id=$id");

header("Location: dashboard.php");
?>