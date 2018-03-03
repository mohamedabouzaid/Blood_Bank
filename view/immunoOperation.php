<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/13/2018
 * Time: 1:28 AM
 */
session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='Immuno')
{
    if(isset($_POST['save']))
    {
        include "../model/immuno.php";


        if($_POST['do']=='insert'){
            $result= immuno::insert($_POST['unitNo'],$_POST['RH'],$_POST['ABO'],$_POST['anti'],
                $_POST['phenotype']);}

        else{ $result= immuno::update($_POST['unitNo'],$_POST['RH'],$_POST['ABO'],$_POST['anti'],
                $_POST['phenotype']);}
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
            <a href="immuno.php" class="w3-bar-item w3-button">Immuno Department Home</a>     <!-- Bacterial Department home button -->

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
        include "../model/immuno.php";
        $search=immuno::search($_GET['unit']);
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

        RH <input type="radio" name="RH" value="+"
            <?php if(isset($edit)&&$edit['RH']=='+'){echo 'checked';} ?>> +<br>

        <input type="radio" name="RH" value="-"
            <?php if(isset($edit)&&$edit['RH']=='-'){echo 'checked';} ?>>-<br><br>

        ABO <input type="radio" name="ABO" value="A"
            <?php if(isset($edit)&&$edit['ABO']=='A'){echo 'checked';} ?>> A<br>

        <input type="radio" name="ABO" value="B"
            <?php if(isset($edit)&&$edit['ABO']=='B'){echo 'checked';} ?>>B<br>

          <input type="radio" name="ABO" value="AB"
            <?php if(isset($edit)&&$edit['ABO']=='AB'){echo 'checked';} ?>> AB<br>

        <input type="radio" name="ABO" value="O"
            <?php if(isset($edit)&&$edit['ABO']=='O'){echo 'checked';} ?>>O<br><br>


        antibody Screnning <input type="radio" name="anti" value="+"
            <?php if(isset($edit)&&$edit['anti']=='+'){echo 'checked';} ?>>+<br>
        <input type="radio" name="anti" value="-"
            <?php if(isset($edit)&&$edit['anti']=='-'){echo 'checked';} ?>>-<br><br>

        phenotype
        <select required name="phenotype">
            <?php if(isset($edit['phenotype'])) {echo '<option value="'.$edit['phenotype'].'">'.$edit['phenotype'].'</option>';}?>
            <option value="CDcEe">CDcEe</option>
            <option value="CcDee">CcDee</option>
            <option value="CCDee">CCDee</option>
        </select><br>


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