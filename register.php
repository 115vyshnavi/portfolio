<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost","root","","apexplanet");
if(!$conn){
    die("DB Error: ".mysqli_connect_error());
}

$message = "";

if(isset($_POST['register'])){
    $name  = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];
    $cpass = $_POST['confirm_password'];

    if($name=="" || $email=="" || $pass=="" || $cpass==""){
        $message = "All fields are required";
    }
    elseif($pass != $cpass){
        $message = "Passwords do not match";
    }
    else{
        $hash = password_hash($pass,PASSWORD_DEFAULT);

        $check = mysqli_query($conn,"SELECT id FROM users WHERE email='$email'");
        if(mysqli_num_rows($check)>0){
            $message = "Email already exists";
        }else{
            $sql = "INSERT INTO users(full_name,email,password)
                    VALUES('$name','$email','$hash')";
            if(mysqli_query($conn,$sql)){
                $message = "SUCCESS";
            }else{
                $message = "DB Error: ".mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body{
    margin:0;
    height:100vh;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:Segoe UI;
}
.box{
    width:360px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 10px 30px rgba(0,0,0,.3);
}
input{
    width:100%;
    padding:10px;
    margin-top:10px;
    border:1px solid #ccc;
    border-radius:5px;
}
button{
    width:100%;
    padding:12px;
    margin-top:20px;
    background:#198754;
    border:none;
    color:white;
    font-size:16px;
    border-radius:5px;
    cursor:pointer;
}
.msg{
    padding:10px;
    text-align:center;
    margin-bottom:10px;
    border-radius:5px;
}
.error{background:#f8d7da;color:#842029;}
.success{background:#d1e7dd;color:#0f5132;}
</style>
</head>

<body>
<div class="box">
<h2 align="center">Register</h2>

<?php
if($message!=""){
    if($message=="SUCCESS"){
        echo "<div class='msg success'>Registration Successful</div>";
    }else{
        echo "<div class='msg error'>$message</div>";
    }
}
?>

<form method="POST">
<input type="text" name="full_name" placeholder="Full Name">
<input type="email" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<input type="password" name="confirm_password" placeholder="Confirm Password">
<button type="submit" name="register">Register</button>
</form>

</div>
</body>
</html>
