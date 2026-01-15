<?php
$conn = mysqli_connect("localhost", "root", "", "apexplanet");
if (!$conn) die("DB Error");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name  = $_POST['full_name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($pass !== $confirm) {
        $msg = "<div class='alert alert-danger'>Passwords do not match</div>";
    } else {

        // Upload image
        $imgName = "";
        if (!empty($_FILES['profile_pic']['name'])) {
            $imgName = time() . "_" . $_FILES['profile_pic']['name'];
            move_uploaded_file($_FILES['profile_pic']['tmp_name'], "uploads/" . $imgName);
        }

        $hashed = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (full_name, email, password, profile_pic)
                VALUES ('$name', '$email', '$hashed', '$imgName')";

        if (mysqli_query($conn, $sql)) {
            $msg = "<div class='alert alert-success'>Registration Successful</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Email already exists</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register | ApexPlanet</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    min-height:100vh;
}
.card {
    border-radius:12px;
}
</style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand">ApexPlanet</a>
<div>
<a class="text-white me-3" href="login.php">Login</a>
<a class="text-white" href="register.php">Register</a>
</div>
</div>
</nav>

<div class="container vh-100 d-flex justify-content-center align-items-center">
<div class="card p-4" style="width:400px">

<h3 class="text-center mb-3">Register</h3>

<?= $msg ?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-2">
<label>Profile Picture</label>
<input type="file" name="profile_pic" class="form-control">
</div>

<div class="mb-2">
<label>Full Name</label>
<input type="text" name="full_name" class="form-control" required>
</div>

<div class="mb-2">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-2">
<label>Password</label>
<input type="password" name="password" id="pass" class="form-control" required>
</div>

<div class="mb-2">
<label>Confirm Password</label>
<input type="password" name="confirm_password" id="cpass" class="form-control" required>
</div>

<div class="mb-2">
<input type="checkbox" onclick="toggle()"> Show Password
</div>

<button class="btn btn-success w-100">Register</button>

</form>
</div>
</div>

<script>
function toggle(){
    let p = document.getElementById("pass");
    let c = document.getElementById("cpass");
    p.type = c.type = (p.type === "password") ? "text" : "password";
}
</script>

</body>
</html>
