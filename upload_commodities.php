<?php

session_start();
error_reporting(0);
include('db_connection.php');

if (!isset($_SESSION['user_id']) || $_SESSION['category'] != 'admin') {
    header('location: login.php');
}

if(isset($_POST['submit'])){
    $image = $_FILES['image']['name'];
    $targetDir = 'image_uploads-2/';
    $targetFile = $targetDir . basename($image);
        
    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
        // Successfully uploaded
    }else{
        // Upload failed
    }
        
    $commName = htmlspecialchars($_POST['comm_name']);
    $price = htmlspecialchars($_POST['price']);
    $quantity = htmlspecialchars($_POST['quantity']);

    $sql = "INSERT  INTO commodities(image, comm_name, price, quantity)
    VALUES('$image', '$commName', '$price', '$quantity')";
     
    $query = mysqli_query($conn, $sql);

    if($query){
        $_SESSION['success_message'] = "You have successfully uploaded a commodity!";
        header('location: upload_commodities.php');
        exit();
    }
}

// Retrieve and clear success message from session
$successMessage = '';
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('shared-2/admin.php'); ?>

        <div class="upload-form">
            <div class="upload-details">
                <form action="upload_commodities.php" method="POST" enctype="multipart/form-data">                
                    <h1>Upload Commodity</h1>
                    <?php if (!empty($successMessage)): ?>
                        <p class="success-message"><?php echo $successMessage; ?></p>
                    <?php endif; ?>
                    <div class="commodity">
                        <input type="file" name="image" required>
                    </div>
                    <div class="commodity">
                        <input type="text" name="comm_name" placeholder="Enter Commodity Name" required>
                    </div>
                    <div class="commodity">
                        <input type="text" name="price" placeholder="Enter Price" required>
                    </div>
                    <div class="commodity">
                        <input type="number" name="quantity" placeholder="Enter Quantity" required>
                    </div>
                    <button type="submit" name="submit" class="upload-btn">Upload</button>             
                </form>
            </div>
        </div>
    </section>
    
</body>
</html>