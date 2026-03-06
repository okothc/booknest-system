<?php
include "config/db.php";
$query = "SELECT * FROM rooms";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Available Rooms | BookNest</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>BookNest</h1>
    <p>Available Rooms</p>
</header>

<main>
<h2>Available Rooms</h2>

<?php
if(mysqli_num_rows($result) > 0){
    while($room = mysqli_fetch_assoc($result)){
        ?>
        <div class="room">
            <h3><?php echo $room['room_name']; ?></h3>
            <p>Price: Ksh <?php echo $room['price']; ?></p>
            <p>Status: <?php echo $room['status']; ?></p>
            <a href="book.php?id=<?php echo $room['id']; ?>" class="button">Book Now</a>
        </div>
        <?php
    }
} else {
    echo "<p>No rooms available.</p>";
}
?>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> BookNest. All Rights Reserved.</p>
</footer>

</body>
</html>
