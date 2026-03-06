<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}
include "config/db.php";

if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    mysqli_query($conn, "UPDATE bookings SET status='Approved' WHERE id=$id");
}
if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    mysqli_query($conn, "UPDATE bookings SET status='Rejected' WHERE id=$id");
}

$query = "SELECT b.*, r.room_name FROM bookings b
          JOIN rooms r ON b.room_id = r.id
          ORDER BY b.id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel | BookNest</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <h1>BookNest Admin Panel</h1>
    <p>Manage Bookings</p>
</header>

<main>
<p class="logout"><a href="logout.php" class="button">Logout</a></p>

<table>
<tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Phone</th>
    <th>Room</th>
    <th>Check-in</th>
    <th>Check-out</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
    while($b = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$b['id']."</td>";
        echo "<td>".$b['full_name']."</td>";
        echo "<td>".$b['phone']."</td>";
        echo "<td>".$b['room_name']."</td>";
        echo "<td>".$b['checkin']."</td>";
        echo "<td>".$b['checkout']."</td>";
        echo "<td>".$b['status']."</td>";
        echo "<td>
                <a href='admin.php?approve=".$b['id']."' class='button'>Approve</a> 
                <a href='admin.php?reject=".$b['id']."' class='button'>Reject</a>
              </td>";
        echo "</tr>";
    }
}else{
    echo "<tr><td colspan='8'>No bookings yet</td></tr>";
}
?>
</table>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> BookNest. All Rights Reserved.</p>
</footer>

</body>
</html>
