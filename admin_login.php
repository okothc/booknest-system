<?php
session_start();
include "config/db.php";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['admin'] = $username;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login | BookNest</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>BookNest Admin</h1>
    <p>Login to manage bookings</p>
</header>

<main>
<?php if(isset($error)) echo "<p class='message'>$error</p>"; ?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <button type="submit" name="login" class="button">Login</button>
</form>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> BookNest. All Rights Reserved.</p>
</footer>

</body>
</html>
