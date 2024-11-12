<?php

session_start();
include('db_connection.php');

if (isset($_POST['approve'])) {
    $order_id = $_POST['order_id'];

    $sql = "UPDATE orders SET status='approved' WHERE id='$order_id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Order approved successfully.";
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
    }
    header('location: staff_dashboard.php');
}

?>
