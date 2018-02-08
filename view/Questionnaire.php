<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 1:50 AM
 */

session_start();
?>
<div>
    <a href="Home.php">Home</a>  <!-- Home button   -->

</div>

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
    echo $result;

}
//check user and show question
elseif(isset($_POST['NID']) && $_POST['NID'] ){
    include '../model/Receptionist.php';
    new Receptionist();
    include "../model/donar.php";
    new donar();

    //check if insert data in receptionist
    if(Receptionist::search(filter_var($_POST['NID'],FILTER_SANITIZE_NUMBER_INT))){
        //check if is insert questionnaire
        if (donar::search($_POST['NID'])!=null){

            echo "You have already entered the questionnaire";

        }else
            {

            $_SESSION['donar_id'] = $_POST['NID'];
            ?>

              <!--      questionnaire form-->
            <form action="" method="post">
                <table>
                    <caption> Questionnaire</caption>
                    <tr>


                        <th>No</th>
                        <th>Yes</th>
                        <th>Question</th>
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
                <h5>اقرار المتبرع</h5>
                <p>
                    لقد قرأت وفهمت وأجبت بصدق على الأسئلة السابقة بقدر علمي كما أنني أفوض بنك الدم بسحب وحدة دم مني أو
                    إجراء عملية فصل مكونات الدم والتصرف بها بالطريقة التي يراها مناسبة


                </p>
                <input type="submit" value="موافق" name="accept">
            </form>

            <?php
        }
    }

    else{

        echo "You shoud insert your data in receptionist ";
    }
}
else {


    header('location:Home.php');
}