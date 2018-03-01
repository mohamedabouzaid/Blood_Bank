<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/27/2018
 * Time: 11:18 PM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='medical_supervisor')
{?>















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
        <a href="medicalSupervisor.php" class="w3-bar-item w3-button">Medical Supervisor Home</a>     <!-- supervisor home button -->
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
    include  '../model/supervisor.php';

    if (isset($_GET['do']) && $_GET['do'] == 'accept'){

            //insert or update

        $result=supervisor::update(0,$_GET['unit']);


        $_SESSION['operation'] = $result;
        header('location:physician.php');


    }
    if (isset($_GET['do']) && $_GET['do'] == 'reject'){

        //insert or update

        $result=supervisor::update(1,$_GET['unit']);


        $_SESSION['operation'] = $result;
        header('location:physician.php');


    }

    $tests =supervisor::search($_GET['unit']);
    $test=$tests[0];

    if($test['approval']!=null && $_GET['do']=='insert'){

        echo "you already checked ";
        die();

    }
    elseif ($test['approval']==null && $_GET['do']=='update')
    {

        echo "you shoud checked first  ";
        die();
    }





    //blood component
    include '../model/NurseModel.php';
    $units=NurseModel::searchUnit($_GET['unit']);
    $unit=$units[0];
    // NAT Department
    include "../model/NATmodel.php";
    $NATS=NATmodel::search($_GET['unit']);
    $NAT=$NATS[0];

    //serology Department
    include "../model/serology.php";
    $serology=serology::search($_GET['unit']);
    $ser=$serology[0];

    //immuno Department
    include "../model/immuno.php";
    $immuno=immuno::search($_GET['unit']);
     $imm=$immuno[0];

     //bacterial Department
    include "../model/bacterial.php";
    $bacterial=bacterial::search($_GET['unit']);
    $bac=$bacterial[0];

   //malaria department
    include "../model/malaria.php";
    $malaria=malaria::search($_GET['unit']);
    $mal=$malaria[0];

?>









    <!-- blood component-->


    <h3>Blood Component:<?php echo $_GET['unit']; ?>
    </h3>
    <div class="w3-responsive">
        <form action="" method="post">

            <table class="w3-table-all w3-small">
                <thead >
                <tr class="w3-blue">
                    <th rowspan="3">Centrifuge no.</th>
                    <th rowspan="3">Unit no</th>
                    <th rowspan="3">Time Blood Collected</th>
                    <th rowspan="3"> Time Blood separated</th>
                    <th colspan="9"> Type of component</th>
                </tr>
                <tr class="w3-blue">
                    <th rowspan="2"> PRBC'S</th>
                    <th rowspan="2" >PC</th>
                    <th rowspan="2" >FFP</th>
                    <th rowspan="2">Cryo</th>
                    <th colspan="3">Filt</th>
                    <th rowspan="2">Bag Type</th>
                </tr >
                <tr class="w3-blue">
                    <th>WB</th>
                    <th > PRBC'S</th>
                    <th  >PC</th>

                </tr>
                </thead>
                <tr>
                    <td><?php echo $unit['centerNo']; ?>
                    <td><?php echo $unit['unitNo']; ?>
                    <td><?php echo $unit['timeCollected']; ?>
                    <td><?php echo $unit['timeSeparated']; ?>

                    <td><?php echo $unit['prbc']; ?>
                    <td><?php echo $unit['pc']; ?>
                    <td><?php echo $unit['ffp']; ?>
                    <td><?php echo $unit['cryo']; ?>

                    <td><?php echo $unit['Fwb']; ?>
                    <td><?php echo $unit['Fprbc']; ?>
                    <td><?php echo $unit['Fpc']; ?>

                    <td><?php echo $unit['bagType']; ?>


                </tr>
            </table>


    <h3>the Result of NAT Test</h3><?php  if ($NAT==null) {echo "NOT FINISED";}
    else{
    echo 'HBV: '.$NAT['HBV'].'<br>   
    HCV:'. $NAT['HCV'].' <br>
    HIV: '. $NAT['HIV'].'  <br>';}?>



    <h3>the Result of Serology Test</h3><?php  if ($ser==null) {echo "NOT FINISED";}
    else{
       echo 'HIV I/II:'. $ser['HIV'].'<br>
    HBsAg:' .$ser['HBsAg']. '<br>
    anti HCV:'. $ser['antiHCV'].' <br>
    syphilis:'. $ser['syphilis'].'  <br>
    anti HBc:' . $ser['antiHBc'].' <br>
    HTLV: '. $ser['HTLV']. '<br>';}?>


    <h3>the Result of Immuno Test</h3><?php  if ($ser==null) {echo "NOT FINISED";}
else{
    echo 'RH:'. $imm['RH'].'<br>
    ABO:' .$imm['ABO']. '<br>
    antibody Screnning:'. $imm['anti'].' <br>
    phenotype:'. $imm['phenotype'].'  <br>';}?>


    <h3>the Result of Bacterial Test</h3><?php  if ($ser==null) {echo "NOT FINISED";}
else{
    echo 'Result:'. $bac['test'].'<br>';}?>

    <h3>the Result of Malaria Test</h3><?php  if ($ser==null) {echo "NOT FINISED";}
else{
    echo 'Result:'. $mal['test'].'<br>';}?>


    <a href="?do=accept&unit=<?php echo $_GET['unit']; ?>&mod=<?php echo $_GET['do']; ?>"> Accept</a>
    <a href="?do=reject&unit=<?php echo $_GET['unit']; ?>&mod=<?php echo $_GET['do']; ?>"> Rejecting</a>

<?php

}





//no permission to access page
else{

    header('location:Login.php');

}