<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='medical_supervisor' || $_SESSION['job']=='admin')
{?>
  
 <!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>clinic</title>
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
    
    <header>
        <nav class="navbar navbar-default container">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li>
                         <a href="medicalSupervisor.php">Medical Supervisor Home</a>     <!-- supervisor home button -->
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
        <div class="blure-body" style="background: linear-gradient(to left, #ffffff00 ,#f85f65b8); margin-top:47px;"></div>


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

        echo '<h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">
        You already checked </h3>';
        die();

    }
    elseif ($test['approval']==null && $_GET['do']=='update')
    {

        echo '<h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">
        You shoud checked first </h3>';
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
    <h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">
    Blood Component:<?php echo $_GET['unit']; ?> 
    </h3>

     <div  class="col-md-10 col-md-offset-1">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th class="center" rowspan="3">Centrifuge no.</th>
                    <th class="center" rowspan="3">Unit no</th>
                    <th class="center" rowspan="3">Time Blood Collected</th>
                    <th class="center" rowspan="3"> Time Blood separated</th>
                    <th class="center" colspan="10"> Type of component</th>
                </tr>
                <tr>
                    <th class="center" rowspan="2"> PRBC'S</th>
                    <th class="center" rowspan="2" >PC</th>
                    <th class="center" rowspan="2" >FFP</th>
                    <th class="center" rowspan="2">Cryo</th>
                    <th class="center" colspan="3">Filt</th>
                    <th class="center" rowspan="2">Bag Type</th>
                    <th class="center" rowspan="2">ABO RH</th>
                    <th class="center" rowspan="2">Note</th>
                </tr >
                <tr class="center">
                    <th>WB</th>
                    <th>PRBC'S</th>
                    <th>PC</th>

                </tr>
                </thead>
                <tr class="center">
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
     </div>
   
     <div  class="col-md-10 col-md-offset-1">
        <table class="table table-hover ">
            <tr class="left">
                <td>
                    <?php echo "performed : ".$unit['performed']; ?>
                </td>
            </tr>
            <tr class="left">
                <td>
                     <?php echo"approved : ". $unit['approved']; ?>
                </td>
            </tr>
            <tr class="left">
                <td>
                    <?php echo"sign : ". $unit['sign']; ?>
                </td>
            </tr>
            


        </table>
    </div>
    
    <div  class="col-md-10 col-md-offset-1">
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th class="center">
                        The Result of NAT Test
                    </th>
                </tr>
            </thead>
            <?php  if ($NAT==null) {echo "<tr class='left'><td> NOT FINISED </td></tr>";}
            else {
                echo '<tr class="left"><td> HBV : ' . $NAT['HBV'] . '</td></tr>
            <tr class="left"><td>HCV : ' . $NAT['HCV'] . ' </td></tr>
            <tr class="left"><td>HIV : ' . $NAT['HIV'] . '  </td></tr>';
            }?>
        </table>
    </div>
        
    <div  class="col-md-10 col-md-offset-1">
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th class="center" colspan="4">
                      The Result of Serology Test
                    </th>
                </tr>
            </thead>
            


    <?php  if ($edit==null) {echo "<tr class='left'><td> NOT FINISED </td></tr>";}

    else{?>

        <tr>    
            <td class=" center">HBsAg </td>
            <td class=" left">
                <input type="radio"<?php if(isset($edit)&&$edit['HBsAg']=='Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly> Reactive <br>
                <input type="radio" <?php if(isset($edit)&&$edit['HBsAg']=='Non Reactive'){echo 'checked';} else{echo 'disabled';}?> readonly>Non Reactive
            </td>
            
            <td class=" left" colspan="2">
                <div class="form-group col-md-12 center">
                    <label >Confirmation</label>
                </div>
                <div class="form-group col-md-4">
                    <label >s/co1</label>
                    <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[0]; }?> readonly>
                </div>
                <div class="form-group col-md-4">
                    <label >s/co2</label>
                    <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[1]; }?> readonly>
                </div>
                <div class="form-group col-md-4">
                    <label >s/co3</label>
                    <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[2]; }?> readonly>
                </div>
                <div class="form-group col-md-12">
                    <label class="">Neutraliation
                        <label class="radio">
                            <input type="radio" <?php if(isset($edit)&&$edit['neut']=='Reactive-confirmed'){echo 'checked';} else{echo 'disabled';} ?> readonly>Reactive-confirmed
                        </label>
                        <label class="radio">
                            <input type="radio" <?php if(isset($edit)&&$edit['neut']=='Non confirmed'){echo 'checked';} else{echo 'disabled';} ?> readonly>Non confirmed
                        </label>
                    </label>
                </div>
                </td>
            </tr>
            <tr>
                <td class=" center">HCV Ab</td>
                <td class=" left" >
                    <input type="radio" <?php if(isset($edit)&&$edit['HCVab']=='Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly> Reactive <br>
                    <input type="radio"<?php if(isset($edit)&&$edit['HCVab']=='Non Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly>Non Reactive
                </td>
                
                <td class=" left" colspan="2">
                    <div class="form-group col-md-12 center">
                        <label>Confirmation</label>
                    </div>
                    <div class="form-group col-md-4">
                        <label>s/co1</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[3]; }?> readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>s/co2</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[4]; }?> readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label>s/c03</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[5]; }?> readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">LIA
                            <label class="radio">
                                <input type="radio" <?php if(isset($edit)&&$edit['lia']=='negative'){echo 'checked';} else{echo 'disabled';} ?> readonly>negative
                            </label>
                            <label class="radio">
                                <input type="radio" <?php if(isset($edit)&&$edit['lia']=='positive'){echo 'checked';}else{echo 'disabled';} ?> readonly>positive
                            </label>
                            <label class="radio">
                                <input type="radio" <?php if(isset($edit)&&$edit['lia']=='indeterminate'){echo 'checked';} else{echo 'disabled';} ?> readonly>indeterminate
                            </label>
                        </label>
                    </div>
                </td>
            </tr>

            <tr>
                <td class=" center">HIV Ag/Ab</td>
                <td class=" left">
                   <input type="radio" <?php if(isset($edit)&&$edit['HIVag']=='Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly> Reactive <br> 
                    <input type="radio"<?php if(isset($edit)&&$edit['HIVag']=='Non Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly>Non Reactive
                </td>
                <td class=" left" colspan="2">
                    <div class="form-group col-md-12 center">
                        <label >Confirmation</label>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co1</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[6]; }?>  readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co2</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[7]; }?> readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co3</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[8]; }?> readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">LIA
                            <label class="radio">
                                 <input type="radio" <?php if(isset($edit)&&$edit['lia2']=='negative'){echo 'checked';} else{echo 'disabled';} ?> readonly> negative
                            </label>
                            <label class="radio">
                                 <input type="radio" <?php if(isset($edit)&&$edit['lia2']=='positive'){echo 'checked';} else{echo 'disabled';} ?> readonly>positive
                            </label>
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class=" center">HTLV-1/11</td>
                <td class=" left">
                    <input type="radio" <?php if(isset($edit)&&$edit['HTLV']=='Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly> Reactive <br> 
                    <input type="radio" <?php if(isset($edit)&&$edit['HTLV']=='Non Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly>Non Reactive
                </td>
                
                <td class="col-md-6 left" colspan="2">
                    <div class="form-group col-md-12 center">
                        <label >Confirmation</label>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co1</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[9]; }?> readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co2</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[10]; }?> readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co3</label>
                        <input type="text" class="form-control" <?php if(isset($edits)){echo "value=".$edits[11]; }?> readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">LIA
                            <label class="radio">
                                  <input type="radio" <?php if(isset($edit)&&$edit['lia3']=='negative'){echo 'checked';} else{echo 'disabled';} ?> readonly>negative
                            </label>
                            <label class="radio">
                                <input type="radio" <?php if(isset($edit)&&$edit['lia3']=='positive'){echo 'checked';}  else{echo 'disabled';}?> readonly>positive
                            </label>
                            <label class="radio">
                                <input type="radio" <?php if(isset($edit)&&$edit['lia3']=='indeterminate'){echo 'checked';}else{echo 'disabled';} ?> readonly>indeterminate
                            </label>
                        </label>
                    </div>
                </td>
            </tr>

            <tr>
                <td class=" center">syphilis</td>
                <td class=" left">
                     <input type="radio" <?php if(isset($edit)&&$edit['syphilis']=='Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly> Reactive <br> 
                    <input type="radio" <?php if(isset($edit)&&$edit['syphilis']=='Non Reactive'){echo 'checked';}else{echo 'disabled';} ?> readonly>Non Reactive
                </td>
                
                <td class=" left" colspan="2">
                    <div class="form-group col-md-12">
                        <label class="">TBHA
                            <label class="radio">
                                 <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/80'){echo 'checked';}  else{echo 'disabled';}?> readonly>1/80
                            </label>
                            <label class="radio">
                                 <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/160'){echo 'checked';} else{echo 'disabled';}?> readonly>1/160
                            </label>
                            <label class="radio">
                                  <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/320'){echo 'checked';} else{echo 'disabled';}?> readonly>1/320
                            </label>
                            <label class="radio">
                                <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/640'){echo 'checked';} else{echo 'disabled';}?> readonly>1/640
                            </label>
                            <label class="radio">
                                <input type="radio" <?php if(isset($edit)&&$edit['tb']=='1/1280'){echo 'checked';}  else{echo 'disabled';}?> readonly>1/1280
                            </label>
                        </label>
                    </div>
                </td>
            </tr>

            <tr>
                <td class=" center">HBs Ab</td>
                <td class=" left">
                     <input readonly type="radio" <?php if(isset($edit)&&$edit['HBs']=='Reactive'){echo 'checked';} else{echo 'disabled';} ?>>Reactive <br> 
                     <input type="radio" <?php if(isset($edit)&&$edit['HBs']=='0>10'){echo 'checked';} else{echo 'disabled';} ?> readonly> 0>10
                </td>
                <td class=" left" colspan="2">
                    <div class="form-group col-md-12">
                        <label class="">
                            <label class="radio">
                                      
                                 <input type="radio" <?php if(isset($edit)&&$edit['HBs']=='10>100'){echo 'checked';}else{echo 'disabled';} ?> readonly>10>100
                            </label>
                            <label class="radio">
                                 <input type="text" class="form-control" readonly <?php if(isset($edit['HBsText'])){echo "value=".$edit['HBsText']; }?> >
                            </label>
                            <label class="radio">            
                                 <input type="radio" <?php if(isset($edit)&&$edit['HBs']=='<100'){echo 'checked';} else{echo 'disabled';} ?> readonly><100
                            </label>
                        </label>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="col-md-2 center">HBc</td>
                <td class="col-md-5 center">
                     <input type="radio" <?php if(isset($edit)&&$edit['HBc']=='Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly> Reactive
                </td>
                <td class="col-md-5 center">
                     <input type="radio" <?php if(isset($edit)&&$edit['HBc']=='Non Reactive'){echo 'checked';} else{echo 'disabled';} ?> readonly>Non Reactive          
                </td>
                <td></td>
               
            </tr>




<?php }?>
    </table>
    </div>

    
<div  class="col-md-10 col-md-offset-1">
        <table class="table table-hover ">
            <thead>
                <tr>
                    <th class="center">
                        The Result of Malaria Test
                    </th>
                </tr>
            </thead>
                <?php
                if ($mal==null) {echo '<tr class="left"><td> NOT FINISED</td></tr>';}
                else{
            
                echo ' <tr class="left"><td> Result : '. $mal['test'].'</td></tr>';?>
                 <tr>
                    <td class="left" >
                        <div class=" col-md-2">
                        confirmation : 
                        </div>
                        <div class="form-group ">
                            <label class="left " >Think film
                                <label class="radio ">
                                    <input type="radio" name="confirmation" value="Seen" readonly <?php if(isset($mal)&&$mal['confirmation']=='Seen')
                                    {echo 'checked';} ?>>Seen
                                </label>
                                <label class="radio ">
                                    <input type="radio" name="confirmation" value="Not seen" readonly <?php if(isset($mal)&&$mal['confirmation']=='Not seen')
                                    {echo 'checked';} ?>>Not Seen
                                </label>
                            </label>
                        </div>
                    </td>
                   
                </tr>
            
            <?php }?>
            
        </table>
    </div>
    
    

    <div  class="col-md-10 col-md-offset-1">
        <a class="col-md-3 col-md-offset-2 btn btn-default" style="color:#000" href="?do=accept&unit=<?php echo $_GET['unit']; ?>&mod=<?php echo $_GET['do']; ?>"> Accept</a>
        <a class="col-md-3 col-md-offset-2 btn btn-default" style="color:#000" href="?do=reject&unit=<?php echo $_GET['unit']; ?>&mod=<?php echo $_GET['do']; ?>"> Rejecting</a>
    </div>

    




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

    
<?php

}





//no permission to access page
else{

    header('location:Login.php');

}

