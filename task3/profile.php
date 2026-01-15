<?php
session_start();
$conn = mysqli_connect("localhost","root","","apexplanet");

if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION["user_id"];

$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE id=$id"));

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST["full_name"];
    $email = $_POST["email"];

    if(!empty($_FILES["profile_pic"]["name"])){
        $pic = time().$_FILES["profile_pic"]["name"];
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"],"uploads/$pic");
        mysqli_query($conn,"UPDATE users SET full_name='$name', email='$email', profile_pic='$pic' WHERE id=$id");
    } else {
        mysqli_query($conn,"UPDATE users SET full_name='$name', email='$email' WHERE id=$id");
    }

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
min-height:100vh;
}
.card{border-radius:15px;}
</style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand">ApexPlanet</a>
<a href="dashboard.php" class="btn btn-light btn-sm">Dashboard</a>
</div>
</nav>

<div class="container vh-100 d-flex justify-content-center align-items-center">
<div class="card p-4 shadow" style="width:420px;">

<h4 class="text-center mb-3">Edit Profile</h4>

<img src="uploads/<?php echo $user['profile_pic']; ?>" width="80" class="rounded-circle mx-auto d-block mb-3">

<form method="POST" enctype="multipart/form-data">

<input type="text" name="full_name" value="<?php echo $user['full_name']; ?>" class="form-control mb-3" required>

<input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control mb-3" required>

<input type="file" name="profile_pic" class="form-control mb-3">

<button class="btn btn-success w-100">Update</button>

</form>

</div>
</div>

</body>
</html>
