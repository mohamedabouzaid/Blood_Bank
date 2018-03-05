<?php

session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='Nurse_2') {


    if (isset($_POST['save'])) {
        include '../model/NurseModel.php';

        $result = NurseModel::insertComponent($_POST['NID'], $_POST['centrifuge'], $_POST['unit'], $_POST['timeCollected'],
            $_POST['timeSeparated'], $_POST['prbc'], $_POST['pc'], $_POST['ffp'], $_POST['cryo'], $_POST['wb'],
            $_POST['Fprbc'], $_POST['Fpc'], $_POST['bag']);
        $_SESSION['operation'] = $result;
        header('location:nurse.php');

    } else {


        ?>


        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <meta charset="UTF-8">
            <title>Clinic</title>
        </head>


    <body>


    <div class="w3-bar w3-light-grey">
        <a href="nurse.php" class="w3-bar-item w3-button">Nurse Home</a>     <!-- nurse home button -->
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
        //is already inserted
    include '../model/NurseModel.php';
    $check = NurseModel::searchComponent($_GET['nid']);
    if ($check) {
    echo "Blood Component is already inserted";

    }


    ?>
    <h3>Entre Blood Component:<?php echo $_GET['nid']; ?>
    </h3>
    <div class="w3-responsive">
        <form action="" method="post">

            <table class="w3-table-all w3-small">
                <thead>
                <tr class="w3-blue">
                    <th rowspan="3">Centrifuge no.</th>
                    <th rowspan="3">Unit no</th>
                    <th rowspan="3">Time Blood Collected</th>
                    <th rowspan="3"> Time Blood separated</th>
                    <th colspan="9"> Type of component</th>
                </tr>
                <tr class="w3-blue">
                    <th rowspan="2"> PRBC'S</th>
                    <th rowspan="2">PC</th>
                    <th rowspan="2">FFP</th>
                    <th rowspan="2">Cryo</th>
                    <th colspan="3">Filt</th>
                    <th rowspan="2">Bag Type</th>
                </tr>
                <tr class="w3-blue">
                    <th>WB</th>
                    <th> PRBC'S</th>
                    <th>PC</th>

                </tr>
                </thead>
                <tr>
                    <td><input type="text" name="centrifuge">
                    <td><input type="text" name="unit">
                    <td><input type="text" name="timeCollected">
                    <td><input type="text" name="timeSeparated">

                    <td><input type="text" name="prbc">
                    <td><input type="text" name="pc">
                    <td><input type="text" name="ffp">
                    <td><input type="text" name="cryo">

                    <td><input type="text" name="wb">
                    <td><input type="text" name="Fprbc">
                    <td><input type="text" name="Fpc">

                    <td><input type="text" name="bag">

                </tr>
            </table>
            <input type="hidden" value="<?php echo $_GET['nid']; ?>" name="NID">
            <input type="submit" value="Save" name="save">
        </form>
    </div>
        <?php


}
    }


//no permission to access page
else{

    header('location:Login.php');

}