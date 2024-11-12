<?php

session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['category'] != 'admin') {
    header('location: login.php');
}

// Variable to track whether any results were found
$resultsFound = false;

if(isset($_POST['search'])){
    $firstName = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id AND first_name = '$firstName'";
    $query = mysqli_query($conn, $sql);

    // Check if any results were found
    if (mysqli_num_rows($query) > 0){
        $resultsFound = true;
    }
}else{
    $sql = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);

    // Check if any results were found
    if (mysqli_num_rows($query) > 0){
        $resultsFound = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/admin.php'); ?>

        <main>
            <ul class="box-info">
                <li>
                    <i class="bx bxs-group"></i>
                    <span class="text">
                        <h4><?php  
                            $count = mysqli_query($conn, "SELECT user_id FROM users WHERE category = 'customer'");
                            $customer_count = mysqli_num_rows($count);
                            if(empty($customer_count) >= 0){ ?>                
                            <?php echo $customer_count ?>
                            <?php } ?>
                        </h4>
                        <p>Total Customer</p>
                    </span>
                </li>
                <li>
                    <i class="bx bxs-group"></i>
                    <span class="text">
                        <h4><?php  
                            $count = mysqli_query($conn, "SELECT user_id FROM users WHERE category = 'staff'");
                            $staff_count = mysqli_num_rows($count);
                            if(empty($staff_count) >= 0){ ?>                
                            <?php echo $staff_count ?>
                            <?php } ?>
                        </h4>
                        <p>Total Staff</p>
                    </span>
                </li>
                <li>
                    <i class="bx bx-calendar"></i>
                    <span class="text">
                        <h4><?php  
                            $count = mysqli_query($conn,"SELECT id FROM orders");
                            $order_count = mysqli_num_rows($count);
                            if(empty($order_count) >= 0){ ?>                
                            <?php echo $order_count ?>
                            <?php } ?>
                        </h4>
                        <p>Total Orders</p>
                    </span>
                </li>
            </ul>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Customer Orders</h3>
                        <section id="content" style="left: 20px;">
                            <nav>
                                <form action="admin_dashboard.php" method="POST">
                                    <div class="form-input">
                                        <input type="search" name="search" placeholder="Search order">
                                        <button type="submit" class="search-btn"><i class="bx bx-search" style="font-size: 18px;"></i></button>
                                    </div>
                                </form>
                            </nav>
                       </section>
                    </div>
                    <?php
                        if($resultsFound){
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
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                          $count = 1;
                            while($info = mysqli_fetch_assoc($query))
                            {
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
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    }else{
                        echo "<p class='info-message'>No orders found.</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </section>
    
</body>
</html>