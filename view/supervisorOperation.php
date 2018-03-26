<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='medical_supervisor' || $_SESSION['job']=='admin')
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
    $edit=$serology[0];
    $edits=explode('-',$edit['s']);


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
                    <th colspan="10"> Type of component</th>
                </tr>
                <tr class="w3-blue">
                    <th rowspan="2"> PRBC'S</th>
                    <th rowspan="2" >PC</th>
                    <th rowspan="2" >FFP</th>
                    <th rowspan="2">Cryo</th>
                    <th colspan="3">Filt</th>
                    <th rowspan="2">Bag Type</th>
                    <th rowspan="2">ABO RH</th>
                    <th rowspan="2">Note</th>
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
                    <td><?php echo $unit['ABO']; ?>
                    <td><?php echo $unit['note']; ?>


                </tr>
            </table>

    <?php echo "performed: ".$unit['performed']; ?><br>
    <?php echo"approved: " . $unit['approved']; ?><br>
    <?php echo"sign: ". $unit['sign']; ?><br>

    <h3>the Result of NAT Test</h3>
    <?php
    echo 'HBV: '.$NAT['HBV'].'<br>   
    HCV:'. $NAT['HCV'].' <br>
    HIV: '. $NAT['HIV'].'  <br>';
    ?>




    <h3>the Result of Serology Test</h3>

    HBsAg <input type="radio"<?php if(isset($edit)&&$edit['HBsAg']=='Reactive'){echo 'checked';} ?>> Reactive<br>
    <input type="radio" <?php if(isset($edit)&&$edit['HBsAg']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
    Confirmation<br>
    s/co1<input type="text"  <?php if(isset($edits)){echo "value=".$edits[0]; }?>><br>
    s/co2<input type="text"  <?php if(isset($edits)){echo "value=".$edits[1]; }?>><br>
    s/c03 <input type="text" <?php if(isset($edits)){echo "value=".$edits[2]; }?>><br><br>
    Neutraliation<br>
    <input type="radio" <?php if(isset($edit)&&$edit['neut']=='Reactive-confirmed'){echo 'checked';} ?>>Reactive-confirmed<br>
    <input type="radio" <?php if(isset($edit)&&$edit['neut']=='Non confirmed'){echo 'checked';} ?>>Non confirmed<br><br>


    HCV Ab <input type="radio" <?php if(isset($edit)&&$edit['HCVab']=='Reactive'){echo 'checked';} ?>> Reactive<br>
    <input type="radio"<?php if(isset($edit)&&$edit['HCVab']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
    Confirmation<br>
    s/co1<input type="text" <?php if(isset($edits)){echo "value=".$edits[3]; }?> ><br>
    s/co2<input type="text" <?php if(isset($edits)){echo "value=".$edits[4]; }?>><br>
    s/c03 <input type="text" <?php if(isset($edits)){echo "value=".$edits[5]; }?>><br><br>
    LIA<br>
    <input type="radio" <?php if(isset($edit)&&$edit['lia']=='negative'){echo 'checked';} ?>>negative<br>
    <input type="radio" <?php if(isset($edit)&&$edit['lia']=='positive'){echo 'checked';} ?>>positive<br>
    <input type="radio" <?php if(isset($edit)&&$edit['lia']=='indeterminate'){echo 'checked';} ?>>indeterminate<br><br>


    HIV Ag/Ab <input type="radio" <?php if(isset($edit)&&$edit['HIVag']=='Reactive'){echo 'checked';} ?>> Reactive<br>
    <input type="radio"<?php if(isset($edit)&&$edit['HIVag']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
    Confirmation<br>
    s/co1<input type="text" <?php if(isset($edits)){echo "value=".$edits[6]; }?> ><br>
    s/co2<input type="text"  <?php if(isset($edits)){echo "value=".$edits[7]; }?>><br>
    s/c03 <input type="text"   <?php if(isset($edits)){echo "value=".$edits[8]; }?>><br><br>

    <input type="radio" <?php if(isset($edit)&&$edit['lia2']=='negative'){echo 'checked';} ?>>negative<br>
    <input type="radio" <?php if(isset($edit)&&$edit['lia2']=='positive'){echo 'checked';} ?>>positive<br><br>



    HTLV-1/11 <input type="radio" <?php if(isset($edit)&&$edit['HTLV']=='Reactive'){echo 'checked';} ?>> Reactive<br>
    <input type="radio" <?php if(isset($edit)&&$edit['HTLV']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
    Confirmation<br>
    s/co1<input type="text"    <?php if(isset($edits)){echo "value=".$edits[9]; }?>><br>
    s/co2<input type="text"   <?php if(isset($edits)){echo "value=".$edits[10]; }?>><br>
    s/c03 <input type="text"   <?php if(isset($edits)){echo "value=".$edits[11]; }?>><br><br>
    LIA<br>
    <input type="radio" <?php if(isset($edit)&&$edit['lia3']=='negative'){echo 'checked';} ?>>negative<br>
    <input type="radio" <?php if(isset($edit)&&$edit['lia3']=='positive'){echo 'checked';} ?>>positive<br>
    <input type="radio" <?php if(isset($edit)&&$edit['lia3']=='indeterminate'){echo 'checked';} ?>>indeterminate<br><br>




    syphilis <input type="radio" <?php if(isset($edit)&&$edit['syphilis']=='Reactive'){echo 'checked';} ?>> Reactive<br>
    <input type="radio" <?php if(isset($edit)&&$edit['syphilis']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
    TBHA<br>
    <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/80'){echo 'checked';} ?>>1/80<br>
    <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/160'){echo 'checked';} ?>>1/160<br>
    <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/320'){echo 'checked';} ?>>1/320<br>
    <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/640'){echo 'checked';} ?>>1/640<br>
    <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/1280'){echo 'checked';} ?>>1/1280<br><br>


    HBs Ab <input type="radio" <?php if(isset($edit)&&$edit['HBs']=='0>10'){echo 'checked';} ?>> 0>10<br><br>

    <input type="radio" <?php if(isset($edit)&&$edit['HBs']=='10>100'){echo 'checked';} ?>>10>100<br><br>
    <input type="radio" <?php if(isset($edit)&&$edit['HBs']=='<100'){echo 'checked';} ?>><100<br><br>

    HBc <input type="radio" <?php if(isset($edit)&&$edit['HBc']=='Reactive'){echo 'checked';} ?>> Reactive<br>
    <input type="radio" <?php if(isset($edit)&&$edit['HBc']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>





    <h3>the Result of Malaria Test</h3><?php

    echo 'Result:'. $mal['test'].'<br>';
    echo 'confirmation:'. $mal['confirmation'].'<br>';?>



    <a href="?do=accept&unit=<?php echo $_GET['unit']; ?>&mod=<?php echo $_GET['do']; ?>"> Accept</a>
    <a href="?do=reject&unit=<?php echo $_GET['unit']; ?>&mod=<?php echo $_GET['do']; ?>"> Rejecting</a>

<?php

}





//no permission to access page
else{

    header('location:Login.php');

}