<?php

session_start();
// error_reporting(0);
include('db_connection.php');

// Displaying validate message
$errors = array('user_category'=>'', 'firstName'=>'', 'lastName'=>'', 'phoneNumber'=>'', 'email'=>'', 'gender'=>'', 'region'=>'', 'age'=>'', 'department'=>'', 'image'=>'', 'password'=>'', 'confirmPassword'=>'');

// Maintain corrent values after displaying validate message
$category = $firstName = $lastName = $phoneNumber = $email = $gender = $region = $age = $department = $image = $password = $confirmPassword = '';

if(isset($_POST['submit'])){

    // Check for User Category
    if(empty($_POST['user_category'])){
        $errors['user_category'] = 'A Category is required <br />';
    }else{
        $category = $_POST['user_category'];
    }
    
    // Check for First Name
    if(empty($_POST['firstName'])){
        $errors['firstName'] = 'A First Name is required <br />';
    }else{
        $firstName = $_POST['firstName'];
        if(!preg_match('/^[a-zA-Z]+$/', $firstName)){
            $errors['firstName'] = 'First Name must be letters only';
        }
    }
    
    // Check for Last Name
    if(empty($_POST['lastName'])){
        $errors['lastName'] = 'A Last Name is required <br />';
    }else{
        $lastName = $_POST['lastName'];
        if(!preg_match('/^[a-zA-Z]+$/', $lastName)){
            $errors['lastName'] = 'Last Name must be letters only';
        }
    }
    
    // Check for Phone Number
    if(empty($_POST['phoneNumber'])){
        $errors['phoneNumber'] = 'A Phone Number is required <br />';
    }else{
        $phoneNumber = $_POST['phoneNumber'];
        if(!preg_match('/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/', $phoneNumber)){
            $errors['phoneNumber'] = 'Phone Number must be a valid';
        }
    }
    
    // Check for Email
    if(empty($_POST['email'])){
        $errors['email'] = 'An Email is required <br />';
    }else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email address';
        }
    }
    
    // Check for Gender
    if(empty($_POST['gender'])){
        $gender = NULL;
    }else{
        $gender = $_POST['gender'];
    }
    
    // Check for Region
    if(empty($_POST['region'])){
        $region = NULL;
    }else{
        $region = $_POST['region'];
    }
    
    // Check for Age
    if(empty($_POST['age'])){
        $age = NULL;
    }else{
        $age = $_POST['age'];
        if(!preg_match('/^(1[89]|[2-9]\d|\d{3,})$/', $age)){
            $errors['age'] = 'Your not an adult';
        }
    }
    
    // Check for Department
    if(empty($_POST['department'])){
        $department = NULL;
    }else{
        $department = $_POST['department'];
    }
    
    // Check for Image
    if(empty($_FILES['image']['name'])){
        $image = NULL;
    }else{
        $image = $_FILES['image']['name'];
        $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if(!in_array($imageFileType, ['jpg', 'jpeg', 'png'])){
            $errors['image'] = 'Only jpg, jpeg or png are required';
        }
    }
    
    $targetDir = 'image_uploads/';
    $targetFile = $targetDir . basename($image);
       if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
    } 
    
    // Check for Password
    if(empty($_POST['password'])){
        $errors['password'] = 'A Password is required <br />';
    }else{
        $password = $_POST['password'];
        if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,20}$/', $password)){
            $errors['password'] = 'Password must include at least one number, upper, lower and special character';
        }
    }
    
    // Check for Confirm Password
    if(empty($_POST['confirmPassword'])){
        $errors['confirmPassword'] = 'A Confirm Password is required <br />';
    }else{
        $confirmPassword = $_POST['confirmPassword'];
        if($password != $confirmPassword){
            $errors['confirmPassword'] = 'Password must be match';
        }else{           
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        }    
    }

    if(array_filter($errors)){
    }else{
        $sql = "INSERT  INTO users(category, first_name, last_name, phone_number, email, gender, region, age,  department, image, password, created_at)
        VALUES('$category', '$firstName', '$lastName', '$phoneNumber', '$email', ";
     
        // Include NULL values for optional fields
        $sql .= empty($gender) ? 'NULL, ' : "'$gender', ";
        $sql .= empty($region) ? 'NULL, ' : "'$region', ";
        $sql .= empty($age) ? 'NULL, ' : "'$age', ";
        $sql .= empty($department) ? 'NULL, ' : "'$department', ";
        $sql .= empty($image) ? 'NULL, ' : "'$image', ";
        $sql .= "'$hashedPassword', NOW())";

        $query = mysqli_query($conn, $sql);

        if($query){
           header('location: login.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<title>Registration form</title>

<?php include('shared/navbar.html'); ?>

    <div class="registration-form">  
        <div class="container-1">
            <header>Registration form</header>
            <form action="registration.php" method="POST" enctype="multipart/form-data">
                <div class="fields">         
                    <div class="input-field">
                        <label>Category</label>
                        <div class="red-text"><?php echo $errors['user_category']; ?></div>
                        <select name="user_category" id="user_category" onchange="toggleField()">
                            <option value="" disabled selected>Select Category</option>
                            <option value="customer" <?php echo ($category === 'customer') ? 'selected' : ''; ?>>Customer</option>
                            <option value="staff" <?php echo ($category === 'staff') ? 'selected' : ''; ?>>Staff</option>
                        </select>
                    </div> 
                                                           
                    <div class="input-field">
                        <label>First Name</label>
                        <div class="red-text"><?php echo $errors['firstName']; ?></div>
                        <input type="text" name="firstName" placeholder="Enter First Name" value="<?php echo htmlspecialchars($firstName) ?>">
                    </div>
                        
                    <div class="input-field">
                        <label>Last Name</label>
                        <div class="red-text"><?php echo $errors['lastName']; ?></div>
                        <input type="text" name="lastName" placeholder="Enter Last Name" value="<?php echo htmlspecialchars($lastName) ?>">
                    </div>
                        
                    <div class="input-field">
                        <label>Phone Number</label>
                        <div class="red-text"><?php echo $errors['phoneNumber']; ?></div>
                        <input type="text" name="phoneNumber" placeholder="Enter Phone Number" value="<?php echo htmlspecialchars($phoneNumber) ?>">
                    </div>
                        
                    <div class="input-field">
                        <label>Email</label>
                        <div class="red-text"><?php echo $errors['email']; ?></div>
                        <input type="text" name="email" placeholder="Enter Email" value="<?php echo htmlspecialchars($email) ?>">
                    </div>
                        
                    <div class="input-field" id="genderField">
                        <label>Gender</label>
                        <select name="gender">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                         
                    <div class="input-field" id="regionField">
                        <label>Region</label>
                        <select name="region">
                            <option value="" disabled selected>Select Region</option>
                            <option value="Dar es Salaam" <?php echo ($region === 'Dar es Salaam') ? 'selected' : ''; ?>>Dar es Salaam</option>
                            <option value="Arusha" <?php echo ($region === 'Arusha') ? 'selected' : ''; ?>>Arusha</option>
                            <option value="Dodoma" <?php echo ($region === 'Dodoma') ? 'selected' : ''; ?>>Dodoma</option>
                            <option value="Tanga" <?php echo ($region === 'Tanga') ? 'selected' : ''; ?>>Tanga</option>
                            <option value="Kigoma" <?php echo ($region === 'Kigoma') ? 'selected' : ''; ?>>Kigoma</option>
                        </select>
                    </div>
                        
                    <div class="input-field" id="ageField">
                        <label>Age</label>
                        <div class="red-text"><?php echo $errors['age']; ?></div>
                        <input type="number" name="age" placeholder="Enter Age" value="<?php echo htmlspecialchars($age) ?>">
                    </div>
                        
                    <div class="input-field" id="departmentField">
                        <label>Department</label>
                        <select name="department">
                            <option value="" disabled selected>Select Department</option>
                            <option value="Customer Care" <?php echo ($department === 'Customer Care') ? 'selected' : ''; ?>>Customer Care</option>
                            <option value="Accounting and Finance" <?php echo ($department === 'Accounting and Finance') ? 'selected' : ''; ?>>Accounting and Finance</option>
                            <option value="Information Technology" <?php echo ($department === 'Information Technology') ? 'selected' : ''; ?>>Information Technology</option>
                        </select>
                    </div>
                        
                    <div class="input-field" id="imageField">
                        <label>Upload Image</label>
                        <div class="red-text"><?php echo $errors['image']; ?></div>
                        <input type="file" name="image" accept=".jpg, .jpeg, .png" value="<?php echo htmlspecialchars($image) ?>">   
                    </div>
                        
                    <div class="input-field">
                        <label>Password</label>
                        <div class="red-text"><?php echo $errors['password']; ?></div>
                        <input type="password" name="password" placeholder="Enter Password" value="<?php echo htmlspecialchars($password) ?>">
                    </div>
                        
                    <div class="input-field">
                        <label>Confirm Password</label>
                        <div class="red-text"><?php echo $errors['confirmPassword']; ?></div>
                        <input type="password" name="confirmPassword" placeholder="Confirm Password" value="<?php echo htmlspecialchars($confirmPassword) ?>">
                    </div>
                </div>
                
                <button type="submit" name="submit" class="form-submit-button">Register</button>           
                <div class="login-link">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div> 
            </form>
        </div>
    </div>

    <script>
        function toggleField(){
            let userCategory = document.querySelector('#user_category').value;
            let genderInput = document.querySelector('#genderField');
            let regionInput = document.querySelector('#regionField');
            let ageInput = document.querySelector('#ageField');
            let departmentInput = document.querySelector('#departmentField');
            let imageInput = document.querySelector('#imageField');

        if(userCategory === 'customer'){
            genderInput.style.display = 'block';
            regionInput.style.display = 'block';
            ageInput.style.display = 'none';
            departmentInput.style.display = 'none';
            imageInput.style.display = 'none';
            
        }else if(userCategory === 'staff'){
            genderInput.style.display = 'none';
            regionInput.style.display = 'none';
            ageInput.style.display = 'block';
            departmentInput.style.display = 'block';
            imageInput.style.display = 'block';
        }
    }
    </script>

</body>
</html>