<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='medical_director' || $_SESSION['job']=='admin')
{


    //search
    if(isset($_POST['search']))
    {
        include '../model/director.php';
        $units=director::search(filter_var($_POST['search'], FILTER_SANITIZE_STRING));
    }


    //all accept  donar
    elseif (isset($_GET['do'])&&$_GET['do']=='accept'){

        include '../model/director.php';
        $units=director::All(0);

    }
    //all reject  donar
    elseif (isset($_GET['do'])&&$_GET['do']=='reject'){

        include '../model/director.php';
        $units=director::All(1);

    }




    else{

        include '../model/supervisor.php';
        $units=supervisor::All(0);
    }
    ?>


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
         .col-md-10{
            background: #e24440;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
        }
        #container-table {
            margin-top:45px;
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
                    <li>
                         <a href="director.php" class="w3-bar-item w3-button">Medical Director</a>   <!-- Director home button -->
                    </li>
                    <li>
                         <a href="director.php?do=accept" class="w3-bar-item w3-button">Accept</a>     <!-- accept donar button -->
                    </li>
                    <li>
                         <a href="director.php?do=reject" class="w3-bar-item w3-button">Reject</a>     <!-- reject donar button -->
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

        <img src="../resource/images/3.jpg" alt="" class="bg-image" style="margin-top:7px">
        <div class="blure-body" style="background: linear-gradient(to left, #ffffff00 ,#f85f65b8);"></div>





    <?php

    if($units!= null)
    {
        echo '
        <div class="col-md-10 col-md-offset-1"  id="container-table" style="background: #e87e79c7;">
           <table  class="table table-hover">
                                          <caption >Users</caption>
                                          <tr>
                                              <th>Unit NO</th>
                                              <th> Approval</th>
                                              <th> Edit</th>
                                
                                          </tr>';
        foreach ($units as $unit) {

            echo "   <tr>
                                                <td>" . $unit['unitNo'] . "</td>
                                                 <td><a  class=\"btn btn-default\" href='directorOperation.php?do=insert& unit=" . $unit['unitNo'] . "'>check </a></td>
                                                 <td><a  class=\"btn btn-default\" href='directorOperation.php?do=update& unit=" . $unit['unitNo'] . "'>update </a></td>
                                                                           
                                                </tr>";

        }
        echo"</table></div>";

        if(isset($_SESSION['operation'])&&$_SESSION['operation']!=null){

            echo $_SESSION['operation'];
            $_SESSION['operation']=null;

        }
    }
    //no user found in table
    else{

        echo  ' <h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">
        No user found </h3>';

    }



}
//no permission to access page
else{

    header('location:Login.php');

}
?>