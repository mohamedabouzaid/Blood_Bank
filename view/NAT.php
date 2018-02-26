<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/13/2018
 * Time: 12:58 AM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='NAT')
{
    //search
    if(isset($_POST['search'])) {
        include '../model/NurseModel.php';
        $units=NurseModel::searchUnit(filter_var($_POST['search'], FILTER_SANITIZE_STRING));
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
        <title>NAT Department</title>
    </head>


<body>


<div class="w3-bar w3-light-grey">
    <a href="NAT.php" class="w3-bar-item w3-button">NAT Department Home</a>     <!-- NAT Department home button -->
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
                                              <th> Result</th>
                                              <th>Modife</th>
                                          </tr>';
        foreach ($units as $unit) {

            echo "   <tr>
                                                <td>" . $unit['unitNo'] . "</td>
                                                 <td><a  class=\"w3-btn w3-gray\" href='NAToperation.php ?do=insert& unit=" . $unit['unitNo'] . "'>Insert </a></td>
                                                 <td><a  class=\"w3-btn w3-gray\" href='NAToperation.php ?do=update& unit=" . $unit['unitNo'] . "'>update </a></td>
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