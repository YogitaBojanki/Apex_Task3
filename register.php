<?php
include("config.php");
$message = "";

if(isset($_POST['register'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if(empty($name) || empty($email) || empty($password)){
        $message = "<div class='alert alert-danger'>All fields are required</div>";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message = "<div class='alert alert-danger'>Invalid email format</div>";
    } elseif(strlen($password) < 6){
        $message = "<div class='alert alert-danger'>Password must be at least 6 characters</div>";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,'user')");
        $stmt->bind_param("sss",$name,$email,$hash);

        if($stmt->execute()){
            $message = "<div class='alert alert-success'>Registration successful</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error occurred</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="col-md-4 mx-auto card p-4 shadow">

<h3 class="text-center mb-3">Register</h3>

<?php echo $message; ?>

<form method="POST" onsubmit="return validateForm()">

<input type="text" name="name" id="name" class="form-control mb-2" placeholder="Name">
<small id="nameError" class="text-danger"></small>

<input type="email" name="email" id="email" class="form-control mb-2" placeholder="Email">
<small id="emailError" class="text-danger"></small>

<div class="input-group mb-2">
<input type="password" name="password" id="password" class="form-control" placeholder="Password">
<button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁</button>
</div>
<small id="passError" class="text-danger"></small>

<button class="btn btn-primary w-100" name="register">Register</button>

</form>

<p class="text-center mt-2">
<a href="login.php">Already have account?</a>
</p>

</div>
</div>

<script>
function togglePassword(){
    let p = document.getElementById("password");
    p.type = (p.type === "password") ? "text" : "password";
}

function validateForm(){
    let valid = true;

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let pass = document.getElementById("password").value;

    document.getElementById("nameError").innerText = "";
    document.getElementById("emailError").innerText = "";
    document.getElementById("passError").innerText = "";

    if(name === ""){
        document.getElementById("nameError").innerText = "Name required";
        valid = false;
    }

    if(!email.includes("@")){
        document.getElementById("emailError").innerText = "Valid email required";
        valid = false;
    }

    if(pass.length < 6){
        document.getElementById("passError").innerText = "Min 6 characters";
        valid = false;
    }

    return valid;
}
</script>

</body>
</html>