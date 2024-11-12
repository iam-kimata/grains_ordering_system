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

    $sql = "SELECT * FROM users WHERE category = 'customer' AND first_name = '$firstName'";
    $query = mysqli_query($conn, $sql);

    // Check if any results were found
    if(mysqli_num_rows($query) > 0){
        $resultsFound = true;
    }
}else{
    $sql = "SELECT user_id, first_name, last_name, phone_number, region FROM users WHERE category = 'customer'";
    $query = mysqli_query($conn, $sql);

    // Check if any results were found
    if(mysqli_num_rows($query) > 0){
        $resultsFound = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/admin.php'); ?>

        <main>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Customers</h3>
                        <section id="content" style="left: 120px;">
                            <nav>
                                <form action="customers.php" method="POST">
                                    <div class="form-input">
                                        <input type="search" name="search" placeholder="Search customer">
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
                                <th>Phone Number</th>
                                <th>Region</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $count = 1;
                            while($info = mysqli_fetch_assoc($query)){
                        ?>
                            <tr>
                                <td scope="row"><?php echo $count++ ?></td>
                                <td><?php echo "{$info['first_name']}" ?></td>
                                <td><?php echo "{$info['last_name']}" ?></td>
                                <td><?php echo "{$info['phone_number']}" ?></td>
                                <td><?php echo "{$info['region']}" ?></td>
                                <td><?php echo "<a onclick = \"javascript:return confirm('Are you sure you want to delete');\" class='delete_btn' href='delete_customer.php?user_id={$info['user_id']}'>Delete</a>"; ?></td>
                                <td><?php echo "<a class='update_btn' href='update_customer.php?user_id={$info['user_id']}'>Update</a>"; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    }else{
                        echo "<p class='info-message'>User not found.</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </section>

</body>
</html>

