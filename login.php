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
<style>
body {
    background: linear-gradient(135deg, #f596da, #b0ecf1);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="col-md-3 mx-auto card p-4 shadow" style="width: 370px">

<h3 class="text-center">Login</h3>

<?php echo $msg; ?>

<form method="POST">

<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>

<div class="input-group mb-2">
<input type="password" name="password" id="pass" class="form-control" placeholder="Password">
<button type="button" class="btn btn-outline-secondary" onclick="togglePass()">👁</button>
</div>
<br>
<button class="btn btn-success w-100 rounded-3" name="login">Login</button>

</form>
<p class="text-center mt-2">
Don't have an account? <a href="register.php">Register Here</a>
</p>
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