<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin') {

    include '../model/User.php';

    //search
    if(isset($_POST['search'])) {

        $employees=User::search(filter_var($_POST['search'], FILTER_SANITIZE_STRING));

    }

    else{

       $employees=User::allEmployee();

    }
    //delete
    if(isset($_GET['do'] )&& $_GET['do']=='delete'){

        $_SESSION['operation']=User::delete($_GET['nid']);
        header('location:adminManageEmployee.php');

    }


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
                    <li class="active">
                         <a href="adminManageEmployee.php" >Admin Manage Employees</a>     <!-- Admin Manage Employees Department home button -->
                    </li>
                    <li>
                         <a href="admin.php" >Admin Home</a>
                    </li>
                    <li>
                         <a href="adminEmployeeOperation.php?do=create" >Create Empolyee</a>
                    </li>
   
                </ul>
                <!-- search  -->
                <ul class="nav navbar-nav" style="margin: 9px 36px 0;">
                    <li>
                        <form class="form-inline" action="" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                <input class="form-control " type="text" name="search" placeholder="Search..." style="width: 296px">                                     
                            </div>
                            <button class="btn btn-danger" type="submit" value="search" style="margin-left: -4px"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </form>
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
    if($employees!= null)
    {
        echo '
        <div class="col-md-10 col-md-offset-1"  id="container-table" style="background: #e87e7900;">
             <table  class="table table-hover">
                                          <caption>Employees</caption>
                                          <tr class="center">
                                              <th>رقم السجل المدنى</th>
                                              <th>الاسم</th>
                                              <th>المهنه</th>
                                               <th>Edit</th>
                                                <th>Delete</th>
                                          </tr>';
        foreach ($employees as $employee) {

            echo "   <tr class='center'>
                                                <td>" . $employee['NID'] . "</td>
                                                <td>" .  $employee['userName'] . "</td>
                                                <td>" . $employee['job'] . "</td>
                                                <td><a  class=\"btn btn-default\" href='adminEmployeeOperation.php?do=edit&employee=" . serialize($employee) . "'>Update </a></td>
                                                <td><a  class=\"btn btn-default\" href='?do=delete& nid=".$employee['NID']."'>Delete </a></td>
                                                 
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
        </script>
        
        
        ';

        if(isset($_SESSION['operation'])&&$_SESSION['operation']!=null){

            echo $_SESSION['operation'];
            $_SESSION['operation']=null;

        }
    }
    //no user found in table
    else{

        echo  ' <h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">
        no user found </h3>';

    }




    }
else {

    header('location:Login.php');

}

