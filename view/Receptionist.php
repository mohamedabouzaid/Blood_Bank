<?php
/*
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/1/2018
 * Time: 1:18 AM
 */

session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='Receptionist')

{
        //search
        if(isset($_POST['search'])) {
          include '../model/Receptionist.php';
          new Receptionist();
          $users=Receptionist::search(filter_var($_POST['search'],FILTER_SANITIZE_NUMBER_INT));
          }
          elseif (isset($_GET['do'])&&$_GET['do']=='friend'){


              include '../model/Receptionist.php';
              $users=Receptionist::getFriend();

          }

          //get all use
        else{
            include '../model/Receptionist.php';
            new Receptionist();
            $users= Receptionist::getALLUsers();

        }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>Receptionist</title>
    </head>


    <body>


        <div class="w3-bar w3-light-grey">
            <a href="Receptionist.php" class="w3-bar-item w3-button">Receptionist Home</a>     <!-- receptionist home button -->
            <a href="../view/ReceptionistOperation.php" class="w3-bar-item w3-button"> create file</a>    <!-- insert user button -->
            <a href="?do=friend" class="w3-bar-item w3-button"> Blood Bank friends </a>
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







    </body>
</html>
    <?php
    //table of user
    if($users!= null)
    {
        echo '<table  class="w3-table w3-striped">
                                          <caption >Users</caption>
                                          <tr class="w3-blue">
                                              <th>رقم السجل القومى /الاقامه</th>
                                              <th>الاسم الاول</th>
                                              <th>الاسم الثانى</th>
                                              <th>الاسم الثالث </th>
                                              <th>اسم العائله</th>';
                                               if(isset($_GET['do'])){echo '<th> رقم الهاتف</th>';}
                                              echo '<th> Modify</th>
                                          
                                                        </tr>';
        foreach ($users as $user) {

            echo "   <tr>
                                                <td>" . $user['NID'] . "</td>
                                                <td>" . $user['firstName'] . "</td>
                                                <td>" . $user['secondName'] . "</td>
                                                <td>" . $user['thirdName'] . "</td>
                                                 <td>" . $user['familyName'] . "</td>";
                                             if(isset($_GET['do'])){echo "<td>". $user['phone']." </td>";}
            echo  "  <td><a  class=\"w3-btn w3-gray\" href='ReceptionistOperation.php ?do=edit& user=" . serialize($user) . "'>edit</a></td>
                               
                                               
                                               
                                             </tr>";

        }
        echo    "</table>";


    }
    //no user found in table
    else{

        echo  "no user found ";

    }




//display the out put of operation

    if(isset($_SESSION['receptionistOperation'])&& $_SESSION['receptionistOperation']!=null){
      echo $_SESSION['receptionistOperation'];
       $_SESSION['receptionistOperation']=null;


     }

}
//no permission to access page
else{

    header('location:Login.php');

}

?>