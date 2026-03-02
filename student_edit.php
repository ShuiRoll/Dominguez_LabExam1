<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
 
$id = $_GET['id_number'];
 
$get = mysqli_query($conn, "SELECT * FROM students WHERE id_number = '$id'");
$student = mysqli_fetch_assoc($get);
 
$message = "";
 
if (isset($_POST['update'])) {
  $id = $_GET['id_number'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $course = $_POST['course'];
 
  if ($id == "" || $name == "" || $email == "" || $course == "") {
    $message = "ID Number, Name, Email and Course are required!";
  } else {
    $sql = "UPDATE students
            SET id_number='$id', name='$name', email='$email', course='$course'
            WHERE id_number='$id'";
    mysqli_query($conn, $sql);
    header("Location: student_records.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="/TRY/style.css">
</head>
<body>
<div class="container">
 
<h2>Edit Student</h2>
<?php if($message): ?>
<p class="message message-error"><?php echo $message; ?></p>
<?php endif; ?>
 
<form method="post">
  <label>ID Number*</label>
  <input type="text" name="id_number" value="<?php echo $student['id_number']; ?>">

  <label>Full Name*</label>
  <input type="text" name="name" value="<?php echo $student['name']; ?>">
 
  <label>Email*</label>
  <input type="text" name="email" value="<?php echo $student['email']; ?>">
 
  <label>Course</label>
  <input type="text" name="course" value="<?php echo $student['course']; ?>">
 
  <div class="form-buttons">
    <button type="submit" name="update" class="btn-submit">Update Student</button>
    <a href="student_records.php" class="btn-cancel">Cancel</a>
  </div>
</form>
</div>
</body>
</html>