<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_2.css">
    <link rel="stylesheet" href="boxicons-2.1.4/css/boxicons.min.css">
    <title>Dashboard</title>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class="bx bxs-smile"></i>
            <span>AdminHub</span>
        </a>
        <ul class="side-menu">
            <li class="active">
                <a href="admin_dashboard.php">
                    <i class="bx bxs-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="customers.php">
                    <i class="bx bxs-group"></i>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a href="staffs.php">
                    <i class="bx bxs-group"></i>
                    <span>Staffs</span>
                </a>
            </li>
            <li>
                <a href="upload_commodities.php">
                    <i class="bx bx-cloud-upload"></i>
                    <span>Upload Commodities</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="logout.php" class="logout">
                    <i class="bx bx-exit"></i>
                    <span>Logout</span>
                </a>
            </li>  
        </ul>
    </section>

    <!--=========================== Content Section ===========================-->
    <section id="content">
        <nav>
            <h3><i>Welcome to Admin Dashboard</i></h3>
            <a href="#" class="profile">
                <img src="images/dashboard.png" alt="An image of admin">
            </a>
        </nav>