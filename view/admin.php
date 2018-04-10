<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin')
{
    ?>


<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clinic</title>
    <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/css/Questionnaire.css">
    <link rel="stylesheet" href="../resource/css/header.css">
    <link rel="stylesheet" href="../resource/css/Recieptionist.css">
    <style>
         .col-md-10{
            background: #e2444000;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
            margin-top: 67px;
        }
        #container-table {
            margin-top:45px;
        }

        .btn:hover{
            padding: 10px;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>

<body>
    
    <header class="container">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li class="active"> 
                         <a href="admin.php">Admin Home</a>     <!-- Admin Department home button -->
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                   <span class="name"> <?php echo $_SESSION['userName'] ?></span>
                </li>
                <li><a class="btn" id="login" href="../controller/user/Logoutcontroller.php">Logout</a> </li>       <!-- login button-->
            </ul>
            </div>
        </div>
        </nav>
    </header>

        <img src="../resource/images/3.jpg" alt="" class="bg-image" style="margin-top:7px">
        <div class="blure-body" style="background: linear-gradient(to left, #ffffff00 ,#f85f65b8);"></div>


        <div class="col-md-10 col-md-offset-1">
            <a  class="btn btn-default col-md-8 col-md-offset-2" href='adminManageEmployee.php'>Manage Employees </a>
            <a  class="btn btn-default col-md-8 col-md-offset-2" href='adminDonationManage.php'>Donation Management</a>
            <a  class="btn btn-default col-md-8 col-md-offset-2" href='adminHospitalOrder.php'>Hospital Order </a>
        </div>


<!--frame-->
<?php

}

//no permission to access page
else {

    header('location:Login.php');

}


