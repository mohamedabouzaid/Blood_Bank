<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/13/2018
 * Time: 1:28 AM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='serology')
{
    if(isset($_POST['save']))
    {
        include "../model/serology.php";
        print_r($_POST);

        if($_POST['do']=='insert'){
            $result= serology::insert($_POST['unitNo'],$_POST['HIV'],$_POST['HBsAg'],$_POST['antiHCV'],
                $_POST['syphilis'],$_POST['antiHBc'],$_POST['HTLV']);}

        else{ $result= serology::update($_POST['unitNo'],$_POST['HIV'],$_POST['HBsAg'],$_POST['antiHCV'],
                $_POST['syphilis'],$_POST['antiHBc'],$_POST['HTLV']);}
        $_SESSION['operation']= $result;
        header('location:NAT.php');
    }
    else {




        ?>


        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <meta charset="UTF-8">
            <title>Serology Department</title>
        </head>


        <body>


        <div class="w3-bar w3-light-grey">
            <a href="bacterial.php" class="w3-bar-item w3-button">Serology Department Home</a>     <!-- Bacterial Department home button -->

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
        include "../model/serology.php";
        $search=serology::search($_GET['unit']);
        if($search){

            //update
            if($_GET['do']=='update') {

                $edit = $search[0];

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





    <h3><?php echo 'Unit NO:  ' . $_GET['unit'] ?> </h3>
    <h5>Enter the Result of Test: </h5>
    <form method="post" action="">

       HIV I/II <input type="radio" name="HIV" value="Reactive"
                  <?php if(isset($edit)&&$edit['HIV']=='Reactive'){echo 'checked';} ?>> Reactive<br>
                <input type="radio" name="HIV" value="Non_Reactive"
                   <?php if(isset($edit)&&$edit['HIV']=='Non_Reactive'){echo 'checked';} ?>>Non Reactive<br><br>

        HBsAg <input type="radio" name="HBsAg" value="Reactive"
            <?php if(isset($edit)&&$edit['HBsAg']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="HBsAg" value="Non_Reactive"
            <?php if(isset($edit)&&$edit['HBsAg']=='Non_Reactive'){echo 'checked';} ?>>Non Reactive<br><br>

        anti HCV <input type="radio" name="antiHCV" value="Reactive"
            <?php if(isset($edit)&&$edit['antiHCV']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="antiHCV" value="Non_Reactive"
            <?php if(isset($edit)&&$edit['antiHCV']=='Non_Reactive'){echo 'checked';} ?>>Non Reactive<br><br>


        syphilis <input type="radio" name="syphilis" value="Reactive"
            <?php if(isset($edit)&&$edit['syphilis']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="syphilis" value="Non_Reactive"
            <?php if(isset($edit)&&$edit['syphilis']=='Non_Reactive'){echo 'checked';} ?>>Non Reactive<br><br>

        anti HBc <input type="radio" name="antiHBc" value="Reactive"
            <?php if(isset($edit)&&$edit['antiHBc']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="antiHBc" value="Non_Reactive"
            <?php if(isset($edit)&&$edit['antiHBc']=='Non_Reactive'){echo 'checked';} ?>>Non Reactive<br><br>

        HTLV <input type="radio" name="HTLV" value="Reactive"
            <?php if(isset($edit)&&$edit['HTLV']=='Reactive'){echo 'checked';} ?>> Reactive<br>
        <input type="radio" name="HTLV" value="Non_Reactive"
            <?php if(isset($edit)&&$edit['HTLV']=='Non_Reactive'){echo 'checked';} ?>>Non Reactive<br><br>

       <!-- <input type="radio" name="test" value="+"
        <//?php if(isset($edit)&&$edit['test']=='+')
        {echo 'checked';} ?>*/> +<br>
        <input type="radio" name="test" value="-"
        <//?php if(isset($edit)&&$edit['test']=='-')
        {echo 'checked';} ?>>-<br><br>-->




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