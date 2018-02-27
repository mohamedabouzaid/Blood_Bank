<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 7:29 PM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='physician'){


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta charset="UTF-8">
    <title>clinic</title>
</head>
<body>
<div class="w3-bar w3-light-grey">
    <a href="physician.php" class="w3-bar-item w3-button">Clinic Home</a>     <!-- clinic home button -->
    <div class="w3-dropdown-hover">
        <!-- user name -->
        <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>
            <!-- logout button -->
        </div>
    </div>
</div>
    <?php



include '../model/physician.php';
new physician();
$accept = physician::check($_GET['nid'], 0);
$reject = physician::check($_GET['nid'], 1);

if ($accept != null &&$_GET['do']=='check'){

    echo "you arleady checked it and Accept";

    exit();
} elseif ($reject != null && $_GET['do']=='check') {

    echo "you arleady checked it and Reject";

    exit();

}
else{


//accept
if (isset($_GET['do']) && $_GET['do'] == 'accept'){
   if($_GET['mod']=='check'){
       //insert
    $result = physician::status(0, $_GET['nid']);}
    //update
    else{$result=physician::updateStatus(0, $_GET['nid']);}
    $_SESSION['operation'] = $result;
    header('location:physician.php');


} //reject
elseif (isset($_GET['do']) && $_GET['do'] == 'reject') {

    if($_GET['mod']=='check'){
        //insert
    $result = physician::status(1, $_GET['nid']);}
    //update
    else{$result=$result=physician::updateStatus(1, $_GET['nid']);}

    $_SESSION['operation'] = $result;
    header('location:physician.php');
} // form of questionnaire and health information
else{



//health information
$result = physician::search($_GET['nid']);
//questionnaire
$questions = physician::searchQ($_GET['nid']);
$resultQuestions = explode('-', $questions);
$q = array('تتمتع بالصحه و العافيه اليوم؟', 'تناولت وجبه خلال الثلاث الساعات الماضيه؟', 'هل تبرعت بالدم أو أحد مشتقاته خلال الأسابيع الثمانية السابقة'
, 'هل خالطت مصاب بالإيــدز ؟');


?>


<h3>A list of question answer by yes</h3>
<?php
//questionnaire
for ($x = 0; $x < count($q); $x++) {
    echo ' <ul >';

    if ($resultQuestions[$x] == 0) {

        echo '<li>' . $q[$x] . ' </li> ';

    }
    echo '</ul>';

}


?>


<!--health information-->
<h3> donar health information</h3>

<table class="w3-table-all w3-small">
    <tr class="w3-blue">
        <th>Weight(KG)</th>
        <th>Height(cm)</th>
        <th>Temp(c)</th>
        <th> Blood Group</th>
        <th>HB(g/d)</th>
        <th>Pluse(bpm)</th>
        <th>Bp(mmHg)</th>
    </tr>
    <tr>
        <?php foreach ($result

        as $user){ ?>
        <td><?php echo $user['weight'] ?> </td>
        <td><?php echo $user['height'] ?> </td>
        <td><?php echo $user['temp'] ?> </td>
        <td><?php echo $user['bloodGroup'] ?> </td>
        <td><?php echo $user['hp'] ?> </td>
        <td><?php echo $user['pluse'] ?> </td>
        <td><?php echo $user['bp'] ?> </td>


    </tr>
    <?php } ?>
</table>

<a href="?do=accept&nid=<?php echo $_GET['nid']; ?>&mod=<?php echo $_GET['do']; ?>"> Accept</a>
<a href="?do=reject&nid=<?php echo $_GET['nid']; ?>&mod=<?php echo $_GET['do']; ?>"> Rejecting</a>


<?php
}
}
}
//no permission to access page
else{

    header('location:Login.php');

}
?>
