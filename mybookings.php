<?php
include "config/db.php";

$phone = "";
if(isset($_POST['check'])){
    $phone = $_POST['phone'];
    $query = "SELECT b.*, r.room_name 
              FROM bookings b
              JOIN rooms r ON b.room_id = r.id
              WHERE b.phone='$phone'
              ORDER BY b.id DESC";
    $result = mysqli_query($conn, $query);
} else {
    $result = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Bookings | BookNest</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>BookNest</h1>
    <p>Check Your Booking Status</p>
</header>

<main>
<form method="post">
    <label>Enter your phone number:</label><br>
    <input type="text" name="phone" value="<?php echo $phone; ?>" required><br>
    <button type="submit" name="check" class="button">Check Status</button>
</form>

<?php if($result && mysqli_num_rows($result) > 0): ?>
    <h3>Bookings for <?php echo $phone; ?>:</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Room</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
        </tr>
        <?php while($b = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $b['id']; ?></td>
                <td><?php echo $b['full_name']; ?></td>
                <td><?php echo $b['room_name']; ?></td>
                <td><?php echo $b['checkin']; ?></td>
                <td><?php echo $b['checkout']; ?></td>
                <td><?php echo $b['status']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php elseif(isset($_POST['check'])): ?>
    <p>No bookings found for this phone number.</p>
<?php endif; ?>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> BookNest. All Rights Reserved.</p>
</footer>

</body>
</html>
