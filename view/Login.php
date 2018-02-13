<?php
session_start();
include'../controller/user/CheckUser.php';    // session check user job
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Blood Bank</title>
      <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
      <link rel="stylesheet" href="../resource/css/login.css">
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
                                <li class=""><a href="Home.php"> Home</a> </li>      <!-- create button-->
                              </ul>
                        </div>
                  </div>
            </nav>
    </header>


<div class="blur-body"></div>
  <div id="carousel-example-generic" class="carousel slide " data-ride="carousel">
          <div class="blure col-xs-4">
                <div class="login-header">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                      <h1>Login</h1>
        </div>
              <form action="../controller/user/LoginController.php" method="post">
                              <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">
                     <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                 </span>
                                      <input type="text" required name="username" class="form-control input-lg" placeholder="Username" aria-describedby="basic-addon1">
                                  </div>
                             <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">
                     <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                 </span>
                                      <input type="password" required name="password" class="form-control input-lg" placeholder="Password" aria-describedby="basic-addon1">
                                  </div>
                              <br>
                              <button class="btn" type="submit" value="login"> Login </button>
                         </form>
                    </div>

            <div class="title col-md-7">
                  <img src="../resource/images/blood_logo.png" alt="logo" >
                  <h1>Central blood bank management system</h1>
                </div>



          <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
              </ol>

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

<script src="../resource/js/jquery.min.js"></script>
<script src="../resource/js/bootstrap.min.js"></script>

</body>
</html>

            <!-- <div class="w3-container w3-gray">
              <!-- home page--
             <a href="Home.php"><h2>Home</h2></a>      <!-- home page--
         </div>

                    <!--login form
        <div class="w3-container w3-blue">
            <h2>Login Form</h2>
        </div>
        <form class="w3-container"action="../controller/user/LoginController.php" method="post">
            <p>
                <label>User Name</label>
                <input class="w3-input" type="text"name="userName"></p>
            <p>
                <label>Password</label>
                <input class="w3-input" type="password" name="password"></p>
            <p>

                <input type="submit" value="Login"></p>
        </form>



    </body>
</html> -->


<?php

   //invalid username or password
if (isset($_SESSION['error'])&&$_SESSION['error']!=Null){
    echo
    $_SESSION['error'];
    $_SESSION['error']=Null;
}