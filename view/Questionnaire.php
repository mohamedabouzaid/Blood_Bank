<?php

session_start();

$do='arabic';
if(isset($_GET['language'])){
    $do=$_GET['language'];

}
?>
<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Questionnaire</title>
  <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
  <link rel="stylesheet" href="../resource/css/Questionnaire.css">
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
            <li ><a href="Home.php"> Home</a> </li>      <!-- Home button-->
            <li class="active"><a href="#"> Questionnaire</a> </li>      <!-- qusetionnaire button-->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a class="btn" id="login" href="Login.php">Login</a> </li>       <!-- login button-->
          </ul>
        </div>
      </div>
    </nav>
  </header>


    <img src="../resource/images/5.jpg" alt="" class="bg-image">
    <div class="blure-body"></div>






<?php
//convert Arabic to English
if($do=='arabic'){

    echo'<a href="?language=en">English</a>';
}
else{

    echo'<a href="?language=arabic">arabic</a>';
}


//array of Questions Arabic
$arab=array('ملاحظة','نحن مطالبون بموجب التعليمات و حرصا على سلامة المرضى بطرح الأسئلة التالية و التي لا يقصد بها التدخل في أمور المتبرع الشخصية أو إلحاق أي إساءة به و إذا شعرت بعدم الرغبة في الإجابة عليها الرجاء إعادة الورقة إلى الموظف مع العلم بأن كافة الإجابات ستعامل بسرية تامة.'
    ,'هل ؟','تتمتع بالصحة و العافية اليوم؟ و هل حصلت على قسط كاف من النوم؟','تناولت وجبة خلال الثلاث ساعات الماضية؟',
    'تتناول أي مضاد حيوي؟','تتناول حاليا أي أدوية أخرى لعلاج الالتهاب؟','تتناول حاليا أو سبق لك أن تناولت أي من الأدوية التالية: بروسكار - افودارت–بروبيشيا–اكيوتان–سورياتان–تيجيسون– هرمون النمو –اميونوجلوبلين الكبد الوبائي (ب)؟'
    ,'اطلعت على المواد الثقافية و حصلت على إجابات لتساؤلاتك؟','خلال الـ 48 ساعة الماضية هل:','تناولت الأسبرين أو أي دواء يحتوي على الأسبرين؟'
    ,'للإناث فقط: هل سبق لك الحمل أو أنك حامل الآن؟  ','خلال الـ 8 أسابيع الماضية هل:','تبرعت بالدم أو بصفائح الدم أو ببلازما الدم؟',
    'تلقيت أي لقاح أو أي إبرة؟','كان لك اتصال مع شخص تلقى لقاح الجدري؟','خلال الـ 16 أسبوع الماضية هل','تبرعت بوحدتي خلايا دم باستخدام جهاز سحب و فرز مشتقات الدم؟'
,'خلال الـ 12 شهر الماضية هل:','خضعت لعملية زرع عضو أو نسيج أو نخاع عظم؟','خضعت لعملية ترقيع عظمي أو جلدي؟','لامست دم شخص آخر؟',
    'تعرضت لحادثة وخز عرضي بإبرة؟','كان لك إتصال جنسي مع أي شخص مصاب بفيروس نقص المناعة المكتسب " الإيدز " أو كانت نتيجة اختبار فيروس نقص المناعة المكتسب " الإيدز " لديه ايجابية؟ '
,'كان لك اتصال جنسي مع مومس أو أي شخص يتقاضى المال أو المخدرات أو غيرها مقابل الجنس؟','كان لك اتصال جنسي مع شخص اعتاد على استخدام الإبر لتعاطي المخدرات أو الستيرويدات أو أي مستحضر لم يصفه الطبيب؟'
,'كان لك اتصال جنسي مع أي شخص مصاب بالنزاف " الناعور " أو يستخدم محاليل عوامل التجلط المركزة؟'
,'للإناث فقط: هل كان لك اتصال جنسي مع رجل له اتصال جنسي مع رجل لآخر؟','كان لك اتصال جنسي مع أي شخص مصاب بالتهاب كبدي؟','أقمت مع شخص مصاب بالتهاب كبدي؟'
,'خضعت لوشم أو ثقب للأذن أو أي منطقة من الجسم؟','خضعت أو تخضع حاليا للعلاج من مرض الزهري أو السيلان؟','تم إيقافك في سجن الأحداث أو سجن عادي لمدة تزيد عن 72 ساعة؟'
,'أجريت عملية حجامة؟','خلال فترة الـ 3 سنوات الماضية هل','سافرت خارج المملكة العربية السعودية؟','أصبت بالملاريا أو زرت بلدا تتفشى فيه الملاريا؟'
,'منذ عام 1980 م إلى 1996 م هل','أمضيت (3) أشهر أو أكثر في المملكة المتحدة ( فضلا راجع قائمة المناطق في المملكة المتحدة )؟'
,'منذ عام 1980 م و حتى اليوم هل','قضيت (5) سنوات أو أكثر في أوروبا ( فضلا راجع قائمة الدول الأوروبية )؟','نقل لك وحدات دم في المملكة المتحدة أو فرنسا( فضلا راجع قائمة المناطق في المملكة المتحدة )؟'
,'منذ العام 1970 م و حتى اليوم هل','تلقيت المال أو المخدرات أو غيرها مقابل الجنس؟','للذكور فقط: هل كان لك اتصال جنسي برجل آخر أو لمرة واحدة فقط؟  '
,'هل سبق لك أن','تم نقل وحدات دم إليك؟','كانت نتيجة فحص فيروس نقص المناعة المكتسب " الإيدز " موجبة؟','استخدمت الإبر لأخذ حقن أو ستيرويد أو أي مستحضر دوائي لم يصفه لك الطبيب؟'
,'استخدمت محاليل عوامل التجلط المركزة أو الأنسولين؟','أصبت بالالتهاب الكبدي؟','تعرضت للأمراض التالية ( شاغاس–بابييزا– الحمى المالطية )؟'
,'أجريت ترقيع الأم الجافية ( غطاء الدماغ )؟','تعرضت لأي نوع من السرطان بما في ذلك سرطان الدم ( اللوكيميا )؟','تعرضت لأي مشكلة في القلب أو الرئتين؟'
,'تعرضت لحالة نزيف دموي أو مرض دموي؟','كان لك اتصال جنسي مع أي شخص ولد أو عاش في أفريقيا؟','قمت بزيارة أفريقيا؟','كان أحد أقاربك يعاني من مرض ( كروتزفيلد– جاكوب – جنون البقر )؟'
,'هل تتبرع بدمك لأحد أفراد عائلتك ( أبناء – أخوة – والدين ) من الذين سيحصلون على الدم؟','تبرعت بالدم تحت اسم مختلف أو رقم بطاقة مختلف؟'
,'تقدمت للتبرع بالدم و رفضت أو طلب منك عدم التبرع؟','تبرعت بالدم و طلبت عدم إعطاء الدم للمريض؟','هل تريد التبرع بالدم لإنقاص نسبة هيموجلوبين الدم ( نسبة الحديد بالدم )؟'
,'هل تريد التبرع بالدم من أجل إجراء فحص الإيدز أو أي فحوصات أخرى فقط؟'
,':إقرار المتبرع','قرأت و تفهمت المعلومات المقدمة لي حول انتشار فيروس الايدز من خلال الدم و البلازما, و إن كنت أشكل خطرا لانتشار الفيروس المسبب لمرض الايدز فإنني أوافق على الامتناع عن التبرع بالدم أو البلازما بغرض نقلهما إلى شخص آخر أو بغرض تصنيعهما, أدرك بأنه سيتم إخضاع عينة من دمي لاختبار الإيدز و غيره من الأمراض و إذا تبين بنتيجة الاختبار بأنه ينبغي على الامتناع عن التبرع بالدم أو البلازما بسبب خطر نقل فيروس  الايدز فإن اسمي سوف يدرج على لائحة المتبرعين للممنوعين من التبرع بالدم بشكل دائم , أدرك أيضا بأنه سيتم إبلاغي في حال كانت نتيجة الاختبار ايجابية و إذا لم تظهر نتيجة ايجابية أو سلبية واضحة للاختبار فإن دمي لن يتم استخدامه و اسمي قد يدرج على قائمة المؤجلين دون إبلاغي بذلك إلى حين توضيح النتائج بشكل مستفيض, أعلم أيضا بإمكانية انسحابي من عملية التبرع في كل وقت ( قبل – أثناء – أو بعد التبرع بالدم ) إذا شعرت بأن دمي غير صالح للنقل إلى المرضى, أعلم أيضا بأنه يمكنني إتمام عملية التبرع مع عدم إعطاء الدم المتبرع به إلى المرضى و ذلك بوضع علامة على مربع ( أرجو استخدام دمي بغرض الأبحاث فقط ) أسفل الصفحة, أعلم أيضا أنه في بعض الحالات الطارئة يتم صرف الدم أو البلازما الذي تبرعت به من دون إجراء بعض أو حتى كل الفحوصات للأمراض المعدية , أفوض مركز التبرع بالدم بسحب 450 ملليلتر  ( تقريبا ) من دمي أو لإجراء عملية سحب مشتقات الدم الآلية و أمكنهم من التصرف بدمي بالطريقة المناسبة, لقد قمت بالإجابة على جميع الأسئلة بكل مصداقية و المعلومات التي أدليت بها صحيحة و على مسؤوليتى   '
,':هل تريد ان تكون صديق بنك الدم',' فى حاله الحاجه الى دم ,سوف يتم الاتصال بك','الاستبيان','نعم','لا','السؤال'
);

//array of Questions English

$eng=array('Attention:','We are required by regulations, and for the safety of our patients to ask the following questions. They are not meant to be personal or offensive. If you don’t feel that you are willing to answer them, please hand this paper to the donor center staff. All answers are confidential.'
,'Are you','Feeling healthy and well today? And have you had a good sleep?','Have a meal in the last three hours?','Currently taking an antibiotic?'
,'Currently taking any other medication for an infection?','Are you now taking or have you ever taken any of the following medications: Proscar, Avodart, Propeia, Accutane, Soriatane, Tegison, Growth Hormone, Hepatitis B Immune Globulin?'
,'Have you read the educational materials? and have your questions been answered?','In the past 48 hours','Have you taken aspirin or anything that has aspirin in it?'
,'Female donors: Have you been pregnant or are you pregnant now?',

    'In the past 8 Weeks','Donated blood , platelets or plasma?','Had any vaccinations or other shots?'
,'Had contact with someone who had a smallpox vaccination?','In the past 16 weeks:','Have you donated a double unit of red cells using an apheresis?'
,'In the past 12 months have you','Had a transplant such as organ, tissue, or bone marrow?','Had a graft such as bone or skin?'
,'Come into contact with someone else\'s blood?','Had an accidental needle-stick?','17-	Had sexual contact with anyone who has HIV/AIDS or has had a positive test for the HIV/AIDS virus?'
,'Had sexual contact with a prostitute or anyone who takes money or drugs or steroids, or anything not prescribed by their doctor?',
'Has sexual contact with anyone who has ever used needles to take drugs or steroids, or anything not prescribed by their doctor?',
 'Had sexual contact with anyone who has hemophilia or has used clotting factor concentrates?','-  Female donors: Had sexual contact with a male who has ever had sexual contact with another male?','Had sexual contact with a person who has hepatitis?'
 ,'Lived with a person who has hepatitis?','Had a tattoo, ear, or body piercing?','Had or been treated for syphilis or gonorrhea?',
 'Been in juvenile detention, lockup, jail, or prison for more than 72 hours?','PerformedHijama ( Blood Letting )?','In the past 3 years have you'
    ,'Been outside Saudi Arabia?','Had malaria or visited a country with endemic malaria?','From 1980 through 1996',' Did you spend time that adds p to three (3) months or more in the United Kingdom?
( Review list of countries in the United Kingdom )','From 1980 to the present, did you','Spend time that adds up to five (5) years or more in Europe?
( Review list of countries in Europe )','Receive a blood transfusion in the United Kingdom or France?
( Review list of cities in the United Kingdom )','From 1977 to the present, have you','Received money, drugs, or other payment for sex?',
    '-  Male donors: Had sexual contact with another male, even once?
( Female check " I am female " )','Have you ever','Had a blood transfusion?','Has a positive test for the HIV / AIDS virus?','Used needles to take drugs, steroids, or anything not prescribed by your doctor?'
    ,'Used clotting factor concentrate or Insulin?','Had hepatitis?','HadChagas, babesiosisor Brucellosis?','Received a dura matter ( or a brain covering ) graft?'
    ,'Had any type of cancer, Including leukemia?','Had any problems with your heart or lungs?',' Had any bleeding condition or a blood disease?'
    ,'Had sexual contact with anyone who was born in or lived in Africa?','Been in Africa?','Have any of your relatives had Creutzfeldt-Jakob disease?',
    'Are you donating blood for a family member who may receive blood product from?',' Have you ever given blood under a different name or ID number?',
    'Have you ever been refused as a blood donor or told not to donate blood?','Have you ever requested that your donated blood would not be given to patients?',
    'Are you giving blood to reduce your hemoglobin level?','Are you given blood to be tested for AIDS or any other blood tests?'
,'Donor Consent:','I have read and understand the information provided to me regarding the spread of the AIDS virus ( HIV ) by blood and plasma. If I am potentially at risk of spreading the virus known to cause AIDS, I agree NOT to donate blood or plasma for transfusion to another person or for further manufacture. I understand that my blood will be tested for HIV and other disease markers. If this testing that I should no longer donate blood or plasma because of the risk of transmitting the Aids virus, mu name will be entered on a list of permanently deferred donors. I understand that I will be notified of positive laboratory test result (s). If, instead, the results of the testing are not clearly negative or positive, my blood will not be used. And my name may be placed on a deferral list without me being informed until the results are further clarified. I have been informed of the possibilities for withdrawal from the blood donation process AT ANY TIME before, during, or after the donation process if I believe that may blood is not suitable for transfusion. I have been informed that I may complete the donation process, but not have my blood transfused to a patient by selecting that " use my blood for research only " box if I believe that my blood is not suitable for transfusion. I have been informed that there are circumstances in which infectious diseases tests may not be performed. I have been informed that in some circumstances the blood may be transfused before all tests for infectious diseases are completed, and there may be circumstances in which in infectious diseases tests are not performed at all before transfusing. I hereby grant permission to the blood bank to draw approximately 450 ml of whole blood, or perform a APHARESIS procedure, and the blood product may be used in such manner as the blood bank may deem desirable. The medical history I have furnished to the interviewer is true and accurate to the best of my knowledge.'
    ,'Do you want to be a blood bank friend','if we need blood ,will contact to you','Questionnaire','Yes','No','Question'




);

if($do=='arabic'){

    $q=$arab;


}
else{
    $q=$eng;
}







//insert question
if(isset($_POST['accept'])) {
    $quesions = implode('-', $_POST);
    include "../model/donar.php";
    new donar();
    //update
        if (donar::search($_SESSION['donar_id'])!=null){
            $result = donar::update($quesions, $_SESSION['donar_id']);
    }
    //insert
    else{
    $result = donar::insert($quesions, $_SESSION['donar_id']);
        }
    $_SESSION['Questionnire'] = $result;
    if (isset($_POST['friend'])) {
        include '../model/Receptionist.php';
        new Receptionist();
        Receptionist::updateFriend($_SESSION['donar_id']);
    }
    header('location:Home.php');

}
        ?>



    <?php


         echo'   <div>';
           echo   $_SESSION['donar_name'] .'</div>';
            ?>
            <!--ملاحظه-->
             <div class="report">
                 <h3><?php  echo $q[0]?> </h3>
                 <?php echo $q[1] ?>

             </div>

            <div class="col-md-8 col-md-offset-2">
              <!--      questionnaire form-->

            <form action="" method="post">
                <div class="table-container">
                
                <table class="table table-hover ">
                    <caption><?php echo $q[69] ;?></caption>
                    <tr>


                        <th><?php echo $q[71] ;?></th>
                        <th><?php echo $q[70] ;?></th>
                        <th><?php echo $q[72] ;?></th>
                    </tr>

                    <?php

                    for ($x = 2; $x < 65; $x++) {
                        if ($x == 2 || $x==9 || $x==12 || $x==16 || $x==18 || $x==34 || $x==37 || $x==39 || $x==42 || $x==45) {
                            echo "   <tr>
                            <td colspan='3'>" . $q[$x] . "</td>
                        </tr>";

                        } else {

                            echo "   <tr>
                        
                            
                            <td><input type=\"radio\" name=\"q" . $x . "\" value=\"1\" ></td>
                            <td><input type=\"radio\" name=\"q" . $x . "\" value=\"0\"></td>
                            <td>" . $q[$x] . "</td>
                        </tr>";

                        }
                    }

                    ?>


                </table>
                </div>


<!--صديق بنك الدم-->
                <div class="report">
                    <h4><?php echo $q[67];?></h4>
                    <p>
                        <?php echo  '<input type="checkbox" name="friend"  value="1" >'.$q[68];?>



                    </p>

                </div>

<!--الفرار-->

                <div class="report">
                    <h4>  <?php echo $q[65];?></h4>
                    <p>
                       <?php echo$q[66];?>
                        <input class="btn btn-danger" type="submit" value="موافق" name="accept" >

                    </p>

                </div>





