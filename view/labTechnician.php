<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='lab_Technician'){
    //search
    if(isset($_POST['search'])) {
        include '../model/labTechnician.php';
        new labTechnician();
        $users = labTechnician::search(filter_var($_POST['search'], FILTER_SANITIZE_NUMBER_INT));

    }


    //get all use
    else{
        include '../model/labTechnician.php';
        new labTechnician();
        $users= labTechnician::getALL();

    }

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
                         <a href="labTechnician.php" >Whole blood donation</a>     <!-- clinic home button -->
                    </li>
                </ul>
                <!-- search  -->
                <ul class="nav navbar-nav" style="margin: 9px 112px 0;">
                    <li>
                        <form class="form-inline" action="" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                <input class="form-control " type="text" name="search" placeholder="Search..." style="width: 296px">                                     
                            </div>
                            <button class="btn btn-danger" type="submit" value="search" style="margin-left: -4px"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </form>
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

    <?php
    //table of user
    if($users!= null)
    {
        echo '<div class="col-md-10 col-md-offset-1"  id="container-table" style="background: #e87e79c7;">
                <table  class="table table-hover">
                        <caption >Users</caption>
                            <tr class="w3-blue">
                                <th>رقم السجل القومى /الاقامه</th>
                                <th> Health Information</th>
                                <th>Modife</th>
                            </tr>';
        foreach ($users as $user) {

            echo "          <tr>
                                <td>" . $user['donar_NID'] . "</td>
                                <td><a  class=\"btn btn-default\" href='labTechnicianOperation.php ?do=insert& nid=" . $user['donar_NID'] . "'>Insert <span class='glyphicon glyphicon-user'></span></a></td>
                                <td><a  class=\"btn btn-default\" href='labTechnicianOperation.php ?do=update& nid=" . $user['donar_NID'] . "'>Update <span class='glyphicon glyphicon-edit'></span></a></td>
                            </tr>";

        }
        echo    "</table> </div>";

        if(isset($_SESSION['labOperation'])&& $_SESSION['labOperation']!=null){
            echo $_SESSION['labOperation'];
            $_SESSION['labOperation']=null;


        }
    }
    //no user found in table
    else{

        echo  "no user found ";

       }







}
//no permission to access
else{
    header('location:Login.php');
}