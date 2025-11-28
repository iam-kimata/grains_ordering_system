<?php

session_start();
error_reporting(0);
include('db_connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['category'] != 'staff') {
    header('location: login.php');
}

// Variable to track whether any results were found
$resultsFound = false;

if (isset($_POST['search'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id AND first_name = '$firstName'";
    $query = mysqli_query($conn, $sql);

    // Check if any results were found
    if (mysqli_num_rows($query) > 0) {
        $resultsFound = true;
    }
} else {
    $sql = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id AND orders.status = 'approved' ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);

    // Check if any results were found
    if (mysqli_num_rows($query) > 0) {
        $resultsFound = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/staff_sidebar.php'); ?>

        <main>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Approved Orders</h3>
                    </div>
                    <?php
                        if ($resultsFound) {
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Commodity</th>
                                <th>Quantity(Kg)</th>
                                <th>Price(Tsh)</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          $count = 1;
                          while ($info = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                            <td scope="row"><?php echo $count++ ?></td>
                                <td><?php echo "{$info['first_name']}" ?></td>
                                <td><?php echo "{$info['last_name']}" ?></td>
                                <td><?php echo "{$info['comm_name']}" ?></td>
                                <td><?php echo "{$info['quantity']}" ?></td>
                                <td><?php echo "{$info['updated_price']}" ?></td>
                                <td><?php echo "{$info['created_att']}" ?></td>
                            </tr>
                            <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    } else {
                        echo "<p class='info-message'>Order not found.</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </section>
    
</body>
</html>