<?php
session_start();
 

if (isset($_SESSION['username'])) {
    header("Location: student_records.php");
    exit();
}
 
$error = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 

    if ($username === "admin" && $password === "admin") {
 
        $_SESSION['username'] = "ADMIN";
        header("Location: student_records.php");
        exit();
 
    } else {
        $error = "Invalid username or password!";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/TRY/style.css">
</head>
<body>
 
<h2>Login Form</h2>
 
<?php if ($error != ""): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>
 
<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>
 
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
 
    <button type="submit" class="btn-submit">Login</button>
</form>
 
</body>
</html>