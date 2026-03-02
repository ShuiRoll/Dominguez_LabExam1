<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $number = $_POST['id_number'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $course = $_POST['course'];
 
  if ($number == "" || $name == "" || $email == "" || $course == "") {
    $message = "ID Number, Name, Email and Course are required!";
  } else {
    $course = $_POST['course'];
    $sql = "INSERT INTO students (id_number, name, email, course)
            VALUES ('$number', '$name', '$email', '$course')";
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
    <title>Add Student</title>
    <link rel="stylesheet" href="/TRY/style.css">
</head>
<body>
<div class="container">
 
<h2>Add Student</h2>
<?php if($message): ?>
<p class="message message-error"><?php echo $message; ?></p>
<?php endif; ?>
 
<form method="post">
   <label>ID Number*</label>
  <input type="text" name="id_number">

  <label>Full Name*</label>
  <input type="text" name="name">
 
  <label>Email*</label>
  <input type="text" name="email">
 
  <label>Course</label>
  <input type="text" name="course">
 
  <div class="form-buttons">
    <button type="submit" name="save" class="btn-submit">Save Student</button>
    <a href="student_records.php" class="btn-cancel">Cancel</a>
  </div>
</form>
</div>
</body>
</html>