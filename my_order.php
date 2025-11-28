<?php

session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['category'] != 'customer') {
    header('location: login.php');
}

$sql = "SELECT * FROM orders WHERE user_id = '$_SESSION[user_id]' ORDER BY id DESC";
$query = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<title>Dashboard</title>

<?php include('shared-2/customer_sidebar.php'); ?>
    
    <section id="content">
        <main>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>History</h3>
                    </div>
                    <?php
                    if(mysqli_num_rows($query) > 0){
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Commodity</th>
                                <th>Quantity(Kg)</th>
                                <th>Price(Tsh)</th>
                                <th>Date</th>
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
                    }else{
                        echo "<p class='info-message'>You have not an order.</p>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </section>

</body>
</html>