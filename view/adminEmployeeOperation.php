<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin') {
include '../model/User.php';

if(isset($_POST['create'])){

        $result=User::insert($_POST['NID'],$_POST['userName'],$_POST['password'],
            $_POST['job']);
        $_SESSION['operation']=$result;
        header('location:adminManageEmployee.php');

}
    if(isset($_POST['edit'])){

    $result=User::update($_POST['NID'],$_POST['userName'],$_POST['password'],
        $_POST['job'],$_POST['oldNID']);
    $_SESSION['operation']=$result;
    header('location:adminManageEmployee.php');

}


    if($_GET['do']=='edit') {
        $edit=unserialize($_GET["employee"]);

    }


?>



<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/css/Questionnaire.css">
    <link rel="stylesheet" href="../resource/css/header.css">
    <link rel="stylesheet" href="../resource/css/Recieptionist.css">
    <style>
        .col-md-10{
            background: #e24440;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
            margin-top:89px;
        }
        header{
            background: #FFF;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 5;
            padding: 7px;
        }
        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #FFF;
            color: #555;
            cursor: pointer;
            padding: 12px;
            border-radius: 4px;
            font-size: 23px;
        }

        #myBtn:hover {
            background-color: #555;
            color: #FFF;
        }
        .center{
            text-align:center
        }
        .left{
            text-align:left
        }
        label.right{
            float:right;
            color:#FFF
        }
        .table>tbody>tr>th {
            color: #fffffff2;
            text-align: center;
        }
        h4{
            text-align: left;
            color: #fffffff2;
        }
        input[type="number"]{
            color: #666;
        }
    </style>
</head>

<body>
    
    <header class="">
        <nav class="navbar navbar-default container">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li >
                        <a href="adminManageEmployee.php">Admin Manage Employees</a>     <!-- Admin Department home button -->
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

        <img src="../resource/images/3.jpg" alt="" class="bg-image" style="margin-top:47px">
        <div class="blure-body" style="background: linear-gradient(to left, #ffffff00 ,#f85f65b8); margin-top:47px;"></div>



    <div  class="col-md-10 col-md-offset-1">
        <form action="" method="post">
            <?php if(isset($edit)){

            echo'    <input type="hidden" name="oldNID" value="'.$edit['NID'].'">';

            } ?>
            <div class="form-group">
                <label class="right">رقم السجل المدنى</label>
                <input type="number" class="form-control" name="NID" <?php if(isset($edit)){ echo "value='".$edit['NID']."'" ;}?>>
            </div>
            <div class="form-group">
                <label class="right">اسم الموظف</label>
                <input type="text" class="form-control" name="userName" <?php if(isset($edit)){ echo "value='".$edit['userName']."'" ;}?>>
            </div>
            <div class="form-group">
                <label class="right">كلمه السر</label>
                <input type="password" class="form-control" name="password" <?php if(isset($edit)){ echo "value='".$edit['password']."'" ;}?>>
            </div>
            <div class="form-group">
                <label class="right">الوظيفه</label>
                <select class="form-control" required name="job" >
                    <?php if(isset($edit)) {echo '<option value="'.$edit['job'].'">'.$edit['job'].'</option>';}?>
                            <option value="Receptionist">Receptionist</option>
                            <option value="lab_Technician">lab_Technician</option>
                            <option value="Physician">Physician</option>
                            <option value="Nurse">Nurse</option>
                            <option value="Nurse_2">Nurse_2</option>
                            <option value="lab">Lab</option>
                            <option value="medical_supervisor">medical_supervisor</option>
                            <option value="medical_director">medical_director</option>
                            <option value="Empolyee of hospital">Empolyee of hospital</option>
                    </select>
            </div>
            <div class="form-group">
                <input class="btn btn-default col-md-4 col-md-offset-4" type="submit" value="save" name="<?php echo $_GET['do'] ?>">
            </div>
        </form>
    </div>




<?php


}
else {

    header('location:Login.php');

}