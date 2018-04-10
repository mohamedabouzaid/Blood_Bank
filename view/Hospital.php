<?php
include '../model/hospital.php';
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='lab' || $_SESSION['job']=='Empolyee of hospital')
{
    if(isset($_POST['save'])){
    $employee_id=hospital:: searchID($_SESSION['userName']);
    $result=hospital::insert($employee_id,$_POST['order']);


    }

    ?>



<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital</title>
    <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/css/Questionnaire.css">
    <link rel="stylesheet" href="../resource/css/header.css">
    <link rel="stylesheet" href="../resource/css/Recieptionist.css">
    <style>
        .col-md-4>h3{color:#fff}
        .col-md-4{
            background: #e24440;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
        }
        #container-table {
             margin-top: 156px;
        }
        header{
            background: #FFF;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 5;
            padding: 7px;
        }
      
        .center{
            text-align:center
        }
        .right{
            float:right;
            color: #FFF
        }
        .table>tbody>tr>th {
            color: #fffffff2;
            text-align: center;
        }
        input[type="number"]{
            color: #666;
        }
    </style>
</head>

<body>
    
    <header class="">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               
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
        <div class="blure-body" style="background: #84101582; margin-top:47px;"></div>










        <div class="col-md-4 col-md-offset-4"  id="container-table">
            <h3 class="center"> مرحباً بكم في بنك الدم المركزي في منطقة الطائف </h3>
       
        <form method="post" action="">
            
            <div class="form-group">
                <label class="right">لطلبات الدم اكتب طلبك هنا</label>
                 <input type="text" class="form-control" name="order" required>
            </div>
            <div class="form-group">
                <input class="btn btn-danger col-md-6 col-md-offset-3" type="submit" name="save">
            </div> 
        </form>
        </div>
    <?php
    if(isset($result)){

        echo $result;
    }

}
//no permission to access page
else{

    header('location:Login.php');

}