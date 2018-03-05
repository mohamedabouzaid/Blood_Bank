<?php


session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='Receptionist')

{
        //search
        if(isset($_POST['search'])) {
          include '../model/Receptionist.php';
          new Receptionist();
          $users=Receptionist::search(filter_var($_POST['search'],FILTER_SANITIZE_NUMBER_INT));
          }
          elseif (isset($_GET['do'])&&$_GET['do']=='friend'){


              include '../model/Receptionist.php';
              $users=Receptionist::getFriend();

          }

          //get all use
        else{
            include '../model/Receptionist.php';
            new Receptionist();
            $users= Receptionist::getALLUsers();

        }


?>
 
 
 <!DOCTYPE html>
 
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receptionist</title>
    <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/css/Questionnaire.css">
    <link rel="stylesheet" href="../resource/css/header.css">
    <link rel="stylesheet" href="../resource/css/Recieptionist.css">
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
                    <li class="active"><a href="Receptionist.php" >Receptionist Home</a></li>
                  
                </ul>
                <ul class="nav navbar-nav" style="margin: 9px 112px 0;">
                            <li>
                                <form class="form-inline">
                                    <div class="form-group">
                                        <div class="input-group">
                                        <input class="form-control " type="text" name="search" placeholder="Search" style="width: 296px">                                     
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

        <img src="../resource/images/5.jpg" alt="" class="bg-image">
        <div class="blure-body"></div>
        <div class="col-md-2" id="frame">
            <ul>
                 <li><a href="Receptionist.php" >Receptionist Home</a></li>
                 <li><a href="../view/ReceptionistOperation.php" >Create File</a></li>
                 <li><a href="?do=friend" > Blood Bank friends </a></li>
            </ul>
        </div>

    </body>
</html>
    <?php
    //table of user
    if($users!= null)
    {
        echo '
            <div class="col-md-10" id="container-table">
               <table  class="table table-hover">
                         <caption >Users</caption>
                                          <tr>
                                              <th>رقم السجل القومى /الاقامه</th>
                                              <th>الاسم الاول</th>
                                              <th>الاسم الثانى</th>
                                              <th>الاسم الثالث </th>
                                              <th>اسم العائله</th>';
                                               if(isset($_GET['do'])){echo '<th> رقم الهاتف</th>';}
                                              echo '<th> Modify</th>
                                          
                                        </tr> 
                        <tbody>';
        foreach ($users as $user) {
 
            echo "                      <tr>
                                                <td>" . $user['NID'] . "</td>
                                                <td>" . $user['firstName'] . "</td>
                                                <td>" . $user['secondName'] . "</td>
                                                <td>" . $user['thirdName'] . "</td>
                                                <td>" . $user['familyName'] . "</td>";
                                             if(isset($_GET['do'])){echo "<td>". $user['phone']." </td>";}
            echo  "                            <td><a  class=\"btn btn-default\" href='ReceptionistOperation.php ?do=edit& user=" . serialize($user) . "'>Edit <span class='glyphicon glyphicon-edit'></span></a></td>
                                                      
                                     </tr>";
        }
           
        echo    "       </tbody> </table> </div>";


    }
    //no user found in table
    else{

        echo  "no user found ";

    }




//display the out put of operation

    if(isset($_SESSION['receptionistOperation'])&& $_SESSION['receptionistOperation']!=null){
      echo $_SESSION['receptionistOperation'];
       $_SESSION['receptionistOperation']=null;


     }

}
//no permission to access page
else{

    header('location:Login.php');

}

?>