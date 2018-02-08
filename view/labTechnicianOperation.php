<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 4:06 PM
 */
//echo $_GET['nid'];
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='labTechnician'){

    //insert data
    if(isset($_POST['save'])){
     include "../model/labTechnician.php";
     new labTechnician();
     $reslt=labTechnician::insert($_POST['NID'],$_POST['weight'],$_POST['height'],$_POST['temp'],
         $_POST['blood'],$_POST['hp'],$_POST['pluse'],$_POST['bp']);
        $_SESSION['labOperation']=$reslt;
        header('location:labTechnician.php');
    }

    ///////////////



 ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>clinic</title>
    </head>
    <body>
    <div class="w3-bar w3-light-grey">
        <a href="labTechnician.php" class="w3-bar-item w3-button">Clinic Home</a>     <!-- clinic home button -->
        <div class="w3-dropdown-hover">
            <!-- user name -->
            <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button -->
            </div>
        </div>
    </div>

    <?php
    include '../model/physician.php';

    // is already inserted
    if(physician::search($_GET['nid']) !=null){

   echo "The Health information is already inserted";

    }
    else {


        ?>


        <!--insert Health Information  -->
        <h3>Entre donar Health Information :<?php echo $_GET['nid']; ?>
        </h3>

        <form action="" method="post">


            <table class="w3-table-all w3-small">
                <tr class="w3-blue">
                    <th>Weight(KG)</th>
                    <th>Height(cm)</th>
                    <th>Temp(c)</th>
                    <th> Blood Group</th>
                    <th>HB(g/d)</th>
                    <th>Pluse(bpm)</th>
                    <th>Bp(mmHg)</th>
                </tr>
                <tr>
                    <td><input type="number" name="weight" required></td>
                    <td><input type="number" name="height" required></td>
                    <td><input type="number" name="temp" required></td>
                    <td><input type="text" name="blood" required></td>
                    <td><input type="number" name="hp" required></td>
                    <td><input type="number" name="pluse" required></td>
                    <td><input type="number" name="bp" required></td>

                </tr>
            </table>
            <input type="hidden" value="<?php echo $_GET['nid']; ?>" name="NID">
            <input type="submit" value="Save" name="save">
        </form>
        </body>
        </html>
        <?php
    }
}
//no permission to access
else{
    header('location:Login.php');
}