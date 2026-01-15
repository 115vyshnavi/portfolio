<?php
session_start();
$conn = mysqli_connect("localhost","root","","apexplanet");

if(!isset($_SESSION["user_id"]) || $_SESSION["role"]!="admin"){
    header("Location: login.php");
    exit();
}

if(isset($_GET["delete"])){
    $id = $_GET["delete"];
    mysqli_query($conn,"DELETE FROM users WHERE id=$id");
    header("Location: users.php");
}
$users = mysqli_query($conn,"SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow">

<h4>All Users</h4>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

<?php while($u=mysqli_fetch_assoc($users)){ ?>
<tr>
<td><?php echo $u["id"]; ?></td>
<td><?php echo $u["full_name"]; ?></td>
<td><?php echo $u["email"]; ?></td>
<td><?php echo $u["role"]; ?></td>
<td>
<a href="?delete=<?php echo $u["id"]; ?>" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>
<?php } ?>

</table>

<a href="admin_dashboard.php" class="btn btn-secondary">Back</a>

</div>
</div>

</body>
</html>
