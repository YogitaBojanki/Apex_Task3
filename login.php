<?php
include("config.php");
$msg="";

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $res=$conn->query("SELECT * FROM users WHERE email='$email'");
    $user=$res->fetch_assoc();

    if($user && password_verify($password,$user['password'])){
        $_SESSION['user']=$user;

        if($user['role']=="admin"){
            header("Location: dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
    } else {
        $msg="<div class='alert alert-danger'>Invalid login</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="col-md-4 mx-auto card p-4 shadow">

<h3 class="text-center">Login</h3>

<?php echo $msg; ?>

<form method="POST">

<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>

<div class="input-group mb-2">
<input type="password" name="password" id="pass" class="form-control" placeholder="Password">
<button type="button" class="btn btn-outline-secondary" onclick="togglePass()">👁</button>
</div>

<button class="btn btn-success w-100" name="login">Login</button>

</form>

</div>
</div>

<script>
function togglePass(){
    let p=document.getElementById("pass");
    p.type = (p.type==="password")?"text":"password";
}
</script>

</body>
</html>