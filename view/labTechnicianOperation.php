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
    <!-- <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>clinic</title>
    </head>
    <body>
    <div class="w3-bar w3-light-grey">
        <a href="labTechnician.php" class="w3-bar-item w3-button">Whole blood donation</a>     <!-- clinic home button
        <div class="w3-dropdown-hover">
            <!-- user name 
            <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button 
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
    form{
        background: #b9403ed4;
        padding: 17px;
        border-radius: 10px;
        box-shadow: 0 0 20px 1px #000;
    }
    .table>tbody>tr>th {
        text-align: center;
    }
    .btn-default{
       float: right; 
       margin-right: 11px;
    }
    h3{
        text-align: center;
        background:#ffffffeb;
        padding: 10px;
        border-radius: 10px;
    }
    </style>
</head>

<body>
    
    <header class="container">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li class="active">
                         <a href="labTechnician.php" >Whole blood donation</a>     <!-- clinic home button -->
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
    include '../model/physician.php';
    //update
    if($_GET['do']=='update'){
        if(physician::search($_GET['nid']) !=null){
        $edits=physician::search($_GET['nid']);
        $edit=$edits[0];}

        else{ echo '<h3 class="col-md-10 col-md-offset-1" style="margin-top: 75px;  background:#ffffffeb; text-align:center">You Must insert first</h3>';

            exit();

        }
    }



    // is already inserted
    if(physician::search($_GET['nid']) !=null && $_GET['do']=='insert'){

        echo '<h3 class="col-md-10 col-md-offset-1" style="margin-top: 75px;  background:#ffffffeb; text-align:center">You Already insert</h3>';

        exit();

    }
    else {


        ?>


        <!--insert Health Information  -->
        <h3 class="col-md-10 col-md-offset-1">Entre donar Health Information :<?php echo $_GET['nid']; ?>
        </h3>

        
        <form action="" method="post" class="col-md-10 col-md-offset-1">


            <table class="table table-hover">
                <tr >
                    <th>Weight(KG)</th>
                    <th>Height(cm)</th>
                    <th>Temp(c)</th>
                    <th> Blood Group</th>
                    <th>HB(g/d)</th>
                    <th>Pluse(bpm)</th>
                    <th>Bp(mmHg)</th>
                </tr>
                <tr>
                    <td><input class="form-control" type="number" name="weight" <?php if(isset($edit)){echo "value='".$edit['weight']."'" ;} ?>required></td>
                    <td><input class="form-control" type="number" name="height" <?php if(isset($edit)){echo "value='".$edit['height']."'" ;} ?> required></td>
                    <td><input class="form-control" type="number" name="temp"  <?php if(isset($edit)){echo "value='".$edit['temp']."'" ;} ?>required></td>
                    <td> <select class="form-control" required name="blood">
                            <?php if(isset($edit)) {echo '<option value="'.$edit['bloodGroup'].'">'.$edit['bloodGroup'].'</option>';}?>
                            <option value="A−">A−</option>
                            <option value="A+">A+</option>
                            <option value="B−">B−</option>
                            <option value="B+">B+</option>
                            <option value="AB−">AB−</option>
                            <option value="AB+">AB+</option>
                            <option value="O−">O−</option>
                            <option value="O+">O+</option>

                          </select>
                    </td>
                    <td><input class="form-control" type="number" name="hp"  step="any"<?php if(isset($edit)){echo "value='".$edit['hp']."'" ;} ?> required></td>
                    <td><input class="form-control" type="number" name="pluse"  step="any"<?php if(isset($edit)){echo "value='".$edit['pluse']."'" ;} ?>  required></td>
                    <td><input class="form-control" type="number" name="bp"   step="any" <?php if(isset($edit)){echo "value='".$edit['bp']."'" ;} ?>required></td>

                </tr>
            </table>
            <input type="hidden" value="<?php echo $_GET['nid']; ?>" name="NID">
            <input type="hidden" value="<?php echo $_GET['do']; ?>" name="do">
            <input type="submit" value="Save" name="save" class = "btn btn-default" >
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