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
<!-- 

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
        <a href="nurse.php" class="w3-bar-item w3-button">Nurse Home</a>     <!-- nurse home button --
        <div class="w3-dropdown-hover">
            <!-- user name --
            <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>
                <!-- logout button --
            </div>
        </div>


    </div> -->


    <!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clinic</title>
    <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/css/Questionnaire.css">
    <link rel="stylesheet" href="../resource/css/header.css">
    <link rel="stylesheet" href="../resource/css/Recieptionist.css">
    <style>
        .col-md-12{
            background: #b9403ed4;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
            margin-top:29px;
        }
        .col-md-10{
            background: #FFF;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
            margin-top:29px;
            text-align: center;
        }
        label{
            color:#EEE;
        }
        th{
            text-align: center;
        }
    </style>
</head>

<body>
    
    <header class="container" >
        <nav class="navbar navbar-default ">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li >
                         <a href="nurse.php">Nurse Home</a>     <!-- nurse home button -->
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                   <span class="name"> <?php echo $_SESSION['userName'] ?></span>
                </li>
                <li><a class="btn" id="login" href="../controller/user/Logoutcontroller.php">Logout</a> </li>       <!-- login button-->
            </ul>
            </div>
        </div>
        </nav>
    </header>

        <img src="../resource/images/3.jpg" alt="" class="bg-image" style="margin-top:7px">
        <div class="blure-body" style="background: linear-gradient(to left, #ffffff00 ,#f85f65b8);"></div>




    <?php
        //is already inserted
    include '../model/NurseModel.php';
    $check = NurseModel::searchComponent($_GET['nid']);
    //insert
    if($_GET['do']=='insert'){

        if ($check) {
        echo '<h3 class="col-md-10 col-md-offset-1">Blood Component is already inserted </h3>';
        exit();
    }}
    else{
        if($check==null){


            echo '<h3 class="col-md-10 col-md-offset-1">Insert Blood component first </h3>';
            exit();
        }
        $edit=$check[0];

    }



    $times=NurseModel::search($_GET['nid']);
    $time_Collected=$times[0];



    ?>
    <h4 class="col-md-10 col-md-offset-1">Entre Blood Component:<?php echo $_GET['nid']; ?>
    </h4>
    <div class="col-md-12">
        <form action="" method="post">
            <div class="form-inline">
                <div class="form-group ">
                    <label> Day:</label>
                    <input type="text" class="form-control " name="daySelect" <?php if(isset($edit)){ echo "value='".$edit['daySelect']."'" ;} else{echo "value='". date("l")."'" ;}?> readonly>
                </div>
                <div class="form-group ">
                    <label> Date:</label>
                <input  type="text" class="form-control " name="dateSelect"   <?php if(isset($edi)){ echo "value='".$edit['dateSelect']."'" ;} else{echo "value='". date("m/d/Y")."'" ;}?> readonly>
                </div>
            </div>
            <table  class="table table-hover">
                <thead>
                <tr >
                    <th rowspan="3">Centrifuge no.</th>
                    <th rowspan="3">Unit no</th>
                    <th rowspan="3">Time Blood Collected</th>
                    <th rowspan="3"> Time Blood separated</th>
                    <th colspan="10"> Type of component</th>
                </tr>
                <tr >
                    <th rowspan="2"> PRBC'S</th>
                    <th rowspan="2">PC</th>
                    <th rowspan="2">FFP</th>
                    <th rowspan="2">Cryo</th>
                    <th colspan="3">Filt</th>
                    <th rowspan="2">Bag Type</th>
                    <th rowspan="2">ABO RH</th>
                    <th rowspan="2">Note</th>
                </tr>
                <tr >
                    <th>WB</th>
                    <th> PRBC'S</th>
                    <th>PC</th>

                </tr>
                </thead>
                <tr>
                    <td><input class="form-control" type="text" name="centrifuge" <?php if(isset($edit)){ echo "value='".$edit['centerNo']."'" ;}?>>
                    <td><input class="form-control" type="text" name="unit" <?php if(isset($edit)){ echo "value='".$edit['unitNo']."'" ;}?>>
                    <td><input class="form-control" type="time" name="timeCollected" value="<?php echo $time_Collected['timeCollection'] ?>" readonly>
                    <td><input class="form-control" type="time" name="timeSeparated" <?php if(isset($edit)){ echo "value='".$edit['timeSeparated']."'" ;}?>>

                    <td><select class="form-control" name="prbc">
                            <?php if(isset($edit)){ echo'<option value="'.$edit['prbc'].'">'.$edit['prbc'].'</option> ';}?>
                        <option value="less collection">less collection</option>
                        <option value="high collection">high collection</option>
                        <option value="open system">open system</option>
                        <option value="hanging">hanging</option>
                        <option value="none">none</option>
                        </select></td>


                    <td><select class="form-control" name="pc">
                            <?php if(isset($edit)){ echo'<option value="'.$edit['pc'].'">'.$edit['pc'].'</option> ';}?>
                            <option value="open system">open system</option>
                            <option value="bloody">bloody</option>
                            <option value="lipemic">lipemic</option>
                            <option value="no space">no space</option>
                            <option value="none">none</option>
                        </select></td>




                    <td><select class="form-control" name="ffp">
                            <?php if(isset($edit)){ echo'<option value="'.$edit['ffp'].'">'.$edit['ffp'].'</option> ';}?>
                            <option value="open system">open system</option>
                            <option value="bloody">bloody</option>
                            <option value="lipemic">lipemic</option>
                            <option value="no space">no space</option>
                            <option value="none">none</option>
                        </select></td>



                    <td><input class="form-control" type="text" name="cryo" <?php if(isset($edit)){ echo "value='".$edit['cryo']."'" ;}?>>

                    <td><input class="form-control" type="text" name="wb" <?php if(isset($edit)){ echo "value='".$edit['Fwb']."'" ;}?>>
                    <td><input class="form-control" type="text" name="Fprbc" <?php if(isset($edit)){ echo "value='".$edit['Fprbc']."'" ;}?>>
                    <td><input class="form-control" type="text" name="Fpc" <?php if(isset($edit)){ echo "value='".$edit['Fpc']."'" ;}?>>

                    <td><input class="form-control" type="text" name="bag" <?php if(isset($edit)){ echo "value='".$edit['bagType']."'" ;}?>>
                    <td><input class="form-control" type="text" name="ABO" <?php if(isset($edit)){ echo "value='".$edit['ABO']."'" ;}?>>
                    <td><input class="form-control" type="text" name="note" <?php if(isset($edit)){ echo "value='".$edit['note']."'" ;}?>>

                </tr>
            </table>

            <div class="form-group col-xs-4">
                    <label > Performed By</label>
                    <input class="form-control" type="text" name="performed" <?php if(isset($edit)){ echo "value='".$edit['performed']."'" ;}?>>
            </div>

            <div class="form-group col-xs-4">
                    <label > Approved By</label>
                    <input class="form-control" type="text" name="approved" <?php if(isset($edit)){ echo "value='".$edit['approved']."'" ;}?> >
            </div>

            <div class="form-group col-xs-4">
                    <label > Signature</label>
                    <input class="form-control" type="text" name="sign"  <?php if(isset($edit)){ echo "value='".$edit['sign']."'" ;}?>>
            </div>

            <input type="hidden" value="<?php echo $_GET['nid']; ?>" name="NID">
            <input class="btn btn-default col-md-1" style="float: right; margin-right:13px;"type="submit" value="Save" <?php if(isset($edit)){ echo "name='edit'" ;}
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