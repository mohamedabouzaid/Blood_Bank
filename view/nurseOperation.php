<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/7/2018
 * Time: 6:33 PM
 */

session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='nurse') {


    if (isset($_POST['insert'])) {
//the comment
        if (!empty($_POST['comments_list'])) {
            $comment = implode('-', $_POST['comments_list']);
        } else {
            $comment = "other";
        }

//insert data of blood
        include '../model/NurseModel.php';
        $result = NurseModel::insert($_POST['ID_Blood'], $_POST['NID'], $_POST['bagWeight'], $_POST['bloodGroup'], $_POST['time'], $comment);

      echo "  <a  class=\"w3-btn w3-gray\" href='nurseOperation.php ?do=component& nid=" . $_POST['NID'] . "'> blood  component</a>";
       echo $result;
    }
//insert blood component
    elseif (isset($_POST['save'])){
        include '../model/NurseModel.php';

        $result = NurseModel::insertComponent($_POST['NID'],$_POST['centrifuge'],$_POST['unit'],$_POST['timeCollected'],
            $_POST['timeSeparated'],$_POST['prbc'],$_POST['pc'],$_POST['ffp'],$_POST['cryo'],$_POST['wb'],
            $_POST['Fprbc'],$_POST['Fpc'],$_POST['bag']);
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
        if($_GET['do']=='insert'){
        //is already inserted
        include '../model/NurseModel.php';
        $check = NurseModel::search($_GET['nid']);
        if ($check) {
        echo "Blood is already inserted";

        } else {

            ?>
            <h3>Blood sample of <?php echo $_GET['nid']; ?></h3>
            <!--form of blood information-->
            <form action="" method="post">

                <input type="radio" name="NID" required>Checked ID<br>
                Start time <i class="glyphicon glyphicon-time" id="start"></i> &nbsp; &nbsp; &nbsp;
                Stop time <i class="glyphicon glyphicon-time" id="time"></i><br>
                Sealed by ID<input type="number" name="ID_Blood"><br>
                Bag Weight <input type="number" name="bagWeight"><br>
                Time of collections<input type="number" name="time"><br>
                Confirmed Blood Group

             <select required name="bloodGroup">

                    <option value="A−">A−</option>
                    <option value="A+">A+</option>
                    <option value="B−">B−</option>
                    <option value="B+">B+</option>
                    <option value="AB−">AB−</option>
                    <option value="AB+">AB+</option>
                    <option value="O−">O−</option>
                    <option value="O+">O+</option>

                </select><br>


                <h5>Comments</h5>
                <input type="checkbox" name="comments_list[]" value="Slow bleed"> Slow bleed<br>
                <input type="checkbox" name="comments_list[]" value=" Aspirin"> Aspirin<br>
                <input type="checkbox" name="comments_list[]" value="Relative"> Relative<br>
                <input type="checkbox" name="comments_list[]" value="Other" > Other<br>
                <input type="hidden" name="NID" value="<?php echo $_GET['nid']; ?>">
                <input type="submit" value="Save" name="insert">

            </form>


            <script>

                //timer
                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i;
                    }
                    return i;
                }

                function endTime() {
                    var today = new Date();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    // add a zero in front of numbers<10
                    m = checkTime(m);
                    s = checkTime(s);
                    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
                    t = setTimeout(function () {
                        endTime()
                    }, 500);
                }

                endTime();


                function startTime() {
                    var today = new Date();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    // add a zero in front of numbers<10
                    m = checkTime(m);
                    s = checkTime(s);
                    document.getElementById('start').innerHTML = h + ":" + m + ":" + s;

                }

                startTime();


            </script>


            <?php


        }

        }
        //if do = component
        else{
                 //is already inserted
            include '../model/NurseModel.php';
            $check = NurseModel::searchComponent($_GET['nid']);
            if ($check) {
                echo "Blood Component is already inserted";

            }
            else {

            $check = NurseModel::search($_GET['nid']);
            if ($check ==Null) {
                echo "Blood must insert first";
                echo "  <a  class=\"w3-btn w3-gray\" href='nurseOperation.php ?do=insert& nid=" . $_GET['nid'] . "'> blood  component</a>";
               die();
            }



            ?>
             <h3>Entre Blood Component:<?php echo $_GET['nid']; ?>
        </h3>
        <div class="w3-responsive">
        <form action="" method="post">

            <table class="w3-table-all w3-small">
                <thead >
                <tr class="w3-blue">
                    <th rowspan="3">Centrifuge no.</th>
                    <th rowspan="3">Unit no</th>
                    <th rowspan="3">Time Blood Collected</th>
                    <th rowspan="3"> Time Blood separated</th>
                    <th colspan="9"> Type of component</th>
                </tr>
                <tr class="w3-blue">
                    <th rowspan="2"> PRBC'S</th>
                    <th rowspan="2" >PC</th>
                    <th rowspan="2" >FFP</th>
                    <th rowspan="2">Cryo</th>
                    <th colspan="3">Filt</th>
                    <th rowspan="2">Bag Type</th>
                </tr >
                <tr class="w3-blue">
                    <th>WB</th>
                <th > PRBC'S</th>
                <th  >PC</th>

                </tr>
                </thead>
               <tr>
                   <td><input type="text" name="centrifuge" >
                   <td><input type="text"  name="unit">
                   <td><input type="text" name="timeCollected">
                   <td><input type="text" name="timeSeparated" >

                   <td><input type="text" name="prbc" >
                   <td><input type="text"  name="pc">
                   <td><input type="text"  name="ffp">
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
    }
}


//no permission to access page
else{

    header('location:Login.php');

}