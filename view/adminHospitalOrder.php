<?php
include '../model/hospital.php';
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin') {

    $orders=hospital::search();

    ?>



<!DOCTYPE html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Manage Employees</title>
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
            margin-top:29px;
        }
        #container-table {
            margin-top: 74px;
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
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li>
                         <a href="admin.php" >Admin Home</a>
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
        <div class="blure-body" style="background: #84101582; margin-top:47px;"></div>

    <?php


    if($orders!= null)
    {
        echo '
        <div class="col-md-10 col-md-offset-1"  id="container-table" style="background: #e87e7900;">
             <table  class="table table-hover">
                                          <caption >Hospital Orders</caption>
                                          <tr class="center">
                                              <th>Order</th>
                                              <th> National_id of Hospital Employee </th>
                                              
                                
                                          </tr>';
        foreach ($orders as $order) {

            echo "   <tr class='center'>
                                                <td>" . $order['bloodOrder'] . "</td>
                                                <td>" . $order['empployee_id'] . "</td>
                                                 
                                                </tr>";

        }
        echo "</table> </div>";
        echo '
        <button onclick="topFunction()" id="myBtn" title="Go to top"><span class="glyphicon glyphicon-chevron-up"></span></button>
        
        <script> 
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        </script>';
        
    }

       else {
           echo '<h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">
           NO ORDER</h3>';
       }
}
else {

    header('location:Login.php');

}