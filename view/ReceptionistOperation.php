<?php


session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='Receptionist')

{
    $nationality=array("سعودى","غير سعودى");
    //default create file
    $do=isset($_GET['do']) ? $_GET['do']:'create';

    //create file

         //validatiion
        if (isset($_POST['Insert'])) {


            //validate of sponsor
            if ($_POST['nationality'] !=0 &&strlen(filter_var($_POST['sponsor'], FILTER_SANITIZE_STRING))<3 ) {

                $error['sponsor'] = 'Required Sponsor Field More than 2 characters';
            }

            //validate patient
            if ($_POST['typeDonar'] != "طوعى" && strlen(filter_var($_POST['patient'], FILTER_SANITIZE_STRING)) < 3) {


                $error['patient'] = 'Required patient Field More than 2 characters';
            }
            //validate of age and birthday
            if (isset($_POST['birthday']) && isset($_POST['age'])) {

                $birthDate = $_POST['birthday'];
                $birthDate = explode("-", $birthDate);
                //get age from date or birthdate
                $ageTest = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
                    ? ((date("Y") - $birthDate[0]) - 1)
                    : (date("Y") - $birthDate[0]));
                if ($ageTest != filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT)) {

                    $error ['age'] = "Age don't match with birthday";

                }}
                //validate of firstName
                if (strlen(filter_var($_POST['firstName'], FILTER_SANITIZE_STRING)) < 3) {

                    $error['firstName'] = 'firstName field is more than 2';

                }
                //validate of second name
                if (strlen(filter_var($_POST['secondName'], FILTER_SANITIZE_STRING)) < 3) {

                    $error['secondName'] = 'secondName field is more than 2';

                }
                //validate of third name
                if (strlen(filter_var($_POST['thirdName'], FILTER_SANITIZE_STRING)) < 3) {

                    $error['thirdName'] = 'thirdName field is more than 2';

                }
                //validate of family name
                if (strlen(filter_var($_POST['familyName'], FILTER_SANITIZE_STRING)) < 3) {

                    $error['familyName'] = 'familyName field is more than 2';

                }

                //validate of of national id
                if (strlen(filter_var($_POST['NID'], FILTER_SANITIZE_STRING)) != 10) {

                    $error['NID'] = 'national id must be 10 value';

                }
                //validate of of phone
                if (strlen(filter_var($_POST['phone'], FILTER_SANITIZE_STRING)) != 10) {

                    $error['phone'] = 'phone must be 10 value';

                }
                //validate of profession
                if (strlen(filter_var($_POST['profession'], FILTER_SANITIZE_STRING)) < 4) {

                    $error['profession'] = 'profession field is more than 3';

                }
                //validate of city
                if (strlen(filter_var($_POST['city'], FILTER_SANITIZE_STRING)) < 4) {

                    $error['city'] = 'city field is more than 3';

                }
                if (empty($error)) {
                //create file
                    include '../model/Receptionist.php';
                    new Receptionist();

                    //create file
                    if($do=='create'){

                    $result = Receptionist::insert($_POST['NID'], $_POST['firstName'], $_POST['secondName'], $_POST['thirdName'],$_POST['familyName'],
                        $_POST['phone'], $_POST['age'], $_POST['birthday'], $_POST['city'], $_POST['sex'], $_POST['profession']
                        , $_POST['nationality'], $_POST['typeDonar'], $_POST['patient'], $_POST['sponsor'], $_POST['district'], $_POST['street'],
                        $_POST['healthCenter'],$_POST['place'],$_POST['signDate']);
                                $result;
                    }
                    //update file
                        else{


                           $result = Receptionist::update($_POST['NID'], $_POST['firstName'], $_POST['secondName'], $_POST['thirdName'], $_POST['familyName'],
                                $_POST['phone'], $_POST['age'], $_POST['birthday'], $_POST['city'], $_POST['sex'], $_POST['profession']
                                , $_POST['nationality'], $_POST['typeDonar'], $_POST['patient'], $_POST['sponsor'], $_POST['district'], $_POST['street'],
                                $_POST['healthCenter'],$_POST['place'],$_POST['signDate'],$_POST['oldNID']);

                    }
                    //result of create or update
                  $_SESSION['receptionistOperation'] = $result;
                    header('location:Receptionist.php');

                }
                else {
                //error
                    $edit['firstName'] = $_POST['firstName'];
                    $edit['secondName'] = $_POST['secondName'];
                    $edit['thirdName'] = $_POST['thirdName'];
                    $edit['familyName'] = $_POST['familyName'];
                    $edit['NID'] = $_POST['NID'];
                    $edit['city'] = $_POST['city'];
                    $edit['sex'] = $_POST['sex'];
                    $edit['birthday'] = $_POST['birthday'];
                    $edit['age'] = $_POST['age'];
                    $edit['profession'] = $_POST['profession'];
                    $edit['nationality'] = $_POST['nationality'];
                    $edit['phone'] = $_POST['phone'];
                    $edit['typeDonar'] = $_POST['typeDonar'];
                    $edit['patient'] = $_POST['patient'];
                    $edit['street'] = $_POST['street'];
                    $edit['district'] = $_POST['district'];
                    $edit['sponsor'] = $_POST['sponsor'];
                    $edit['healthCenter'] = $_POST['healthCenter'];
                    $edit['place'] = $_POST['place'];
                    $edit['signDate'] = $_POST['signDate'];
                }


            }





    //edit
    if($do=='edit') {
        $edit=unserialize($_GET["user"]);

    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <meta charset="UTF-8">
            <title>Receptionist Operations</title>
        </head>
        <body>
            <div class="w3-bar w3-light-grey">
                <a href="Receptionist.php" class="w3-bar-item w3-button">Receptionist Home</a>
                <div class="w3-dropdown-hover">
                    <!-- user name -->
                    <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button -->
                    </div>
                </div>
            </div>
                <h3>Donar Form</h3>
                <form method="post" action="" class="w3-container">
                    مكان التبرع
                    <input  required type="text" name="place" <?php if(isset($edit['place'])){ echo "value='".$edit['place']."'" ;}?>><br>
                    التاريخ
                    <input  required type="text" name="signDate" <?php if(isset($edit['signDate'])){ echo "value='".$edit['signDate']."'" ;}
                                              else{echo "value='". date("m/d/Y")."'" ;}?>><br>

                    الاسم الاول
                    <input  required type="text" name="firstName" <?php if(isset($edit['firstName'])){ echo "value='".$edit['firstName']."'" ;}?>>
                    <?php if((isset($error['firstName']))){echo $error['firstName'];} ?><br>

                    الاسم الثانى
                    <input required type="text" name="secondName" <?php if(isset($edit['secondName'])){ echo "value='".$edit['secondName']."'" ;}?>>
                    <?php if((isset($error['secondName']))){echo $error['secondName'];} ?><br>

                    الاسم الثالث
                    <input required type="text" name="thirdName" <?php if(isset($edit['thirdName'])){ echo "value='".$edit['thirdName']."'" ;}?>>
                    <?php if((isset($error['thirdName']))){echo $error['thirdName'];} ?><br>

                    اسم العائله
                    <input required type="text" name="familyName"<?php if(isset($edit['familyName'])){ echo "value='".$edit['familyName']."'" ;}?>>
                    <?php if((isset($error['familyName']))){echo $error['familyName'];} ?><br>

                    رقم السجل المدنى/الاقامه
                    <input required type="number" name="NID"<?php if(isset($edit['NID'])){ echo "value='".$edit['NID']."'" ;}?>>
                    <?php if((isset($error['NID']))){echo $error['NID'];} ?><br>
                    المدينه
                    <input required type="text" name="city"<?php if(isset($edit['city'])){ echo "value='".$edit['city']."'" ;}?>>
                    <?php if((isset($error['city']))){echo $error['city'];} ?><br>
                    الجنس
                    <select required name="sex">
                        <?php if(isset($edit['sex'])) {echo '<option value="'.$edit['sex'].'">'.$edit['sex'].'</option>';}?>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select><br>

                    تاريخ الميلاد
                    <input required type="date" name="birthday" <?php if(isset($edit['birthday'])){ echo "value='".$edit['birthday']."'" ;}?>><br>
                    العمر
                    <input required type="number" name="age" <?php if(isset($edit['age'])){ echo "value='".$edit['age']."'" ;}?>>
                    <?php if((isset($error['age']))){echo $error['age'];} ?><br>

                    المهنه
                    <input required type="text" name="profession" <?php if(isset($edit['profession'])){ echo "value='".$edit['profession']."'" ;}?>>
                    <?php if((isset($error['profession']))){echo $error['profession'];} ?><br>

                    الجنسيه

                    <select  required name="nationality" >
                        <?php if(isset($edit['nationality'])){ echo'<option value="'.$edit['nationality'].'">'.$nationality[$edit['nationality']].'</option>' ;}?>

                        <option value="0"><?php echo $nationality[0]?></option>
                        <option value="1"><?php echo $nationality[1]?></option>

                    </select><br>

                    اسم الكفيل

                    <input type="text" name="sponsor" <?php if(isset($edit['sponsor'])){ echo "value='".$edit['sponsor']."'" ;}?>><br>
                    <?php if((isset($error['sponsor']))){echo $error['sponsor'];} ?><br>

                    رقم الجوال
                    <input required type="number" name="phone" <?php if(isset($edit['phone'])){ echo "value='".$edit['phone']."'" ;}?>>
                    <?php if((isset($error['phone']))){echo  $error['phone'];} ?><br>

                    نوع التبرع
                    <select  required name="typeDonar" >
                        <?php if(isset($edit['typeDonar'])) {echo '<option value="'.$edit['typeDonar'].'">'.$edit['typeDonar'].'</option>';}?>
                        <option value="طوعى">طوعى</option>
                        <option value="تعويضى">تعويضى</option>
                    </select><br>

                    ادخل اسم المريض
                    <input   type="text" name="patient" <?php if(isset($edit['patient'])){ echo "value='".$edit['patient']."'" ;}?>><br>
                    <?php if((isset($error['patient']))){echo $error['patient'];} ?><br>

                    الحى
                    <input type="text" name=" district" <?php if(isset($edit['district'])){ echo "value='".$edit['district']."'" ;}?>><br>
                    الشارع
                    <input type="text" name='street' <?php if(isset($edit['street'])){ echo "value='".$edit['street']."'" ;}?>><br>
                    المركز الصحى

                    <input type="text" name="healthCenter" <?php if(isset($edit['healthCenter'])){ echo "value='".$edit['healthCenter']."'" ;}?>><br>

                    <input type="hidden" name="oldNID" <?php if(isset($edit['NID'])){ echo "value='".$edit['NID']."'" ;}?> ><br>
                    <input type="hidden" name "operation" <?php  echo "value='".$do."'" ;?> >


                    <input type="submit" value="Insert" name="Insert">

                </form>










        </body>
    </html>

    <?php
}
//no permission to access page
else{

    header('location:Login.php');

}
?>