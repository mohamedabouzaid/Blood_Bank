
<?php
session_start();
include '../controller/user/CheckUser.php';    //session of user and job
?>



<!DOCTYPE html>
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
        </div>

        <center>
            <h3>  questionnaire   </h3><br>                    <!--questionnaire for user-->
            <form action="Questionnaire.php" method="post">
                ادخل رقم السجل المدنى /الاقامه للاجابه على الاسئله:<br>
                <input type="number" name="NID" required>
                <input type="submit" value="دخول">
            </form>
        </center>
    </body>
</html>
