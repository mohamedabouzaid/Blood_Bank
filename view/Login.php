<?php
session_start();
include'../controller/user/CheckUser.php';    // session check user job
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Login</title>
    </head>


    <body>
        <div class="w3-container w3-gray">
            <a href="Home.php"><h2>Home</h2></a>      <!-- home page-->
        </div>

                   <!--login form-->
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
</html>


<?php

   //invalid username or password
if (isset($_SESSION['error'])&&$_SESSION['error']!=Null){
    echo
    $_SESSION['error'];
    $_SESSION['error']=Null;
}