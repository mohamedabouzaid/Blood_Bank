<?php


session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='Receptionist' || $_SESSION['job']=='admin')

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
                        $_POST['healthCenter'],$_POST['place'],$_POST['signDate'],$_POST['bloodNo']);
                                $result;
                    }
                    //update file
                        else{


                           $result = Receptionist::update($_POST['NID'], $_POST['firstName'], $_POST['secondName'], $_POST['thirdName'], $_POST['familyName'],
                                $_POST['phone'], $_POST['age'], $_POST['birthday'], $_POST['city'], $_POST['sex'], $_POST['profession']
                                , $_POST['nationality'], $_POST['typeDonar'], $_POST['patient'], $_POST['sponsor'], $_POST['district'], $_POST['street'],
                                $_POST['healthCenter'],$_POST['place'],$_POST['signDate'],$_POST['bloodNo'],$_POST['oldNID']);

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
                    $edit['bloodNo']=$_POST['bloodNo'];
                }


            }





    //edit
    if($do=='edit') {
        $edit=unserialize($_GET["user"]);

    }
// 
    ?>

    <!DOCTYPE html>

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receptionist Operations</title>
    <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/css/Questionnaire.css">
    <link rel="stylesheet" href="../resource/css/Recieptionist.css">
    <link rel="stylesheet" href="../resource/css/header.css">
    </head>

    <body>
        
    <header class="container">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav links">
                <li><a href="Receptionist.php" >Receptionist Home</a></li>
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

        <img src="../resource/images/5.jpg" alt="" class="bg-image">
        <div class="blure-body"></div>
            <div class="form-body col-md-6 col-md-offset-3">
                <h3>Donor Form</h3>
                <form method="post" action="" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-9">
                             <input class="form-control"  placeholder=" مكان التبرع" required type="text" name="place" <?php if(isset($edit['place'])){ echo "value='".$edit['place']."'" ;}?> />
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label"> مكان التبرع</label>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-9">
                        <input class="form-control"  placeholder="رقم وحده الدم" required type="number" name="bloodNo" <?php if(isset($edit['bloodNo'])){ echo "value='".$edit['bloodNo']."'" ;}?> />
                    </div>
                    <label for="inputEmail3" class="col-sm-3 control-label">رقم وحده الدم</label>
                   </div>

                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="التاريخ" required type="text" name="signDate" <?php if(isset($edit['signDate'])){ echo "value='".$edit['signDate']."'" ;} else{echo "value='". date("m/d/Y")."'" ;}?> />
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">التاريخ</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="الاسم الاول" required type="text" name="firstName" <?php if(isset($edit['firstName'])){ echo "value='".$edit['firstName']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['firstName']))){echo $error['firstName'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">الاسم الاول</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="الاسم الثانى" required type="text" name="secondName" <?php if(isset($edit['secondName'])){ echo "value='".$edit['secondName']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['secondName']))){echo $error['secondName'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">الاسم الثانى</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="الاسم الثالث" required type="text" name="thirdName" <?php if(isset($edit['thirdName'])){ echo "value='".$edit['thirdName']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['thirdName']))){echo $error['thirdName'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">  الاسم الثالث</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="الاسم الثالث" required type="text" name="familyName" <?php if(isset($edit['familyName'])){ echo "value='".$edit['familyName']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['familyName']))){echo $error['familyName'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label"> اسم العائله</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder=" رقم السجل المدنى/الاقامه"  required type="number" name="NID"<?php if(isset($edit['NID'])){ echo "value='".$edit['NID']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['NID']))){echo $error['NID'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">  رقم السجل المدنى/الاقامه</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="المدينه" required type="text" name="city"<?php if(isset($edit['city'])){ echo "value='".$edit['city']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['city']))){echo $error['city'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">المدينه</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <select required name="sex" class="form-control">
                                <?php if(isset($edit['sex'])) {echo '<option value="'.$edit['sex'].'">'.$edit['sex'].'</option>';}?>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">الجنس</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                             <input class="form-control"  placeholder=" تاريخ الميلاد" required type="date" name="birthday" <?php if(isset($edit['birthday'])){ echo "value='".$edit['birthday']."'" ;}?> />
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label"> تاريخ الميلاد</label>
                    </div>
                  
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="العمر" required type="number" name="age" <?php if(isset($edit['age'])){ echo "value='".$edit['age']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['age']))){echo $error['age'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">العمر</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="المهنه" required type="text" name="profession" <?php if(isset($edit['profession'])){ echo "value='".$edit['profession']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['profession']))){echo $error['profession'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">المهنه</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <select  required name="nationality" class="form-control">
                                <?php if(isset($edit['nationality'])){ echo'<option value="'.$edit['nationality'].'">'.$nationality[$edit['nationality']].'</option>' ;}?>

                                <option value="0"><?php echo $nationality[0]?></option>
                                <option value="1"><?php echo $nationality[1]?></option>

                            </select>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">الجنسيه</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="اسم الكفيل" type="text" name="sponsor" <?php if(isset($edit['sponsor'])){ echo "value='".$edit['sponsor']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['sponsor']))){echo $error['sponsor'];} ?>  </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">اسم الكفيل</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="رقم الجوال"  required type="number" name="phone" <?php if(isset($edit['phone'])){ echo "value='".$edit['phone']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['phone']))){echo  $error['phone'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">رقم الجوال</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <select  class="form-control" required name="typeDonar" >
                                <?php if(isset($edit['typeDonar'])) {echo '<option value="'.$edit['typeDonar'].'">'.$edit['typeDonar'].'</option>';}?>
                                <option value="طوعى">طوعى</option>
                                <option value="تعويضى">تعويضى</option>
                            </select><br>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">نوع التبرع</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="ادخل اسم المريض"  type="text" name="patient" <?php if(isset($edit['patient'])){ echo "value='".$edit['patient']."'" ;}?> />
                            <span id="helpBlock" class="help-block"> <?php if((isset($error['patient']))){echo $error['patient'];} ?> </span>
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">ادخل اسم المريض</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="الحى"  type="text" name=" district" <?php if(isset($edit['district'])){ echo "value='".$edit['district']."'" ;}?> />
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">الحى</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="الشارع"  type="text" name='street' <?php if(isset($edit['street'])){ echo "value='".$edit['street']."'" ;}?> />
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">الشارع</label>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input class="form-control"  placeholder="المركز الصحى"  type="text" name="healthCenter" <?php if(isset($edit['healthCenter'])){ echo "value='".$edit['healthCenter']."'" ;}?> />
                        </div>
                        <label for="inputEmail3" class="col-sm-3 control-label">المركز الصحى</label>
                    </div>

                    <input type="hidden" name="oldNID" <?php if(isset($edit['NID'])){ echo "value='".$edit['NID']."'" ;}?> ><br>
                    <input type="hidden" name "operation" <?php  echo "value='".$do."'" ;?> >

                        
                    <button type="submit" class="btn btn-danger col-xs-9" value="Insert" name="Insert">Submit</button>

                </form>
            </div>
        </body>
    </html>

    <?php
}
//no permission to access page
else{

    header('location:Login.php');

}
?>