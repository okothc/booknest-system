<?php
include "config/db.php";
$room_id = isset($_GET['id']) ? $_GET['id'] : 0;

if(isset($_POST['book'])){
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $query = "INSERT INTO bookings (full_name, phone, room_id, checkin, checkout, status)
              VALUES ('$full_name', '$phone', '$room_id', '$checkin', '$checkout', 'Pending')";

    if(mysqli_query($conn, $query)){
        $message = "Booking submitted! Wait for admin approval.";
    } else {
        $message = "Error: ".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Book Room | BookNest</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>BookNest</h1>
    <p>Book Your Room</p>
</header>

<main>
<h2>Book Room</h2>

<?php if(isset($message)) echo "<p class='message'>$message</p>"; ?>

<form method="post">
    <label>Full Name:</label><br>
    <input type="text" name="full_name" required><br>

    <label>Phone:</label><br>
    <input type="text" name="phone" required><br>

    <label>Check-in:</label><br>
    <input type="date" name="checkin" required><br>

    <label>Check-out:</label><br>
    <input type="date" name="checkout" required><br>

    <button type="submit" name="book" class="button">Book Now</button>
</form>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> BookNest. All Rights Reserved.</p>
</footer>

</body>
</html>
