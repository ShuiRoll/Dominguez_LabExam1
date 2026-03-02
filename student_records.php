<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
 
include "db.php";
 
$students = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM students"))['c'];
 


$result = mysqli_query($conn, "SELECT * FROM students ORDER BY id_number DESC");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="/TRY/style.css">
</head>
<body>
<div class="container">

 
<h2>Student Records</h2>
<p><a href="student_add.php">+ Add Student</a></p>
 
<table>
  <tr>
    <th>ID Number</th><th>Name</th><th>Email</th><th>Course</th><th>Action</th>
  </tr>
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['id_number']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['course']; ?></td>
      <td>
        <a href="student_edit.php?id_number=<?php echo $row['id_number']; ?>">Edit</a>
        <a href="student_delete.php?id_number=<?php echo $row['id_number']; ?>">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

<div class="logout-container">
    <p>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></p>
    <a href="logout.php" class="btn-logout">Logout</a>
</div>
</div>
</body>
</html>