<?php


session_start();

if(isset($_SESSION['userName']) && $_SESSION['job']=='Nurse' || $_SESSION['job']=='admin') {


    if (isset($_POST['insert'])) {
//the comment


        if (!empty($_POST['comments_list'])) {
            $comment = implode('-', $_POST['comments_list']);
        } else {
            $comment = "other";
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
            <a href="nurse.php" class="w3-bar-item w3-button">Nurse Home</a>     <!-- nurse home button -->
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
        
        if($_GET['do']=='insert'){
        //is already inserted
        include '../model/NurseModel.php';
        $check = NurseModel::search($_GET['nid']);
        if ($check) {
        echo "Blood is already inserted";
           die();

        }}
   //edit
        else {
            include '../model/NurseModel.php';
            $edits = NurseModel::search($_GET['nid']);
            if ($edits==Null) {
                echo "You should enter blood first ";
                die();

            }
            $edit=$edits[0];



            }

            ?>

            <h3>Blood sample of <?php echo $_GET['nid']; ?></h3>
            <?php $x=null;echo $x; ?>
            <!--form of blood information-->
            <form action="" method="post">
<!--      stop watch          -->
                <nav class="controls">
                    <a href="#" class="button" onClick="stopwatch.start();">Start</a>
                    <a href="#" class="button" onClick="stopwatch.lap();">Get Time</a>
                    <a href="#" class="button" onClick="stopwatch.stop();">Stop</a>
                    <div class="stopwatch"></div>

                </nav>
                Time of process:<ul class="results"></ul>
                <input id="getwatch" type="hidden" name="x" value="">
                <input type="radio" name="NID" required <?php if(isset($edit)){ echo"checked" ;}?>>Checked ID<br>
                Sealed by ID<input type="number" name="ID_Blood" <?php if(isset($edit)){ echo "value='".$edit['ID']."'" ;}?>><br>
                Bag Weight <input type="number" name="bagWeight"<?php if(isset($edit)){ echo "value='".$edit['bagWeight']."'" ;}?>><br>
                Time of collections<input type="time" name="time"<?php if(isset($edit)){ echo "value='".$edit['timeCollection']."'" ;}?>><br>
                Arm Inspection<input type="radio" name="arm" value="Left" <?php if(isset($edit )&&$edit['arm']=='Left'){ echo "checked" ;}?>>Left
                                     <input type="radio" name="arm" value="Right" <?php if(isset($edit )&&$edit['arm']=='Right'){ echo "checked" ;}?>>Right<br>

                Visual inspection of bag<input type="radio" name="visual" value="Yes" <?php if(isset($edit )&&$edit['visual']=='Yes'){ echo "checked" ;}?>>Yes
                                         <input type="radio" name="visual" value="No"  <?php if(isset($edit )&&$edit['visual']=='No'){ echo "checked" ;}?>>No<br>

                Confirmed Blood Group

             <select required name="bloodGroup">
                 <?php if(isset($edit)) {echo '<option value="'.$edit['bloodGroup'].'">'.$edit['bloodGroup'].'</option>';}?>
                    <option value="A−"> A−</option>
                    <option value="A+">A+</option>
                    <option value="B−">B−</option>
                    <option value="B+">B+</option>
                    <option value="AB−">AB−</option>
                    <option value="AB+">AB+</option>
                    <option value="O−">O−</option>
                    <option value="O+">O+</option>

                </select><br>

                 <?php if (isset($edit)){$comments= explode('-', $edit['comment']);
                 } ?>
                <h5>Comments</h5>
                <input type="checkbox" name="comments_list[]" value="Slow bleed"
                    <?php if(isset($edit)){foreach ($comments as $comment){if($comment=="Slow bleed"){echo"checked";}}} ?>
                > Slow bleed<br>



                <input type="checkbox" name="comments_list[]" value=" Aspirin"
                    <?php if(isset($edit)){foreach ($comments as $comment){if($comment==" Aspirin"){echo"checked";}}} ?>
                > Aspirin<br>

                <input type="checkbox" name="comments_list[]" value="Relative"
                    <?php if(isset($edit)){ foreach ($comments as $comment){if($comment=="Relative"){echo"checked";}}} ?>
                > Relative<br>

                <input type="checkbox" name="comments_list[]" value="Other"
                    <?php if(isset($edit)){ foreach ($comments as $comment){if($comment=="Other"){echo"checked";}}} ?>
                > Other<br>
                <input type="hidden" name="NID" value="<?php echo $_GET['nid']; ?>">
                <input type="submit" value="Save" <?php if(isset($edit)){ echo "name='edit'" ;}
                else{echo "name='insert'" ;}?>>

            </form>


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
