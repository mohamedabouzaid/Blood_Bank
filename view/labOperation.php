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
                $_POST['HBs'],$_POST['HBc'],$s);
        }

        //update
        else{

            $result= malaria::update($_POST['unitNo'],$_POST['test'],$_POST['confirmation']);
            $result.=NATmodel::update($_POST['unitNo'],$_POST['HBV'],$_POST['HCV'],$_POST['HIV']);
            $result.=serology::update($_POST['unitNo'],$_POST['HBsAg'],$_POST['neut'],$_POST['HCVab'],
                $_POST['lia'],$_POST['HIVag'],$_POST['lia2'],$_POST['HTLV'],$_POST['lia3'],$_POST['syphilis'],$_POST['tb'],
                $_POST['HBs'],$_POST['HBc'],$s);

        }
        $_SESSION['operation']= $result;
        header('location:lab.php');
    }
    else {




        ?>


        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <meta charset="UTF-8">
            <title>lab Department</title>
        </head>


        <body>


        <div class="w3-bar w3-light-grey">
            <a href="lab.php" class="w3-bar-item w3-button">lab Department Home</a>     <!-- lab Department home button -->

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
                echo "Result already inserted";
                die();}

        }
        else{

            if($_GET['do']=='update'){

                echo "no data entered ";
                die();}

        }

    }

    ?>




<!--malaria-->
    <h3><?php echo 'Unit NO:  ' . $_GET['unit'] ?> </h3>
    <h5> Malaria: </h5>
    <form method="post" action="">
        test<br>
        Positive<input type="radio" name="test" value="Positive" <?php if(isset($edit)&&$edit['test']=='Positive')
        {echo 'checked';} ?>> <br>
        Negative<input type="radio" name="test" value="Negative" <?php if(isset($edit)&&$edit['test']=='Negative')
        {echo 'checked';} ?>><br>
        Confirmation<br>
        Think film<br>
        <input type="radio" name="confirmation" value="Seen" <?php if(isset($edit)&&$edit['confirmation']=='Seen')
        {echo 'checked';} ?>> Seen<br>
        <input type="radio" name="confirmation" value="Not Seen" <?php if(isset($edit)&&$edit['confirmation']=='Not Seen')
        {echo 'checked';} ?>>Not seen<br><br>




<!--nat-->

        <h5>Nat: </h5>

        HBV:<br>
        <input type="radio" name="HBV" value="Reactive" <?php if(isset($edit)&&$edit['HBV']=='Reactive')
        {echo 'checked';} ?>> Reactive<br>


        <input type="radio" name="HBV" value="Non Reactive"  <?php if(isset($edit)&&$edit['HBV']=='Non Reactive')
        {echo 'checked';} ?>>Non Reactive<br>

        <input type="radio" name="HBV" value="invalid"  <?php if(isset($edit)&&$edit['HBV']=='invalid')
        {echo 'checked';} ?>>invalid<br><br>

        HCV:<br>
        <input type="radio" name="HCV" value="Reactive"  <?php if(isset($edit)&&$edit['HCV']=='Reactive')
        {echo 'checked';} ?>> Reactive<br>

        <input type="radio" name="HCV" value="Non Reactive" <?php if(isset($edit)&&$edit['HCV']=='Non Reactive')
        {echo 'checked';} ?>>Non Reactive<br>

        <input type="radio" name="HCV" value="invalid"  <?php if(isset($edit)&&$edit['HCV']=='invalid')
        {echo 'checked';} ?>>invalid<br><br>

        HIV:<br>
        <input type="radio" name="HIV" value="Reactive" <?php if(isset($edit)&&$edit['HIV']=='Reactive')
        {echo 'checked';} ?>> Reactive<br>

        <input type="radio" name="HIV" value="Non Reactive" <?php if(isset($edit)&&$edit['HIV']=='Non Reactive')
        {echo 'checked';} ?>>Non Reactive<br>

        <input type="radio" name="HIV" value="invalid"  <?php if(isset($edit)&&$edit['HIV']=='invalid')
        {echo 'checked';} ?>>invalid<br><br>




<!--serology-->
        <h5>serology: </h5>


        HBsAg <input type="radio" name="HBsAg" value="Reactive"
            <?php if(isset($edit)&&$edit['HBsAg']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="HBsAg" value="Non Reactive"
            <?php if(isset($edit)&&$edit['HBsAg']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
        Confirmation<br>
        s/co1<input type="text" name="s_list[]"   <?php if(isset($edits)){echo "value=".$edits[0]; }?>><br>
        s/co2<input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[1]; }?>><br>
        s/c03 <input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[2]; }?>><br><br>
        Neutraliation<br>
        <input type="radio" name="neut" value="Reactive-confirmed"
            <?php if(isset($edit)&&$edit['neut']=='Reactive-confirmed'){echo 'checked';} ?>>Reactive-confirmed<br>
        <input type="radio" name="neut" value="Non confirmed"
            <?php if(isset($edit)&&$edit['neut']=='Non confirmed'){echo 'checked';} ?>>Non confirmed<br><br>


        HCV Ab <input type="radio" name="HCVab" value="Reactive"
            <?php if(isset($edit)&&$edit['HCVab']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="HCVab" value="Non Reactive"
            <?php if(isset($edit)&&$edit['HCVab']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
        Confirmation<br>
        s/co1<input type="text" name="s_list[]" <?php if(isset($edits)){echo "value=".$edits[3]; }?> ><br>
        s/co2<input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[4]; }?>><br>
        s/c03 <input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[5]; }?>><br><br>
        LIA<br>
        <input type="radio" name="lia" value="negative"
            <?php if(isset($edit)&&$edit['lia']=='negative'){echo 'checked';} ?>>negative<br>
        <input type="radio" name="lia" value="positive"
            <?php if(isset($edit)&&$edit['lia']=='positive'){echo 'checked';} ?>>positive<br>
        <input type="radio" name="lia" value="indeterminate"
            <?php if(isset($edit)&&$edit['lia']=='indeterminate'){echo 'checked';} ?>>indeterminate<br><br>


        HIV Ag/Ab <input type="radio" name="HIVag" value="Reactive"
            <?php if(isset($edit)&&$edit['HIVag']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="HIVag" value="Non Reactive"
            <?php if(isset($edit)&&$edit['HIVag']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
        Confirmation<br>
        s/co1<input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[6]; }?> ><br>
        s/co2<input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[7]; }?>><br>
        s/c03 <input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[8]; }?>><br><br>

        <input type="radio" name="lia2" value="negative"
            <?php if(isset($edit)&&$edit['lia2']=='negative'){echo 'checked';} ?>>negative<br>
        <input type="radio" name="lia2" value="positive"
            <?php if(isset($edit)&&$edit['lia2']=='positive'){echo 'checked';} ?>>positive<br><br>



        HTLV-1/11 <input type="radio" name="HTLV" value="Reactive"
            <?php if(isset($edit)&&$edit['HTLV']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="HTLV" value="Non Reactive"
            <?php if(isset($edit)&&$edit['HTLV']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
        Confirmation<br>
        s/co1<input type="text" name="s_list[]"   <?php if(isset($edits)){echo "value=".$edits[9]; }?>><br>
        s/co2<input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[10]; }?>><br>
        s/c03 <input type="text" name="s_list[]"  <?php if(isset($edits)){echo "value=".$edits[11]; }?>><br><br>
        LIA<br>
        <input type="radio" name="lia3" value="negative"
            <?php if(isset($edit)&&$edit['lia3']=='negative'){echo 'checked';} ?>>negative<br>
        <input type="radio" name="lia3" value="positive"
            <?php if(isset($edit)&&$edit['lia3']=='positive'){echo 'checked';} ?>>positive<br>
        <input type="radio" name="lia3" value="indeterminate"
            <?php if(isset($edit)&&$edit['lia3']=='indeterminate'){echo 'checked';} ?>>indeterminate<br><br>




        syphilis <input type="radio" name="syphilis" value="Reactive"
            <?php if(isset($edit)&&$edit['syphilis']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="syphilis" value="Non Reactive"
            <?php if(isset($edit)&&$edit['syphilis']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>
        TBHA<br>
        <input type="radio" name="tb" value="1/80"
            <?php if(isset($edit)&&$edit['tb']=='1/80'){echo 'checked';} ?>>1/80<br>
        <input type="radio" name="tb" value="1/160"
            <?php if(isset($edit)&&$edit['tb']=='1/160'){echo 'checked';} ?>>1/160<br>
        <input type="radio" name="tb" value="1/320"
            <?php if(isset($edit)&&$edit['tb']=='1/320'){echo 'checked';} ?>>1/320<br>
        <input type="radio" name="tb" value="1/640"
            <?php if(isset($edit)&&$edit['tb']=='1/640'){echo 'checked';} ?>>1/640<br>
        <input type="radio" name="tb" value="1/1280"
            <?php if(isset($edit)&&$edit['tb']=='1/1280'){echo 'checked';} ?>>1/1280<br><br>


         HBs Ab <input type="radio" name="HBs" value="0>10"
            <?php if(isset($edit)&&$edit['HBs']=='0>10'){echo 'checked';} ?>> 0>10<br><br>

        <input type="radio" name="HBs" value="10>100"
            <?php if(isset($edit)&&$edit['HBs']=='10>100'){echo 'checked';} ?>>10>100<br><br>
        <input type="radio" name="HBs" value="<100"
            <?php if(isset($edit)&&$edit['HBs']=='<100'){echo 'checked';} ?>><100<br><br>

        HBc <input type="radio" name="HBc" value="Reactive"
            <?php if(isset($edit)&&$edit['HBc']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="HBc" value="Non Reactive"
            <?php if(isset($edit)&&$edit['HBc']=='Non Reactive'){echo 'checked';} ?>>Non Reactive<br><br>




        <input type="hidden" name="do" value="<?php echo $_GET['do']; ?>">
        <input type="hidden" name="unitNo" value="<?php echo $_GET['unit'] ?> ">

        <input type="submit" value="Save" name="save">


    </form>



    <?php



}

//no permission to access page
else{

    header('location:Login.php');

}