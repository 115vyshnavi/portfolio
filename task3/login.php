<?php
session_start();
$conn = mysqli_connect("localhost","root","","apexplanet");

$error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $q = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    
    if(mysqli_num_rows($q)==1){
        $user = mysqli_fetch_assoc($q);

        if(password_verify($password, $user["password"])){

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["role"] = $user["role"];

            if($user["role"] == "admin"){
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        }
        else{
            $error = "Wrong password";
        }
    }
    else{
        $error = "Email not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}
.card{
width:400px;
border-radius:15px;
}
</style>
</head>
<body>

<div class="card p-4">
<h3 class="text-center">Login</h3>

<?php if($error!=""){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">
<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
<button class="btn btn-success w-100">Login</button>
</form>

<p class="text-center mt-3">
<a href="register.php">Create account</a>
</p>

</div>
</body>
</html>
