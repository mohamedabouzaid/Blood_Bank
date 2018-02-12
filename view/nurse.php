<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/7/2018
 * Time: 4:58 PM
 */
session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='nurse')
{

     //search
    if(isset($_POST['search'])) {
        include '../model/physician.php';
        $users=physician::search(filter_var($_POST['search'], FILTER_SANITIZE_NUMBER_INT));
    }

    else{
    //accept donar
  include '../model/physician.php';
  $users=physician::getAllAccept(0);

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
    <a href="nurse.php" class="w3-bar-item w3-button">Nurse Home</a>     <!-- nurse home button -->
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
    if($users!= null)
    {
        echo '<table  class="w3-table w3-striped">
                                          <caption >Users</caption>
                                          <tr class="w3-blue">
                                              <th>رقم السجل القومى /الاقامه</th>
                                              <th> Blood Information</th>
                                          </tr>';
        foreach ($users as $user) {

            echo "   <tr>
                                                <td>" . $user['donar_NID'] . "</td>
                                                 <td><a  class=\"w3-btn w3-gray\" href='nurseOperation.php ?do=insert& nid=" . $user['donar_NID'] . "'>Insert blood</a>
                                                 <a  class=\"w3-btn w3-gray\" href='nurseOperation.php ?do=component& nid=" . $user['donar_NID'] . "'> blood  component</a></td>
                                                 
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


    if(isset($_SESSION['operation'])&&$_SESSION['operation']!=null){


        echo $_SESSION['operation'];
        $_SESSION['operation']=null;

    }



}
//no permission to access page
else{

    header('location:Login.php');

}