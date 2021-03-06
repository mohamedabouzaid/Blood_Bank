<?php
include "../model/malaria.php";
include "../model/NATmodel.php";
include "../model/serology.php";
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='lab' || $_SESSION['job']=='admin')
{
    if(isset($_POST['save']))
    {
        $s=implode("-",$_POST['s_list']);
 //insert


        if($_POST['do']=='insert'){
            $result= malaria::insert($_POST['unitNo'],$_POST['test'],$_POST['confirmation']);
            $result.= NATmodel::insert($_POST['unitNo'],$_POST['HBV'],$_POST['HCV'],$_POST['HIV']);
            $result.=serology::insert($_POST['unitNo'],$_POST['HBsAg'],$_POST['neut'],$_POST['HCVab'],
                $_POST['lia'],$_POST['HIVag'],$_POST['lia2'],$_POST['HTLV'],$_POST['lia3'],$_POST['syphilis'],$_POST['tb'],
                $_POST['HBs'],$_POST['HBc'],$s,$_POST['HBsText']);
        }

        //update
        else{

            $result= malaria::update($_POST['unitNo'],$_POST['test'],$_POST['confirmation']);
            $result.=NATmodel::update($_POST['unitNo'],$_POST['HBV'],$_POST['HCV'],$_POST['HIV']);
            $result.=serology::update($_POST['unitNo'],$_POST['HBsAg'],$_POST['neut'],$_POST['HCVab'],
                $_POST['lia'],$_POST['HIVag'],$_POST['lia2'],$_POST['HTLV'],$_POST['lia3'],$_POST['syphilis'],$_POST['tb'],
                $_POST['HBs'],$_POST['HBc'],$s,$_POST['HBsText']);

        }
        $_SESSION['operation']= $result;
        header('location:lab.php');
    }
    else {




        ?>
 <!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lab Department</title>
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
    
    <header class="">
        <nav class="navbar navbar-default container">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li >
                    <a href="lab.php" >lab Department Home</a>     <!-- lab Department home button -->
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
        // already inserted

        $searchMalaria=malaria::search($_GET['unit']);
        $searchNat=NATmodel::search($_GET['unit']);
        $searchSerology=serology::search($_GET['unit']);
        if($searchMalaria){
            //update
            if($_GET['do']=='update') {

                $edit=array_merge($searchMalaria[0],$searchNat[0],$searchSerology[0]);
                $edits=explode('-',$edit['s']);
                //print_r($edits);
            }
            //insert
            else{
                echo '<h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">Result already inserted</h3>';
                die();}

        }
        else{

            if($_GET['do']=='update'){

                echo '<h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;">No data entered </h3>';
                die();}

        }

    }


    ?>




<!--malaria-->
    <h3 class="col-md-10 col-md-offset-1" style=" margin-top: 71px;background: #EEE;text-align: center;"><?php echo 'Unit NO:  ' . $_GET['unit'] ?> </h3>
    <form method="post" action="" >
        <div  class="col-md-10 col-md-offset-1">
        <h4 > Malaria: </h4>
        <table class="table table-hover ">
            <tr>
                <th>Test</th>
                <th>Positive</th>
                <th>Negative</th>
                <th>Confirmation</th>
            </tr>
            <tr>
                <td class="center">Opt.MAI</td>
                <td class="center">
                    <input  onclick="addRequired('1')" type="radio" name="test" value="Positive" required <?php if(isset($edit)&&$edit['test']=='Positive')
                    {echo 'checked';} ?>>
                </td class="center">
                <td class="center">
                    <input onclick="removeRequired('1')" type="radio" name="test" value="Negative" required<?php if(isset($edit)&&$edit['test']=='Negative')
                    {echo 'checked';} ?>>
                </td>
                <td class="left">
                  <label class="">Think film
                    <label class="radio">
                        <input class="1" type="radio" name="confirmation" value="Seen"  <?php if(isset($edit)&&$edit['confirmation']=='Seen')
                        {echo 'checked';} ?>>Seen
                    </label>
                    <label class="radio">
                        <input class="1" type="radio" name="confirmation" value="Not seen"  <?php if(isset($edit)&&$edit['confirmation']=='Not seen')
                        {echo 'checked';} ?>>Not Seen
                    </label>
                  </label>
                </td>
            </tr>
        </table>
        </div>
       


<!--nat-->
        <div  class="col-md-10 col-md-offset-1">
        <h4 > Nat: </h4>
        <table class="table table-hover ">
            <tr>
                <th>Tests</th>
                <th>Reactive</th>
                <th>Non Reactive</th>
                <th>Invalid</th>
            </tr>

            <tr>
                <td class="center">
                HBV:
                </td>
                <td class="center">
                    <input type="radio" name="HBV" value="Reactive" required <?php if(isset($edit)&&$edit['HBV']=='Reactive')
                      {echo 'checked';} ?>> 
                </td>
                <td class="center">
                    <input type="radio" name="HBV" value="Non Reactive"  <?php if(isset($edit)&&$edit['HBV']=='Non Reactive')
                     {echo 'checked';} ?>>
                </td>
                <td class="center">
                    <input type="radio" name="HBV" value="invalid" r <?php if(isset($edit)&&$edit['HBV']=='invalid')
                     {echo 'checked';} ?>>
                </td>
            </tr>
            <tr>
                <td class="center">
                HCV:
                </td>
                <td class="center">
                    <input type="radio" name="HCV" value="Reactive" required <?php if(isset($edit)&&$edit['HCV']=='Reactive')
                    {echo 'checked';} ?>> 
                </td>
                <td class="center">
                    <input type="radio" name="HCV" value="Non Reactive" required <?php if(isset($edit)&&$edit['HCV']=='Non Reactive')
                      {echo 'checked';} ?>>
                </td>
                <td class="center">
                    <input type="radio" name="HCV" value="invalid"  required <?php if(isset($edit)&&$edit['HCV']=='invalid')
                     {echo 'checked';} ?>>
                </td>
            </tr>
            <tr>
                <td class="center">
                HIV:
                </td>
                <td class="center">
                    <input type="radio" name="HIV" value="Reactive" required<?php if(isset($edit)&&$edit['HIV']=='Reactive')
                      {echo 'checked';} ?>> 
                </td>
                <td class="center">
                    <input type="radio" name="HIV" value="Non Reactive" required <?php if(isset($edit)&&$edit['HIV']=='Non Reactive')
                     {echo 'checked';} ?>>
                </td>
                <td class="center">
                    <input type="radio" name="HIV" value="invalid"  required <?php if(isset($edit)&&$edit['HIV']=='invalid')
                        {echo 'checked';} ?>>
                </td>
            </tr>
        </table>
        </div>
     



<!--serology-->
<div  class="col-md-10 col-md-offset-1">
        <h4 > serology:</h4>
        <table class="table table-hover ">
            <tr>
                <th class="col-md-2">Tests</th>
                <th class="col-md-2">Reactive</th>
                <th class="col-md-2">Non Reactive</th>
                <th class="col-md-6">Confirmation</th>
            </tr>
            <tr>    
                <td class="col-md-2 center">HBsAg </td>
                <td class="col-md-2 center">
                    <input onclick="addRequired('2')" type="radio" name="HBsAg" value="Reactive" required
                    <?php if(isset($edit)&&$edit['HBsAg']=='Reactive'){echo 'checked';} ?>> 
                </td>
                <td class="col-md-2 center">
                    <input onclick="removeRequired('2')" type="radio" name="HBsAg" value="Non Reactive" required
                    <?php if(isset($edit)&&$edit['HBsAg']=='Non Reactive'){echo 'checked';} ?>>
                </td>
                <td class="col-md-6 left">
                    <div class="form-group col-md-4">
                        <label >s/co1</label>
                        <input type="text" class="form-control 2"  name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[0]; }?>>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co2</label>
                         <input type="text" class="form-control 2" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[1]; }?>><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/c03</label>
                         <input type="text" class="form-control 2" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[2]; }?>>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">Neutraliation
                        <label class="radio">
                            <input class="2" type="radio" name="neut" value="Reactive-confirmed"
                            <?php if(isset($edit)&&$edit['neut']=='Reactive-confirmed'){echo 'checked';} ?>>Reactive-confirmed
                        </label>
                        <label class="radio">
                            <input class="2" type="radio" name="neut" value="Non-confirmed"
                            <?php if(isset($edit)&&$edit['neut']=='Non-confirmed'){echo 'checked';} ?>>Non-confirmed
                         </label>
                         </label>
                    </div>
                </td>
            </tr>

            
            <tr>
                <td class="col-md-2 center">HCV Ab</td>
                <td class="col-md-2 center">
                    <input onclick="addRequired('3')" type="radio" name="HCVab" value="Reactive"  required
                    <?php if(isset($edit)&&$edit['HCVab']=='Reactive'){echo 'checked';} ?>>
                 </td>
                <td class="col-md-2 center">
                    <input onclick="removeRequired('3')" type="radio" name="HCVab" value="Non Reactive" required
                    <?php if(isset($edit)&&$edit['HCVab']=='Non Reactive'){echo 'checked';} ?>>
                </td>
                <td class="col-md-6 left">
                    <div class="form-group col-md-4">
                        <label >s/co1</label>
                        <input type="text" class="form-control 3" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[3]; }?>><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co2</label>
                        <input type="text" class="form-control 3" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[4]; }?>><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co3</label>
                        <input type="text" class="form-control 3" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[5]; }?>><br>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">LIA
                            <label class="radio">
                                <input class="3" type="radio" name="lia" value="negative"
                                <?php if(isset($edit)&&$edit['lia']=='negative'){echo 'checked';} ?>>negative
                            </label>
                            <label class="radio">
                                <input class="3" type="radio" name="lia" value="positive"
                                <?php if(isset($edit)&&$edit['lia']=='positive'){echo 'checked';} ?>>positive
                        </label>
                            <label class="radio">
                                <input class="3" type="radio" name="lia" value="indeterminate"
                                <?php if(isset($edit)&&$edit['lia']=='indeterminate'){echo 'checked';} ?>>indeterminate
                        </label>
                        </label>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="col-md-2 center">HIV Ag/Ab</td>
                <td class="col-md-2 center">
                    <input onclick="addRequired(4)" type="radio" name="HIVag" value="Reactive" required
                    <?php if(isset($edit)&&$edit['HIVag']=='Reactive'){echo 'checked';} ?>>    
                 </td>
                <td class="col-md-2 center">
                    <input onclick="removeRequired(4)" type="radio" name="HIVag" value="Non Reactive" required
                    <?php if(isset($edit)&&$edit['HIVag']=='Non Reactive'){echo 'checked';} ?>>
                </td>
                <td class="col-md-6 left">
                    <div class="form-group col-md-4">
                        <label >s/co1</label>
                        <input type="text" class="form-control 4" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[6]; }?> ><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co2</label>
                        <input type="text" class="form-control 4" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[7]; }?>><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/c03</label>
                        <input type="text" class="form-control 4" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[8]; }?>><br><br>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">LIA
                            <label class="radio">
                                <input class="4" type="radio" name="lia2" value="negative" 
                                <?php if(isset($edit)&&$edit['lia2']=='negative'){echo 'checked';} ?>>negative
                            </label>
                            <label class="radio">
                                <input class="4" type="radio" name="lia2" value="positive"
                                <?php if(isset($edit)&&$edit['lia2']=='positive'){echo 'checked';} ?>>positive                
                            </label>
                        </label>
                    </div>
                </td>
            </tr>


            <tr>
                <td class="col-md-2 center">HTLV-1/11</td>
                <td class="col-md-2 center">
                    <input onclick="addRequired(5)" type="radio" name="HTLV" value="Reactive" required
                    <?php if(isset($edit)&&$edit['HTLV']=='Reactive'){echo 'checked';} ?>> 
                </td>
                <td class="col-md-2 center">
                    <input onclick="removeRequired(5)" type="radio" name="HTLV" value="Non Reactive" required
                    <?php if(isset($edit)&&$edit['HTLV']=='Non Reactive'){echo 'checked';} ?>>    
                </td>
                <td class="col-md-6 left">
                    <div class="form-group col-md-4">
                        <label >s/co1</label>
                        <input type="text" class="form-control 5" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[9]; }?>>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/co2</label>
                        <input type="text" class="form-control 5" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[10]; }?>><br>
                    </div>
                    <div class="form-group col-md-4">
                        <label >s/c03</label>
                        <input type="text" class="form-control 5" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[11]; }?>><br><br>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="">LIA
                            <label class="radio">
                                <input class="5" type="radio" name="lia3" value="negative"
                                <?php if(isset($edit)&&$edit['lia3']=='negative'){echo 'checked';} ?>>negative                
                            </label>
                            <label class="radio">
                                <input class="5" type="radio" name="lia3" value="positive"
                                <?php if(isset($edit)&&$edit['lia3']=='positive'){echo 'checked';} ?>>positive            
                            </label>
                            <label class="radio">
                                <input class="5" type="radio" name="lia3" value="indeterminate"
                                <?php if(isset($edit)&&$edit['lia3']=='indeterminate'){echo 'checked';} ?>>indeterminate
                            </label>
                        </label>
                    </div>
                </td>
            </tr>


            <tr>
                <td class="col-md-2 center">syphilis</td>
                <td class="col-md-2 center">
                    <input onclick="addRequired(6)" type="radio" name="syphilis" value="Reactive" required
                    <?php if(isset($edit)&&$edit['syphilis']=='Reactive'){echo 'checked';} ?>>
                </td>
                <td class="col-md-2 center">
                    <input onclick="removeRequired(6)" type="radio" name="syphilis" value="Non Reactive" required
                    <?php if(isset($edit)&&$edit['syphilis']=='Non Reactive'){echo 'checked';} ?>>    
                </td>
                <td class="col-md-6 left">
                    <div class="form-group col-md-12">
                        <label class="">TBHA
                            <label class="radio">
                                <input class="6" type="radio" name="tb" value="1/80" 
                                <?php if(isset($edit)&&$edit['tb']=='1/80'){echo 'checked';} ?>>1/80              
                            </label>
                            <label class="radio">
                                <input class="6" type="radio" name="tb" value="1/160"
                                <?php if(isset($edit)&&$edit['tb']=='1/160'){echo 'checked';} ?>>1/160          
                            </label>
                            <label class="radio">
                                <input class="6" type="radio" name="tb" value="1/320"
                                <?php if(isset($edit)&&$edit['tb']=='1/320'){echo 'checked';} ?>>1/320
                            </label>
                            <label class="radio">
                                <input class="6" type="radio" name="tb" value="1/640"
                                <?php if(isset($edit)&&$edit['tb']=='1/640'){echo 'checked';} ?>>1/640
                            </label>
                            <label class="radio">
                                <input class="6" type="radio" name="tb" value="1/1280"
                                <?php if(isset($edit)&&$edit['tb']=='1/1280'){echo 'checked';} ?>>1/1280
                            </label>
                        </label>
                    </div>
                </td>
            </tr>


            <tr>
                <td class="col-md-2 center">HBs Ab</td>
                <td class="col-md-2 center">
                    <input onclick="addRequired(7)" type="radio" name="HBs" value="Reactive" required
                    <?php if(isset($edit)&&$edit['HBs']=='Reactive'){echo 'checked';} ?>> 
                </td>
                <td class="col-md-2 center">
                    <input onclick="removeRequired(7)" type="radio" name="HBs" value="0>10" required
                    <?php if(isset($edit)&&$edit['HBs']=='0>10'){echo 'checked';} ?>>(0>10)
                </td>
                <td class="col-md-6 left">
                    <div class="form-group col-md-12">
                        <label class="">
                            <label class="radio">
                                <input onclick="addRequired(8)" class="7" type="radio" name="HBs" value="10>100"
                                <?php if(isset($edit)&&$edit['HBs']=='10>100'){echo 'checked';} ?>>10>100           
                            </label>
                            <label class="radio">
                                 <input class="8" type="number" name="HBsText"<?php if(isset($edit['HBsText'])){echo 'value="'.$edit['HBsText'].'"';} ?>>
                            </label>
                            <label class="radio">            
                                <input onclick="removeRequired(8)" class="7" type="radio" name="HBs" value=">1000"
                                    <?php if(isset($edit)&&$edit['HBs']=='>1000'){echo 'checked';} ?>>>1000
                            </label>
                        </label>
                    </div>
                </td>
            </tr>


            <tr>
                <td class="col-md-2 center">HBc</td>
                <td class="col-md-2 center">
                    <input type="radio" name="HBc" value="Reactive" required
                    <?php if(isset($edit)&&$edit['HBc']=='Reactive'){echo 'checked';} ?>>
                </td>
                <td class="col-md-2 center">
                    <input type="radio" name="HBc" value="Non Reactive" required
                    <?php if(isset($edit)&&$edit['HBc']=='Non Reactive'){echo 'checked';} ?>>
                </td>
            </tr>



        <input type="hidden" name="do" value="<?php echo $_GET['do']; ?>">
        <input type="hidden" name="unitNo" value="<?php echo $_GET['unit'] ?> ">

            <tr>
                <td colspan="4">
                     <input class="col-md-4 col-md-offset-4 btn btn-default" style="color:#000" type="submit" value="Save" name="save"> 
                </td>
            </tr>

        </table>
        </div>
    </form>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><span class="glyphicon glyphicon-chevron-up"></span></button>


<script src="../resource/js/jquery.min.js"></script>
<script>

function addRequired(id) {
   $('.' + id).attr("required", "true");
}

function removeRequired(id) {
   $('.' + id).removeAttr("required");
}















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