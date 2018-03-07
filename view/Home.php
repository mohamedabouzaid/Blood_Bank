<?php
session_start();
include '../controller/user/CheckUser.php';

if(isset($_POST['NID']) && $_POST['NID'] ){


    if(strlen($_POST['NID'])!=10){


        $_SESSION['error']="national id must be 10 number";
        header('location:Home.php');
        exit();
    }

    include '../model/Receptionist.php';
    new Receptionist();
    include "../model/donar.php";
    new donar();
    $search=Receptionist::search(filter_var($_POST['NID'],FILTER_SANITIZE_NUMBER_INT));

if($search){



        $_SESSION['donar_id'] = $_POST['NID'];
        foreach ($search as $donar) {
            $_SESSION['donar_name'] = $donar['firstName'];
        }

        header('location:Questionnaire.php');




}
 else{

        $_SESSION['error']="You shoud insert your data in receptionist ";
        header('location:Home.php');
        exit();
    }
}





?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blood Bank</title>
  <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
  <link rel="stylesheet" href="../resource/css/home.component.css">
  <link rel="stylesheet" href="../resource/css/header.css">
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
            <li class="active"><a href="Home.php"> Home</a> </li>      <!-- Home button-->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a class="btn" id="login" href="Login.php">Login</a> </li>       <!-- login button-->
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="blur-body"></div>
  <div id="carousel-example-generic" class="carousel slide col-xs-12" data-ride="carousel">

    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="../resource/images/1.jpeg" alt="...">
      </div>
      <div class="item">
        <img src="../resource/images/5.jpg"   alt="...">
      </div>
      <div class="item">
        <img src="../resource/images/3.jpg"  alt="...">
      </div>
      <div class="item">
        <img src="../resource/images/4.jpg"   alt="...">
      </div>
    </div>
  </div>


  <div class="blure col-xs-4 col-md-offset-4">
        <h1>Questionnaire</h1>
        <form action="" method="post">
            <div class="input-group">
                <label>
                : ادخل رقم السجل المدنى /الاقامه للاجابه على الاسئله
                </label>
                <input class="form-control input-lg" type="number" name="NID" required min="0">
            </div>
            <br>
            <?php
            //operation
            if (isset($_SESSION['Questionnire'])&&$_SESSION['Questionnire']!=Null){
                echo $_SESSION['Questionnire'];
                $_SESSION['Questionnire']=Null;
            }?>
            <?php
            //error
            if (isset($_SESSION['error'])&&$_SESSION['error']!=Null){
                echo $_SESSION['error'];
                $_SESSION['error']=Null;
            }?>


            <button class="btn col-xs-12" type="submit" value="دخول">دخول</button>
        </form>
   </div>

<script src="../resource/js/jquery.min.js"></script>
<script src="../resource/js/bootstrap.min.js"></script>

</body>
</html>

<!-- 

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Home</title>
    </head>
    <body>
        <div class="w3-container w3-gray">
            <a href="Login.php"><h2>Login</h2></a>                      <!--login page-->
        <!-- </div> -->
<!-- 
        <center>
            <h3>  questionnaire   </h3><br>                    <!--questionnaire for user
            <form action="Questionnaire.php" method="post">
                ادخل رقم السجل المدنى /الاقامه للاجابه على الاسئله:<br>
                <input type="number" name="NID" required>
                <input type="submit" value="دخول">
            </form>
        </center>
    </body>
</html>  -->
