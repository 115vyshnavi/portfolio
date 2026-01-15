<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    min-height:100vh;
}

.card{
    border:none;
    border-radius:15px;
    animation:fadeInUp 0.8s ease;
}

@keyframes fadeInUp{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}
</style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand">ApexPlanet</a>

<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link" href="logout.php">Logout</a>
</li>
</ul>
</div>
</nav>

<div class="container vh-100 d-flex justify-content-center align-items-center">
<div class="card p-5 text-center shadow-lg" style="width:420px;">

<h3>Welcome 👋</h3>
<p class="text-muted">You are successfully logged in</p>

<hr>

<a href="profile.php" class="btn btn-primary w-100 mb-2">Edit Profile</a>
<a href="logout.php" class="btn btn-danger w-100">Logout</a>

</div>
</div>

</body>
</html>
