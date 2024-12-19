<?php

session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['category'] != 'customer') {
    header('location: login.php');
}

$commName = '';
if (isset($_POST['search'])) {
    $commName = mysqli_real_escape_string($conn, $_POST['search']);
}

if (!empty($commName)) {
    $sql = "SELECT * FROM commodities WHERE comm_name = '$commName'";
} else {
    $sql = "SELECT * FROM commodities";
}

$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/customer.php'); ?>

<section class="commodity">
    <div class="commodity-container container">
        <?php
        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="box">';
                    echo '<img src="images/' . $row['image'] . '" alt="">';
                    echo '<h3>' . $row['comm_name'] . '</h3>';
                    echo '<span>' . $row['price'] . 'Tsh</span>';
                    echo '<i class="bx bx-star bx-st">' . $row['quantity'] . 'kg</i>';
                    echo '<a href="order.php?user_id=' . $_SESSION['user_id'] . '&comm_name=' . $row['comm_name'] . '&price=' . $row['price'] . '&quantity=' . $row['quantity'] . '" class="btn">Order Now</a>';
                    echo '</div>';
                }
            } else {
                echo "<p class='info-message'>No search commodity.</p>";
            }
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
        ?>
    </div>
</section>

</body>
</html>
