<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

if (isset($_GET['id_number'])) {
    $id = $_GET['id_number'];
    $sql = "DELETE FROM students WHERE id_number = '$id'";
    mysqli_query($conn, $sql);
}

header("Location: student_records.php");
exit;
?>
