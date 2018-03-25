<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='lab_Technician' || $_SESSION['job']=='admin'){

    //insert data
    if(isset($_POST['save'])){
     include "../model/labTechnician.php";
     new labTechnician();
     print_r($_POST);
      if($_POST['do']=='insert'){
          $result=labTechnician::insert($_POST['NID'],$_POST['weight'],$_POST['height'],$_POST['temp'],
         $_POST['blood'],$_POST['hp'],$_POST['pluse'],$_POST['bp']);}

         else{

          $result= labTechnician::update($_POST['NID'],$_POST['weight'],$_POST['height'],$_POST['temp'],
              $_POST['blood'],$_POST['hp'],$_POST['pluse'],$_POST['bp']);

         }
        $_SESSION['labOperation']=$result;
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
        <a href="labTechnician.php" class="w3-bar-item w3-button">Whole blood donation</a>     <!-- clinic home button -->
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
    //update
    if($_GET['do']=='update'){
        if(physician::search($_GET['nid']) !=null){
        $edits=physician::search($_GET['nid']);
        $edit=$edits[0];}

        else{echo "The Health information did't inserte";
        exit();
        }
    }



    // is already inserted
    if(physician::search($_GET['nid']) !=null && $_GET['do']=='insert'){

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
                    <td><input type="number" name="weight" <?php if(isset($edit)){echo "value='".$edit['weight']."'" ;} ?>required></td>
                    <td><input type="number" name="height" <?php if(isset($edit)){echo "value='".$edit['height']."'" ;} ?> required></td>
                    <td><input type="number" name="temp"  <?php if(isset($edit)){echo "value='".$edit['temp']."'" ;} ?>required></td>
                    <td> <select required name="blood">
                            <?php if(isset($edit)) {echo '<option value="'.$edit['bloodGroup'].'">'.$edit['bloodGroup'].'</option>';}?>
                            <option value="A−">A−</option>
                            <option value="A+">A+</option>
                            <option value="B−">B−</option>
                            <option value="B+">B+</option>
                            <option value="AB−">AB−</option>
                            <option value="AB+">AB+</option>
                            <option value="O−">O−</option>
                            <option value="O+">O+</option>

                          </select
                    </td>
                    <td><input type="number" name="hp" <?php if(isset($edit)){echo "value='".$edit['hp']."'" ;} ?> required></td>
                    <td><input type="number" name="pluse" <?php if(isset($edit)){echo "value='".$edit['pluse']."'" ;} ?>  required></td>
                    <td><input type="number" name="bp"   <?php if(isset($edit)){echo "value='".$edit['bp']."'" ;} ?>required></td>

                </tr>
            </table>
            <input type="hidden" value="<?php echo $_GET['nid']; ?>" name="NID">
            <input type="hidden" value="<?php echo $_GET['do']; ?>" name="do">
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