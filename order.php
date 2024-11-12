<?php

session_start();
error_reporting(0);
include('db_connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['category'] != 'customer') {
    header('location: login.php');
}

// Retrieve parameters from the URL
$userId = $_SESSION['user_id'];
$commName = $_GET['comm_name'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];

if(isset($_POST['submit'])){
    $quantity = htmlspecialchars($_POST['quantity']);

    // Calculate the updated price based on the quantity
    $updatedPrice = $quantity * $price;

    $sql = "INSERT  INTO orders(user_id, comm_name, quantity, price, updated_price, created_att)
    VALUES('$userId', '$commName', '$quantity', '$price', '$updatedPrice', NOW())";
     
    $query = mysqli_query($conn, $sql);

    if($query){
        header('location: order.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/customer.php'); ?>

    <div class="order-form">
        <div class="user-details">
        <form action="order.php?comm_name=<?php echo $commName; ?>&price=<?php echo $price; ?>&quantity=<?php echo $quantity; ?>" method="POST">                   
                <h1>Order Now</h1>
                <div class="input-box">
                    <input type="number" name="quantity" placeholder="Quantity in Kg" required  oninput="updatePrice()">
                </div>     
                <button type="submit" name="submit" class="order-btn">Submit</button>          
            </form>
        </div>
    </div>
    
</body>
</html>





