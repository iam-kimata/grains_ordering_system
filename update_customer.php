<?php

session_start();
include('db_connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['category'] != 'admin') {
    header('location: login.php');
}

if(isset($_POST['submit'])){
    $userId = $_GET['user_id']; 
    $firstName = htmlspecialchars($_POST['firstName']); 
    $lastName = htmlspecialchars($_POST['lastName']);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $region = htmlspecialchars($_POST['region']);

    $sql = "UPDATE users SET first_name='$firstName', last_name='$lastName', phone_number='$phoneNumber', region='$region' WHERE user_id='$userId'";
    $query = mysqli_query($conn, $sql);

    if($query){
       header('location: customers.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/admin_sidebar.php'); ?>

        <div class="content">
            <div class ="update-form"> 
                <div class="container-2">
                    <h3 class="form-title">Update User Profile</h3>
                    <form action="#" method="POST">
                        <?php 
                        $selectCustomer = "SELECT * FROM users WHERE user_id = '".$_GET['user_id']."'";
                        $result = mysqli_query($conn, $selectCustomer);

                        if(mysqli_num_rows($result) > 0 ){
                            while($row = mysqli_fetch_assoc($result)){ 
                        ?>
                            <div class="main-user-info">
                                <div class="user-input-box">
                                    <label>First Name</label>
                                    <input type="text" name="firstName" value="<?php echo $row['first_name']; ?>">
                                </div>
                                <div class="user-input-box">
                                    <label>Last Name</label>
                                    <input type="text" name="lastName" value="<?php echo $row['last_name']; ?>">
                                </div>
                                <div class="user-input-box">
                                    <label>Phone Number</label>
                                    <input type="text" name="phoneNumber" value="<?php echo $row['phone_number']; ?>">
                                </div>
                                <div class="user-input-box">
                                    <label>Region</label>
                                    <input type="text" name="region" value="<?php echo $row['region']; ?>">
                                </div>
                            </div>
                            <?php  
                            }
                        }
                        ?>
                        <button type="submit" name="submit" class="form-submit-btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>

    
        

    

