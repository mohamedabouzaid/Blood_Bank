<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/13/2018
 * Time: 1:28 AM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='malaria')
{
    if(isset($_POST['save']))
    {
        include "../model/malaria.php";
        $result= malaria::insert($_POST['unitNo'],$_POST['test']);
        $_SESSION['operation']= $result;
        header('location:NAT.php');
    }
    else {




        ?>


        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <meta charset="UTF-8">
            <title>Malaria Department</title>
        </head>


    <body>


    <div class="w3-bar w3-light-grey">
        <a href="malaria.php" class="w3-bar-item w3-button">Malaria Department Home</a>     <!-- Malaria Department home button -->

        <div class="w3-dropdown-hover">
            <!-- user name -->
            <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>
                <!-- logout button -->
            </div>
        </div>


    </div>

    <?php
    // already inserted
    include "../model/malaria.php";
    $search=malaria::search($_GET['unit']);
    if($search){

        echo "Result already inserted";
        die();

    }

    ?>





    <h3><?php echo 'Unit NO:  ' . $_GET['unit'] ?> </h3>
    <h5>Enter the Result of Test: </h5>
    <form method="post" action="">

        <input type="radio" name="test" value="+"> +<br>
        <input type="radio" name="test" value="-">-<br><br>
        <input type="hidden" name="unitNo" value="<?php echo $_GET['unit'] ?> ">

        <input type="submit" value="Save" name="save">


    </form>



        <?php


    }
}

//no permission to access page
else{

    header('location:Login.php');

}