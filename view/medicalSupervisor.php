<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/27/2018
 * Time: 11:00 PM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='medical_supervisor' || $_SESSION['job']=='admin')
{


    //search
    if(isset($_POST['search'])) {
        include '../model/NurseModel.php';
        $units=NurseModel::searchUnit(filter_var($_POST['search'], FILTER_SANITIZE_STRING));
    }


    //all accept  donar
    elseif (isset($_GET['do'])&&$_GET['do']=='accept'){

        include '../model/supervisor.php';
        $units=supervisor::All(0);

    }
    //all accept  donar
    elseif (isset($_GET['do'])&&$_GET['do']=='reject'){

        include '../model/supervisor.php';
        $units=supervisor::All(1);

    }




    else{
        //accept donar
        include '../model/NurseModel.php';
        $units=NurseModel::getAllUnit();
    }
?>




    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>Clinic</title>
    </head>


<body>


<div class="w3-bar w3-light-grey">
    <a href="medicalSupervisor.php" class="w3-bar-item w3-button">Medical Supervisor</a>   <!-- supervisor home button -->
    <a href="medicalSupervisor.php?do=accept" class="w3-bar-item w3-button">Accept</a>     <!-- accept donar button -->
    <a href="medicalSupervisor.php?do=reject" class="w3-bar-item w3-button">Reject</a>     <!-- reject donar button -->
    <!--search form-->
    <form action="" method="post">
        <input type="text" name="search"  class="w3-bar-item w3-input" placeholder="Search..">
        <input type="submit" value="search"  class="w3-bar-item w3-button w3-blue">
    </form>
    <div class="w3-dropdown-hover">
        <!-- user name -->
        <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button -->
        </div>
    </div>


</div>

<?php

    if($units!= null)
    {
        echo '<table  class="w3-table w3-striped">
                                          <caption >Users</caption>
                                          <tr class="w3-blue">
                                              <th>Unit NO</th>
                                              <th> Approval</th>
                                              <th> Eddit</th>
                                
                                          </tr>';
        foreach ($units as $unit) {

            echo "   <tr>
                                                <td>" . $unit['unitNo'] . "</td>
                                                 <td><a  class=\"w3-btn w3-gray\" href='supervisorOperation.php ?do=insert& unit=" . $unit['unitNo'] . "'>check </a></td>
                                                 <td><a  class=\"w3-btn w3-gray\" href='supervisorOperation.php ?do=update& unit=" . $unit['unitNo'] . "'>update </a></td>
                                                 
                                                </tr>";

        }
        echo    "</table>";

        if(isset($_SESSION['operation'])&&$_SESSION['operation']!=null){

            echo $_SESSION['operation'];
            $_SESSION['operation']=null;

        }
    }
    //no user found in table
    else{

        echo  "no user found ";

    }



}
//no permission to access page
else{

    header('location:Login.php');

}
?>