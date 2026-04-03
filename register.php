<?php
include("config.php");
$message = "";

if(isset($_POST['register'])){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // EMPTY CHECK
    if(empty($name) || empty($email) || empty($password)){
        $message = "<div class='alert alert-danger'>All fields are required</div>";
    }

    // EMAIL CHECK
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message = "<div class='alert alert-danger'>Invalid email format</div>";
    }

    // 🔐 STRONG PASSWORD CHECK (ADD HERE ✅)
    elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{6,}$/', $password)) {
        $message = "<div class='alert alert-danger'>
        Password must be strong (uppercase, lowercase, number, special char)
        </div>";
    }

    // IF EVERYTHING OK → INSERT
    else {
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
<div class="card shadow-lg p-4 rounded-3 col-md-3 mx-auto card p-4 shadow" style="width: 370px;">
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
<small class="text-muted">
Must include uppercase, lowercase, number & special character
</small><br>
<small id="passError" class="text-danger"></small>
<br>
<button class="btn btn-primary w-100" name="register">Register</button>

</form>

<p class="text-center mt-2">
Already have account? <a href="login.php">Login Here</a>
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

    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let pass = document.getElementById("password").value.trim();

    document.getElementById("nameError").innerText = "";
    document.getElementById("emailError").innerText = "";
    document.getElementById("passError").innerText = "";

    // Name
    if(name === ""){
        document.getElementById("nameError").innerText = "Name required";
        valid = false;
    }

    // Email
    if(email === ""){
        document.getElementById("emailError").innerText = "Email required";
        valid = false;
    } else if(!email.includes("@")){
        document.getElementById("emailError").innerText = "Valid email required";
        valid = false;
    }

    // Password STRONG validation
    let strongPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{6,}$/;

    if(pass === ""){
        document.getElementById("passError").innerText = "Password required";
        valid = false;
    } else if(!strongPassword.test(pass)){
        document.getElementById("passError").innerText =
        "Password must include uppercase, lowercase, number & special character";
        valid = false;
    }

    return valid;
}
</script>

</body>
</html>