<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin')
{
    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>Admin</title>
    </head>


<body>


<div class="w3-bar w3-light-grey">
    <a href="admin.php" class="w3-bar-item w3-button">Admin Home</a>     <!-- Admin Department home button -->
    <div class="w3-dropdown-hover">
        <!-- user name -->
        <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button -->
        </div>
    </div>


</div>

<!--frame-->
    <a  href='adminManageEmployee.php'>Manage Employees </a><br>
    <a  href='?do=donation'>Donation Management</a><br>
    <a  href='?do=order'>Hospital Order </a><br>
<?php

}

//no permission to access page
else {

    header('location:Login.php');

}


