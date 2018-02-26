<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 6:54 PM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='physician')
{
    //search
    if(isset($_POST['search'])) {
        include '../model/physician.php';
        new physician();
        $users=physician::search(filter_var($_POST['search'], FILTER_SANITIZE_NUMBER_INT));
    }

    //all accept  donar
    elseif (isset($_GET['do'])&&$_GET['do']=='accept'){

        include '../model/physician.php';
        new physician();
        $users=physician::getAllAccept(0);

}

//all reject donar
elseif (isset($_GET['do'])&&$_GET['do']=='reject'){


    include '../model/physician.php';
    new physician();
    $users=physician::getAllAccept(1);


}

    //get all use
    else{
        include '../model/physician.php';
        new physician();
        $users= physician::userAll();

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
    <a href="physician.php" class="w3-bar-item w3-button">Clinic Home</a>     <!-- clinic home button -->
    <a href="physician.php?do=accept" class="w3-bar-item w3-button">Accept</a>     <!-- accept donar button -->
    <a href="physician.php?do=reject" class="w3-bar-item w3-button">Reject</a>     <!-- reject donar button -->
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
                                              <th>رقم السجل القومى /الاقامه</th>';
        //reject ,accept modife
                                             if (isset($_GET['do'])){echo '<th>modife</th>';}
                                              else{echo '<th> Result</th>';}
                                          echo '</tr>';
        foreach ($users as $user) {

            echo "   <tr>
                                                <td>" . $user['donar_NID'] . "</td>";
                                                if(isset($_GET['do'])){echo " <td><a  class=\"w3-btn w3-gray\" href='physicianOperation.php ?do=update& nid=" . $user['donar_NID'] . "'>update</a></td>";}
                                                else{echo"  <td><a  class=\"w3-btn w3-gray\" href='physicianOperation.php ?do=check& nid=" . $user['donar_NID'] . "'>check</a></td>";}

                                                echo  "</tr>";

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
?>