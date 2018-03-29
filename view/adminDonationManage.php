<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin') {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta charset="UTF-8">
    <title>Admin Manage Donation</title>
</head>
<body>


<div class="w3-bar w3-light-grey">

    <a href="admin.php" class="w3-bar-item w3-button">Admin Home</a>

    <div class="w3-dropdown-hover">
        <!-- user name -->
        <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button -->
        </div>
    </div>


</div>


<a href="Receptionist.php" target="_blank"> Receptionist page</a><br>
<a href="labTechnician.php" target="_blank"> Lab Technician page</a><br>
<a href="physician.php" target="_blank"> Physician  page</a> <br>
<a href="nurse.php" target="_blank"> Nurse page</a><br>
<a href="bloodComponent.php" target="_blank"> Nurse_2(Blood Component) page</a><br>
<a href="lab.php" target="_blank"> Lab page</a> <br>
<a href="medicalSupervisor.php" target="_blank"> Medical Supervisor  page</a><br>
<a href="director.php" target="_blank"> Medical Director page</a><br>


<?php

}
else {

    header('location:Login.php');

}

