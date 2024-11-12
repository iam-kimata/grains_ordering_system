<?php

error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_2.css">
    <link rel="stylesheet" href="boxicons-2.1.4/css/boxicons.min.css">
    <title>Dashboard</title>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class="bx bxs-smile"></i>
            <span>CustomerHub</span>
        </a>
        <ul class="side-menu">
            <li class="active">
                <a href="customer_dashboard.php">
                    <i class="bx bxs-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="my_order.php">
                    <i class="bx bx-history"></i>
                    <span>My History</span>
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
            <h3><i>Welcome to Customer Dashboard</i></h3>
            <form action="customer_dashboard.php" method="POST">
                <div class="form-input">
                    <input type="search" name="search" placeholder="Search commodity">
                    <button type="submit" class="search-btn"><i class="bx bx-search"></i></button>
                </div>
            </form>
        </nav>
    </section>