<?php

session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='Nurse_2' || $_SESSION['job']=='admin') {


    if (isset($_POST['save'])) {
        include '../model/NurseModel.php';
        $result = NurseModel::insertComponent($_POST['NID'], $_POST['centrifuge'], $_POST['unit'], $_POST['timeCollected'],
            $_POST['timeSeparated'], $_POST['prbc'], $_POST['pc'], $_POST['ffp'], $_POST['cryo'], $_POST['wb'],
            $_POST['Fprbc'], $_POST['Fpc'], $_POST['bag'],$_POST['ABO'],$_POST['note'],$_POST['daySelect'],$_POST['dateSelect']
        ,$_POST['performed'],$_POST['approved'],$_POST['sign']);

        $_SESSION['operation'] = $result;
        header('location:nurse.php');

    }elseif(isset($_POST['edit'])){


        include '../model/NurseModel.php';
        $result = NurseModel::updateComponent($_POST['NID'], $_POST['centrifuge'], $_POST['unit'], $_POST['timeCollected'],
            $_POST['timeSeparated'], $_POST['prbc'], $_POST['pc'], $_POST['ffp'], $_POST['cryo'], $_POST['wb'],
            $_POST['Fprbc'], $_POST['Fpc'], $_POST['bag'],$_POST['ABO'],$_POST['note'],$_POST['daySelect'],$_POST['dateSelect']
            ,$_POST['performed'],$_POST['approved'],$_POST['sign']);

        $_SESSION['operation'] = $result;
        header('location:nurse.php');

    }





    else {


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
    //insert
    if($_GET['do']=='insert'){

        if ($check) {
        echo "Blood Component is already inserted";
        exit();
    }}
    else{
        if($check==null){


            echo"Insert Blood component first";
            exit();
        }
        $edit=$check[0];

    }



    $times=NurseModel::search($_GET['nid']);
    $time_Collected=$times[0];



    ?>
    <h3>Entre Blood Component:<?php echo $_GET['nid']; ?>
    </h3>
    <div class="w3-responsive">
        <form action="" method="post">
            Day:<input type="text" name="daySelect" <?php if(isset($edit)){ echo "value='".$edit['daySelect']."'" ;} else{echo "value='". date("l")."'" ;}?> readonly>
            Date:<input  type="text" name="dateSelect"   <?php if(isset($edi)){ echo "value='".$edit['dateSelect']."'" ;} else{echo "value='". date("m/d/Y")."'" ;}?> readonly>
            <table class="w3-table-all w3-small">
                <thead>
                <tr class="w3-blue">
                    <th rowspan="3">Centrifuge no.</th>
                    <th rowspan="3">Unit no</th>
                    <th rowspan="3">Time Blood Collected</th>
                    <th rowspan="3"> Time Blood separated</th>
                    <th colspan="10"> Type of component</th>
                </tr>
                <tr class="w3-blue">
                    <th rowspan="2"> PRBC'S</th>
                    <th rowspan="2">PC</th>
                    <th rowspan="2">FFP</th>
                    <th rowspan="2">Cryo</th>
                    <th colspan="3">Filt</th>
                    <th rowspan="2">Bag Type</th>
                    <th rowspan="2">ABO RH</th>
                    <th rowspan="2">Note</th>
                </tr>
                <tr class="w3-blue">
                    <th>WB</th>
                    <th> PRBC'S</th>
                    <th>PC</th>

                </tr>
                </thead>
                <tr>
                    <td><input type="text" name="centrifuge" <?php if(isset($edit)){ echo "value='".$edit['centerNo']."'" ;}?>>
                    <td><input type="text" name="unit" <?php if(isset($edit)){ echo "value='".$edit['unitNo']."'" ;}?>>
                    <td><input type="time" name="timeCollected" value="<?php echo $time_Collected['timeCollection'] ?>" readonly>
                    <td><input type="time" name="timeSeparated" <?php if(isset($edit)){ echo "value='".$edit['timeSeparated']."'" ;}?>>

                    <td><select name="prbc">
                            <?php if(isset($edit)){ echo'<option value="'.$edit['prbc'].'">'.$edit['prbc'].'</option> ';}?>
                        <option value="less collection">less collection</option>
                        <option value="high collection">high collection</option>
                        <option value="open system">open system</option>
                        <option value="hanging">hanging</option>
                        <option value="none">none</option>
                        </select></td>


                    <td><select name="pc">
                            <?php if(isset($edit)){ echo'<option value="'.$edit['pc'].'">'.$edit['pc'].'</option> ';}?>
                            <option value="open system">open system</option>
                            <option value="bloody">bloody</option>
                            <option value="lipemic">lipemic</option>
                            <option value="no space">no space</option>
                            <option value="none">none</option>
                        </select></td>




                    <td><select name="ffp">
                            <?php if(isset($edit)){ echo'<option value="'.$edit['ffp'].'">'.$edit['ffp'].'</option> ';}?>
                            <option value="open system">open system</option>
                            <option value="bloody">bloody</option>
                            <option value="lipemic">lipemic</option>
                            <option value="no space">no space</option>
                            <option value="none">none</option>
                        </select></td>



                    <td><input type="text" name="cryo" <?php if(isset($edit)){ echo "value='".$edit['cryo']."'" ;}?>>

                    <td><input type="text" name="wb" <?php if(isset($edit)){ echo "value='".$edit['Fwb']."'" ;}?>>
                    <td><input type="text" name="Fprbc" <?php if(isset($edit)){ echo "value='".$edit['Fprbc']."'" ;}?>>
                    <td><input type="text" name="Fpc" <?php if(isset($edit)){ echo "value='".$edit['Fpc']."'" ;}?>>

                    <td><input type="text" name="bag" <?php if(isset($edit)){ echo "value='".$edit['bagType']."'" ;}?>>
                    <td><input type="text" name="ABO" <?php if(isset($edit)){ echo "value='".$edit['ABO']."'" ;}?>>
                    <td><input type="text" name="note" <?php if(isset($edit)){ echo "value='".$edit['note']."'" ;}?>>

                </tr>
            </table>

            Performed By<input type="text" name="performed" <?php if(isset($edit)){ echo "value='".$edit['performed']."'" ;}?>>
            Approved By<input type="text" name="approved" <?php if(isset($edit)){ echo "value='".$edit['approved']."'" ;}?> >
            Signature <input type="text" name="sign"  <?php if(isset($edit)){ echo "value='".$edit['sign']."'" ;}?>>


            <input type="hidden" value="<?php echo $_GET['nid']; ?>" name="NID">
            <input type="submit" value="Save" <?php if(isset($edit)){ echo "name='edit'" ;}
            else{echo "name='save'" ;}?>>
        </form>
    </div>
        <?php


}
    }


//no permission to access page
else{

    header('location:Login.php');

}