<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin') {

    include '../model/User.php';

    //search
    if(isset($_POST['search'])) {

        $employees=User::search(filter_var($_POST['search'], FILTER_SANITIZE_STRING));

    }

    else{

       $employees=User::allEmployee();

    }
    //delete
    if(isset($_GET['do'] )&& $_GET['do']=='delete'){

        $_SESSION['operation']=User::delete($_GET['nid']);


    }


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
    <a href="" class="w3-bar-item w3-button">Create Empolyee</a>

        <!--    search    -->
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
    if($employees!= null)
    {
        echo '<table  class="w3-table w3-striped">
                                          <caption >Employees</caption>
                                          <tr class="w3-blue">
                                              <th>رقم السجل المدنى</th>
                                              <th>الاسم</th>
                                              <th>المهنه</th>
                                               <th>Edit</th>
                                                <th>Delete</th>
                                          </tr>';
        foreach ($employees as $employee) {

            echo "   <tr>
                                                <td>" . $employee['NID'] . "</td>
                                                <td>" .  $employee['userName'] . "</td>
                                                 <td>" . $employee['job'] . "</td>
                                                 <td><a  class=\"w3-btn w3-gray\" href=''>Update </a></td>
                                                  <td><a  class=\"w3-btn w3-gray\" href='?do=delete& nid=".$employee['NID']."'>Delete </a></td>
                                                 
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
else {

    header('location:Login.php');

}
