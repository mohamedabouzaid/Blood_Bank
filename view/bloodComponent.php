<?php
session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='Nurse_2' || $_SESSION['job']=='admin') {


//search
    if(isset($_POST['search'])) {
        include '../model/NurseModel.php';
        $users=NurseModel::search(filter_var($_POST['search'], FILTER_SANITIZE_NUMBER_INT));
    }

    else{
        //accept donar
        include '../model/NurseModel.php';
        $users=NurseModel::getALLBlood();

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
            background: #b9403ed4;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
            margin-top:29px;
        }
        
    </style>
</head>

<body>
    
    <header class="container" >
        <nav class="navbar navbar-default ">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li class="active">
                        <a href="nurse.php">Blood Component</a> 
                    </li>
                </ul>

                <!-- search  -->
                <ul class="nav navbar-nav" style="margin: 9px 112px 0;">
                    <li>
                        <form class="form-inline" action="" method="post" style="margin-left: -95px;">
                            <div class="form-group">
                                <div class="input-group">
                                <input class="form-control " type="text" name="search" placeholder="Search..." style="width: 296px; text-align:left">                                     
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
if($users!= null)
{
    echo '
    <div class="col-md-10 col-md-offset-1">
    <table  class="table table-hover">
                                          <caption >Users</caption>
                                          <tr class="w3-blue">
                                              <th>رقم السجل القومى /الاقامه</th>
                                              <th> Blood Information</th>
                                              <th>Edit</th>
                                          </tr>';
    foreach ($users as $user) {

        echo "   <tr>
                                                <td>" . $user['donar_NID'] . "</td>
                                                <td> <a  class=\"btn btn-default\" href='bloodComponentOperation.php?do=insert&nid=" . $user['donar_NID'] . "'> Insert</a></td>
                                                <td> <a  class=\"btn btn-default\" href='bloodComponentOperation.php?do=edit&nid=" . $user['donar_NID'] . "'> Update</a></td>

                                                </tr>";

    }
    echo    "</table></div>";

    if(isset($_SESSION['labOperation'])&& $_SESSION['labOperation']!=null){
        echo $_SESSION['labOperation'];
        $_SESSION['labOperation']=null;


    }
}
//no user found in table
else{

    echo  "no user found ";

}


if(isset($_SESSION['operation'])&&$_SESSION['operation']!=null){


    echo $_SESSION['operation'];
    $_SESSION['operation']=null;

}

}


//no permission to access page
else{

    header('location:Login.php');

}