<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["role"]!="admin"){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>
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
<span class="navbar-brand">Admin Panel</span>
<a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
</div>
</nav>

<div class="container mt-5">
<div class="card p-4 shadow">
<h4>Admin Dashboard</h4>
<p>You can manage users</p>
<a href="users.php" class="btn btn-primary">View Users</a>
</div>
</div>

</body>
</html>
