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
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>Hospital</title>
    </head>


<body>

        <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>


            <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button -->


        <div align="center">
        <h3 > مرحباً بكم في بنك الدم المركزي في منطقة الطائف </h3>
        <br >لطلبات الدم اكتب طلبك هنا
        <form method="post" action="">
        <input type="text" name="order">
        <input type="submit" name="save">
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