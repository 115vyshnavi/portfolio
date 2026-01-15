<?php
session_start();
include "db.php";

if ($_SESSION['role'] != 'admin') {
    die("Unauthorized");
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("Location: admin_dashboard.php");
