<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='Physician' || $_SESSION['job']=='admin'){


    ?>
<!-- 
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
    <a href="physician.php" class="w3-bar-item w3-button">Clinic Home</a>     <!-- clinic home button --
    <div class="w3-dropdown-hover">
        <!-- user name -
        <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>
            <!-- logout button --
        </div>
    </div>
</div> -->
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clinic</title>
    <link rel="stylesheet" href="../resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resource/css/Questionnaire.css">
    <link rel="stylesheet" href="../resource/css/header.css">
    <link rel="stylesheet" href="../resource/css/Recieptionist.css">
    <style>
        .col-md-10{
            background: #b9403ed4;
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
                         <a href="physician.php" >Clinic Home</a>     <!-- clinic home button -->
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



include '../model/physician.php';
new physician();
$accept = physician::check($_GET['nid'], 0);
$reject = physician::check($_GET['nid'], 1);
$updateCkeck=physician::checkUpdate(($_GET['nid']));

if ($accept != null &&$_GET['do']=='check'){

    echo '<h3 class="col-md-10 col-md-offset-1" style="margin-top: 75px;  background:#ffffffeb; text-align:center">You arleady checked it and Accept</h3>';

    exit();
} elseif ($reject != null && $_GET['do']=='check') {

    echo '<h3 class="col-md-10 col-md-offset-1" style="margin-top: 75px;  background:#ffffffeb; text-align:center">You arleady checked it and Reject</h3>';

    exit();

}

else{


    //check update
   if( $_GET['do']=='update'&&$updateCkeck ==null){

         echo "you must insert first";
         exit();


   }


//accept
if (isset($_GET['do']) && $_GET['do'] == 'accept'){
   if($_GET['mod']=='check'){
       //insert
    $result = physician::status(0, $_GET['nid']);}
    //update
    else{$result=physician::updateStatus(0, $_GET['nid']);}
    $_SESSION['operation'] = $result;
    header('location:physician.php');


} //reject
elseif (isset($_GET['do']) && $_GET['do'] == 'reject') {

    if($_GET['mod']=='check'){
        //insert
    $result = physician::status(1, $_GET['nid']);}
    //update
    else{$result=$result=physician::updateStatus(1, $_GET['nid']);}

    $_SESSION['operation'] = $result;
    header('location:physician.php');
} // form of questionnaire and health information
else{



//health information
$result = physician::search($_GET['nid']);
//questionnaire
$questions = physician::searchQ($_GET['nid']);
$resultQuestions = explode('-', $questions);

    $q=array(
    'هل ؟','تتمتع بالصحة و العافية اليوم؟ و هل حصلت على قسط كاف من النوم؟','تناولت وجبة خلال الثلاث ساعات الماضية؟',
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


?>


<h3 class="col-md-10 col-md-offset-1" style="margin-top: 75px;  background:#ffffffeb; text-align:center; margin-bottom: -15px;">The result of questionnire</h3>
<?php
//questionnaire









    /*
for ($x = 0; $x < 63; $x++) {
    echo ' <ul >';

    if ($resultQuestions[$x] == 0) {

        echo '<li>' . $q[$x] . ' </li> ';

    }
    echo '</ul>';

}
*/


?>
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-hover">
            <thead>
            <tr class="w3-red">
                <th>السؤال</th>
                <th>نعم</th>
                <th>لا</th>
            </tr>
            <?php for ($x = 0; $x < 63; $x++) { ?>
            </thead>
            <tr>
                <td><?php echo  $q[$x] ;?></td>
                <td><?php if ($resultQuestions[$x] == 0){echo "&#10004;";}?></td>
                <td><?php if ($resultQuestions[$x] == 1){echo "&#10004;";} ?></td>
            </tr>
            <?php }?>

        </table>
    </div>


<!--health information-->
<h3 class="col-md-10 col-md-offset-1"style="margin-top: 44px;  margin-bottom: -15px ;background:#ffffffeb; text-align:center"> Donner health information</h3>

<div class="col-md-10 col-md-offset-1" style="margin-bottom: 21px;">
<table class="table table-hover ">
    <tr class="w3-blue">
        <th>Weight(KG)</th>
        <th>Height(cm)</th>
        <th>Temp(c)</th>
        <th> Blood Group</th>
        <th>HB(g/d)</th>
        <th>Pluse(bpm)</th>
        <th>Bp(mmHg)</th>
    </tr>
    <tr>
        <?php foreach ($result

        as $user){ ?>
        <td><?php echo $user['weight'] ?> </td>
        <td><?php echo $user['height'] ?> </td>
        <td><?php echo $user['temp'] ?> </td>
        <td><?php echo $user['bloodGroup'] ?> </td>
        <td><?php echo $user['hp'] ?> </td>
        <td><?php echo $user['pluse'] ?> </td>
        <td><?php echo $user['bp'] ?> </td>


    </tr>
    <?php } ?>
</table>
    <a class="btn btn-default" href="?do=accept&nid=<?php echo $_GET['nid']; ?>&mod=<?php echo $_GET['do']; ?>"> Accept</a>
    <a class="btn btn-default" href="?do=reject&nid=<?php echo $_GET['nid']; ?>&mod=<?php echo $_GET['do']; ?>"> Rejecting</a>
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
}
}
//no permission to access page
else{

    header('location:Login.php');

}
?>
