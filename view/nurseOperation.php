<?php


session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='Nurse' || $_SESSION['job']=='admin') {


    if (isset($_POST['insert'])) {
//the comment


        if (!empty($_POST['comments_list'])) {
            $comment = implode('-', $_POST['comments_list']);
        } else {
            $comment = "";
        }

//insert data of blood
        include '../model/NurseModel.php';
        $result = NurseModel::insert($_POST['ID_Blood'], $_POST['NID'], $_POST['bagWeight'],
            $_POST['bloodGroup'], $_POST['time'], $comment,$_POST['arm'],$_POST['visual'],$_POST['x']);

        $_SESSION['operation']=$result;
        header("location:nurse.php");

    }




    elseif (isset($_POST['edit'])) {
//the comment
        if (!empty($_POST['comments_list'])) {
            $comment = implode('-', $_POST['comments_list']);
        } else {
            $comment = "other";
        }

//update data of blood
        include '../model/NurseModel.php';
        $result = NurseModel::update($_POST['ID_Blood'], $_POST['NID'], $_POST['bagWeight'],
            $_POST['bloodGroup'], $_POST['time'], $comment,$_POST['arm'],$_POST['visual'],$_POST['x']);

        $_SESSION['operation']=$result;
        header("location:nurse.php");

    }



    else {


        ?>

<!-- 
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <meta charset="UTF-8">
            <title>Clinic</title>
        </head>


    <body>


        <div class="w3-bar w3-light-grey">
            <a href="nurse.php" class="w3-bar-item w3-button">Nurse Home</a>     <!-- nurse home button --
            <div class="w3-dropdown-hover">
                <!-- user name --
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
            background: #ffffffa6;
            padding: 17px;
            border-radius: 10px;
            box-shadow: 0 0 20px 1px #000;
         
        }
        .left{
            margin-top: -32px;
        }
        .results{
            margin-top: -19px;
            margin-bottom: 10px;
            margin-left: 72px;
            list-style: none;
            font-weight: bold;
            color: #5a5858;
        }
        .stopwatch{
            margin-top: 8px;
            color: #5a5858;
        }
        
    </style>
</head>

<body>
    
    <header class="container" >
        <nav class="navbar navbar-default ">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="Home.php" class="navbar-brand" ><img src="../resource/images/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav links">
                    <li >
                         <a href="nurse.php" >Nurse Home</a>     <!-- Nurse Homebutton -->
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

        <img src="../resource/images/4.jpg" alt="" class="bg-image" style="margin-top:7px">
        <div class="blure-body" style="background: linear-gradient(to left, #ffffff00 ,#f85f65b8);"></div>


        <?php
        
        if($_GET['do']=='insert'){
        //is already inserted
        include '../model/NurseModel.php';
        $check = NurseModel::search($_GET['nid']);
        if ($check) {

            echo '<h3 class="col-md-10 col-md-offset-1" style="margin-top: 75px;  background:#ffffffeb; text-align:center">Blood is already inserted</h3>';

            exit();

        }}
   //edit
        else {
            include '../model/NurseModel.php';
            $edits = NurseModel::search($_GET['nid']);
            if ($edits==Null) {
                echo '<h3 class="col-md-10 col-md-offset-1" style="margin-top: 75px;  background:#ffffffeb; text-align:center">You must inter blood first</h3>';

                exit();

            }
            $edit=$edits[0];



            }

            ?>

            <h4 class="col-md-10 col-md-offset-1" style="margin-top: 15px;">Blood sample of <?php echo $_GET['nid']; ?></h4>
            <?php $x=null;echo $x; ?>
            <!--form of blood information-->
            <div class="col-md-10 col-md-offset-1">
            <form action="" method="post" class="">
<!--      stop watch          -->
                <dav class="form-group col-xs-12 " style="margin-bottom: 25px;">
                        
                        <a  class="btn btn-default" onClick="stopwatch.start();">Start <span class="glyphicon glyphicon-play"></span></a>
                        <a  class="btn btn-default" onClick="stopwatch.stop();">Stop <span class="glyphicon glyphicon-pause"></span></a>
                        <a  class="btn btn-default" onClick="stopwatch.lap();">Get Time <span class="glyphicon glyphicon-time"></span></a>
                        
                        <div class="stopwatch ">  </div>
                            Time of process:<ul class="results" ></ul>
                            <input id="getwatch" type="hidden" name="x" value="">
                       
                   
                </dav>
                
                
                

                <div class="form-group col-xs-6 left" style="margin-top:0">
                    <label >Sealed by ID</label>
                    <input required class="form-control" type="number" placeholder="Blood ID" name="ID_Blood" <?php if(isset($edit)){ echo "value='".$edit['ID']."'" ;}?>><br>
                </div>

                <div class="form-group col-xs-6 " >
                    
                    <div class="radio">
                        <label> 
                            <input  type="radio" name="NID" required <?php if(isset($edit)){ echo"checked" ;}?>>
                            Checked ID 
                        </label>
                        </div>
                </div>

                <div class="form-group col-xs-6 ">
                    <label > Visual inspection of bag  </label>
                    <div class="radio">
                        <label>
                           <input required type="radio" name="visual" value="Yes" <?php if(isset($edit )&&$edit['visual']=='Yes'){ echo "checked" ;}?>>Yes
                        </label>
                     </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="visual" value="No"  <?php if(isset($edit )&&$edit['visual']=='No'){ echo "checked" ;}?>>No
                        </label>
                     </div>
                   
                </div>
               

                <div class="form-group col-xs-6 left" style="margin-top: -53px;">
                    <label >Time of collections</label>
                    <input  required class="form-control" placeholder="Time of collections" type="time" name="time"<?php if(isset($edit)){ echo "value='".$edit['timeCollection']."'" ;}?>><br>
                </div>

                <div class="form-group col-xs-6 left">
                    <label class="checkbox">Arm Inspection </label>
                    <div class="radio">
                        <label>
                            <input required type="radio" name="arm" value="Left" <?php if(isset($edit )&&$edit['arm']=='Left'){ echo "checked" ;}?>>Left
                        </label>
                     </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="arm" value="Right" <?php if(isset($edit )&&$edit['arm']=='Right'){ echo "checked" ;}?>>Right
                        </label>
                     </div>
                   
                </div>


                <div class="form-group col-xs-6 left" style="margin-top: -38px;">
                    <label >Bag Weight</label>
                     <input required class="form-control"  type="number" placeholder="Bag Weight" name="bagWeight"<?php if(isset($edit)){ echo "value='".$edit['bagWeight']."'" ;}?>>
                </div>
               

                 <?php if (isset($edit)){$comments= explode('-', $edit['comment']);
                 } ?>

                
                
                <div class="form-group col-xs-6 ">
                    <label >Comments </label>
                    <div class="checkbox">
                        <label>
                            <input   type="checkbox" name="comments_list[]" value="Slow bleed"
                                <?php if(isset($edit)){foreach ($comments as $comment){if($comment=="Slow bleed"){echo"checked";}}} ?>
                            > Slow bleed
                        </label>
                    </div>

                    <div class="checkbox">
                        <label> 
                            <input type="checkbox" name="comments_list[]" value=" Aspirin"
                                <?php if(isset($edit)){foreach ($comments as $comment){if($comment==" Aspirin"){echo"checked";}}} ?>
                            > Aspirin
                        </label>
                    </div>

                    <div class="checkbox">
                        <label> 
                            <input type="checkbox" name="comments_list[]" value="Relative"
                                <?php if(isset($edit)){ foreach ($comments as $comment){if($comment=="Relative"){echo"checked";}}} ?>
                            > Relative
                        </label>
                    </div>

                    <div class="checkbox">
                        <label> 
                            <input type="checkbox" name="comments_list[]" value="Other"
                                <?php if(isset($edit)){ foreach ($comments as $comment){if($comment=="Other"){echo"checked";}}} ?>
                            > Other
                        </label>
                    </div>
                </div>

                <div class="form-group col-xs-6 left" style="margin-top: -117px;">
                    <label class="checkbox">Confirmed Blood Group</label>
                    <select class="form-control" required name="bloodGroup">
                        <?php if(isset($edit)) {echo '<option value="'.$edit['bloodGroup'].'">'.$edit['bloodGroup'].'</option>';}?>
                            <option value="A−"> A−</option>
                            <option value="A+">A+</option>
                            <option value="B−">B−</option>
                            <option value="B+">B+</option>
                            <option value="AB−">AB−</option>
                            <option value="AB+">AB+</option>
                            <option value="O−">O−</option>
                            <option value="O+">O+</option>

                        </select>
                </div>


                <input  type="hidden" name="NID" value="<?php echo $_GET['nid']; ?>">
                <div class="col-md-12" style="margin-top: -10px;">
                    <input class="btn btn-default col-md-4 col-md-offset-4" type="submit" value="Save" <?php if(isset($edit)){ echo "name='edit'" ;}
                    else{echo "name='insert'" ;}?>>
                </div>

            </form>
            </div>

        <script>




            class Stopwatch {
                constructor(display, results) {
                    this.running = false;
                    this.display = display;
                    this.results = results;
                    this.laps = [];
                    this.reset();
                    this.print(this.times);
                }

                reset() {
                    this.times = [ 0, 0, 0 ];
                }

                start() {
                    if (!this.time) this.time = performance.now();
                    if (!this.running) {
                        this.running = true;
                        requestAnimationFrame(this.step.bind(this));
                    }
                }

                lap() {
                    let times = this.times;
                    let li = document.createElement('li');

                    li.innerText = this.format(times);
                    
                    this.results.innerHTML = '';
                    this.results.appendChild(li);

                    document.querySelector('#getwatch').setAttribute("value", this.format(times));
                }

                stop() {
                    this.running = false;
                    this.time = null;
                }

                restart() {
                    if (!this.time) this.time = performance.now();
                    if (!this.running) {
                        this.running = true;
                        requestAnimationFrame(this.step.bind(this));
                    }
                    this.reset();
                }

                clear() {
                    clearChildren(this.results);
                }

                step(timestamp) {
                    if (!this.running) return;
                    this.calculate(timestamp);
                    this.time = timestamp;
                    this.print();
                    requestAnimationFrame(this.step.bind(this));
                }

                calculate(timestamp) {
                    var diff = timestamp - this.time;
                    // Hundredths of a second are 100 ms
                    this.times[2] += diff / 10;
                    // Seconds are 100 hundredths of a second
                    if (this.times[2] >= 100) {
                        this.times[1] += 1;
                        this.times[2] -= 100;
                    }
                    // Minutes are 60 seconds
                    if (this.times[1] >= 60) {
                        this.times[0] += 1;
                        this.times[1] -= 60;
                    }
                }

                print() {
                    this.display.innerText = this.format(this.times);
                }

                format(times) {
                    return `${pad0(times[0], 2)}:${pad0(times[1], 2)}:${pad0(Math.floor(times[2]), 2)}`;
                }
            }

            function pad0(value, count) {
                var result = value.toString();
                for (; result.length < count; --count)
                    result = '0' + result;
                  
                return  result;
            }

            function clearChildren(node) {
                while (node.lastChild)
                    node.removeChild(node.lastChild);
            }

            let stopwatch = new Stopwatch(
                document.querySelector('.stopwatch'),
                document.querySelector('.results'));


        </script>



            <?php


        }

        }





//no permission to access page
else{

    header('location:Login.php');

}
