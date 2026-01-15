<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "apexplanet");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

$msg="";

if(isset($_POST['update'])){

    $name = $_POST['name'];

    if($_FILES['photo']['name']!=""){
        $img = time()."_".$_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/".$img);

        mysqli_query($conn,"UPDATE users SET full_name='$name', profile_pic='$img' WHERE id=$id");
    } else {
        mysqli_query($conn,"UPDATE users SET full_name='$name' WHERE id=$id");
    }

    $msg="Profile Updated!";
    header("refresh:1;url=profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Profile</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<style>
body {
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
}
.card {
    margin-top:100px;
    border-radius:15px;
}
</style>
</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-5">

<div class="card p-4">
<h3>Edit Profile</h3>

<?php if($msg!=""){ ?>
<div class="alert alert-success"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">
<input type="text" name="name" class="form-control mb-3" value="<?php echo $user['full_name']; ?>" required>

<input type="file" name="photo" class="form-control mb-3">

<button name="update" class="btn btn-success w-100">Update</button>
</form>

</div>
</div>
</div>
</div>

</body>
</html>
