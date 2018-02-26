<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 2:47 PM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='labTechnician'){
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
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>Clinic</title>
    </head>


    <body>


        <div class="w3-bar w3-light-grey">
            <a href="labTechnician.php" class="w3-bar-item w3-button">Whole blood donation</a>     <!-- clinic home button -->
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
    //table of user
    if($users!= null)
    {
        echo '<table  class="w3-table w3-striped">
                                          <caption >Users</caption>
                                          <tr class="w3-blue">
                                              <th>رقم السجل القومى /الاقامه</th>
                                              <th> Health Information</th>
                                              <th>Modife</th>
                                          </tr>';
        foreach ($users as $user) {

            echo "   <tr>
                                                <td>" . $user['donar_NID'] . "</td>
                                                 <td><a  class=\"w3-btn w3-gray\" href='labTechnicianOperation.php ?do=insert& nid=" . $user['donar_NID'] . "'>insert</a></td>
                                                 <td><a  class=\"w3-btn w3-gray\" href='labTechnicianOperation.php ?do=update& nid=" . $user['donar_NID'] . "'>update</a></td>
                                                </tr>";

        }
        echo    "</table>";

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