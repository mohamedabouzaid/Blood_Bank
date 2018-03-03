<?php

session_start();
?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Questionnaire</title>
  <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
  <link rel="stylesheet" href="../resource/css/Questionnaire.css">
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
            <li ><a href="Home.php"> Home</a> </li>      <!-- Home button-->
            <li class="active"><a href="#"> Questionnaire</a> </li>      <!-- qusetionnaire button-->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a class="btn" id="login" href="Login.php">Login</a> </li>       <!-- login button-->
          </ul>
        </div>
      </div>
    </nav>
  </header>

<body>
    <img src="../resource/images/5.jpg" alt="" class="bg-image">
    <div class="blure-body"></div>

<?php
//array of Questions
$q=array('تتمتع بالصحه و العافيه اليوم؟','تناولت وجبه خلال الثلاث الساعات الماضيه؟','هل تبرعت بالدم أو أحد مشتقاته خلال الأسابيع الثمانية السابقة'
,'هل خالطت مصاب بالإيــدز ؟');


//insert question
if(isset($_POST['accept'])){
    $quesions=implode('-',$_POST);
    include "../model/donar.php";
    new donar();
    $result=donar::insert($quesions,$_SESSION['donar_id']);
    $_SESSION['Questionnire']=$result;
    if(isset($_POST['friend'])){
        include '../model/Receptionist.php';
        new Receptionist();
        Receptionist::updateFriend($_SESSION['donar_id']);
    }
    header('location:Home.php');


        ?>



    <?php

}
//check user and show question
elseif(isset($_POST['NID']) && $_POST['NID'] ){

    //validation
    if(strlen($_POST['NID'])!=10){


        $_SESSION['error']="national id must be 10 number";
        header('location:Home.php');
        exit();
    }


    include '../model/Receptionist.php';
    new Receptionist();
    include "../model/donar.php";
    new donar();

    //check if insert data in receptionist

    $search=Receptionist::search(filter_var($_POST['NID'],FILTER_SANITIZE_NUMBER_INT));

    if($search){
        //check if is insert questionnaire
        if (donar::search($_POST['NID'])!=null){

            $_SESSION['error']="You have already entered the questionnaire";
            header('location:Home.php');
            exit();
        }else
            {

            $_SESSION['donar_id'] = $_POST['NID'];
            foreach ($search as $donar){ $_SESSION['donar_name'] = $donar['firstName'];}
            
         echo'   <div>';
           echo   $_SESSION['donar_name'] .'</div>';
            ?>


            <div class="col-md-8 col-md-offset-2">
              <!--      questionnaire form-->

            <form action="" method="post">
                <div class="table-container">
                
                <table class="table table-hover ">
                    <caption>الاستبيان</caption>
                    <tr>


                        <th>لا</th>
                        <th>نعم</th>
                        <th>السؤال</th>
                    </tr>

                    <?php

                    for ($x = 0; $x < count($q); $x++) {
                        
                        echo "   <tr>
                        
                            
                            <td><input type=\"radio\" name=\"q" . $x . "\" value=\"1\" required></td>
                            <td><input type=\"radio\" name=\"q" . $x . "\" value=\"0\"></td>
                            <td>" . $q[$x] . "</td>
                        </tr>";
                        
                    }
                    

                    ?>


                </table>
                </div>



                <div class="report">
                    <h4>هل تريد ان تكون صديق بنك الدم:</h4>
                    <p>
                        <?php echo '<input type="checkbox" name="friend"  value="1" >';?>
                        فى حاله الحاجه الى دم ,سوف يتم الاتصال بك


                    </p>

                </div>



                <div class="report">
                    <h4> : اقرار المتبرع</h4>
                    <p>
                        لقد قرأت وفهمت وأجبت بصدق على الأسئلة السابقة بقدر علمي كما أنني أفوض بنك الدم بسحب وحدة دم مني أو
                        إجراء عملية فصل مكونات الدم والتصرف بها بالطريقة التي يراها مناسبة
                        <input class="btn btn-danger" type="submit" value="موافق" name="accept" >

                    </p>

                </div>



                <?php
        }
    }

    else{

        $_SESSION['error']="You shoud insert your data in receptionist ";
        header('location:Home.php');
        exit();
    }
}
else {


    header('location:Home.php');
}