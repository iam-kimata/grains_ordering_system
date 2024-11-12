<?php

session_start();
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<title>Login form</title>

<?php include('shared/navbar.html'); ?>

   <div class="login-form">
      <div class="wrapper-2">
         <form action="login_check.php" method="POST">                
            <h1>Login</h1>
            <?php 
               if($_SESSION['message']){
                  $message = $_SESSION['message'];

                  echo "<h4 style = 'text-align: center; color: red;'>$message</h4>";
                  session_destroy();
               }
            ?>
            <div class="input-box">
               <input type="text" name="email" placeholder="Username">
               <i class="bx bxs-user"></i>
            </div>
            <div class="input-box">
               <input type="password" name="password" placeholder="Password">
               <i class="bx bxs-lock-alt"></i>
            </div>
            <button type="submit" name="submit" class="btn-2">Login</button>
            <div class="register-link">
               <p>Don't have an account? <a href="registration.php">Register</a></p>
            </div>
         </form>
      </div>
   </div>
   
</body>
</html>














