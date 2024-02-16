<?php
    session_start();
    if (!isset($_SESSION['auser']) || empty($_SESSION['auser'])) {
    echo "<script>window.open('login.php', '_self')</script>";
    }
    include("db.php");
?>
<html>
<head>
    <title>E-commerce Admin Panel</title>
    <link rel="stylesheet" href="style_adm.css">
<style>
    /* Style for the container that holds the feature boxes */
    .dashboard {
        text-align: center; /* Center-align the content within the container */
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Style for the feature boxes */
    .feature-box {
        width: 200px;
        height: 150px;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        margin: 10px;
        display: inline-block;
        text-align: center;
        vertical-align: top;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .feature-box:hover {
        transform: scale(1.05); /* Add a slight scale effect on hover for interaction */
    }

    /* Style for the heading inside the feature box */
    .feature-box h2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    /* Style for the description text inside the feature box */
    .feature-box p {
        font-size: 1rem;
        color: #666;
    }

    /* Style for the button inside the feature box */
    .feature-box .button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #007BFF;
        color: #fff;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
    }

    /* Hover effect for the button */
    .feature-box .button:hover {
        background-color: #0056b3;
    }

    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    footer {
        background-color: #333; /* Set your preferred background color */
        color: #fff; /* Set your preferred text color */
        padding: 10px;
        text-align: center;
    }
</style>

</head>
<body>
    <header>
        <h1>Welcome to the Admin Panel</h1>
        <nav>
            <ul>
                <li><a href="admin_index.php">Dashboard</a></li>
                <li><a href="viewallcust.php">View Customers</a></li>
                <li><a href="viewprod.php">View Products</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
                <li><a href="admlogout.php">Logout</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard">
            <div class="feature-box">
                <h2>Create New Admin</h2>
                <p>Add a new admin user to the system.</p>
                <a href="newadmin.php" class="button">Create Admin</a>
            </div>

            <div class="feature-box">
                <h2>View Categories</h2>
                <p>Manage product categories and view existing categories.</p>
                <a href="viewcategory.php" class="button">View Categories</a>
            </div>
        </section>
    </main>


    <footer id="footer">
        <p>&copy; 2023 Your E-commerce Store. All rights reserved.</p>
    </footer>
</body>
</html>
