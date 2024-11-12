<?php

session_start();
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
    $sql = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id AND orders.status != 'approved' ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);

    // Check if any results were found
    if (mysqli_num_rows($query) > 0) {
        $resultsFound = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/staff.php'); ?>

        <main>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Customer Orders</h3>
                    </div>
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<p class='success-message'>{$_SESSION['message']}</p>";
                        unset($_SESSION['message']); 
                    }
                    if (isset($_SESSION['error'])) {
                        echo "<p class='error-message'>{$_SESSION['error']}</p>";
                        unset($_SESSION['error']); 
                    }
                    ?>
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
                                <th>Status</th>
                                <th>Action</th>
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
                                <td class="
                                    <?php
                                    if (empty($info['status'])) {
                                        echo "status-pending";
                                    } elseif ($info['status'] == 'completed') {
                                        echo "status-completed";
                                    } elseif ($info['status'] == 'approved') {
                                        echo "status-approved";
                                    } else {
                                        echo "status-unknown";
                                    }
                                    ?>
                                ">
                                    <?php
                                    if (empty($info['status'])) {
                                        echo "Pending";
                                    } elseif ($info['status'] == 'completed') {
                                        echo "Completed";
                                    } elseif ($info['status'] == 'approved') {
                                        echo "Approved";
                                    } else {
                                        echo "Unknown";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <form action="approve_order.php" method="POST">
                                        <input type="hidden" name="order_id" value="<?php echo $info['id']; ?>">
                                        <input type="submit" name="approve" value="Approve" class="btn-2">
                                    </form>
                                </td>
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
