<?php

session_start();
if(isset($_SESSION['userName']) && $_SESSION['job']=='admin') {
include '../model/User.php';
if(isset($_POST['save'])){

        $result=User::insert($_POST['NID'],$_POST['userName'],$_POST['password'],
            $_POST['job']);
        $_SESSION['operation']=$result;
        header('location:adminManageEmployee.php');
}



?>







    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="UTF-8">
        <title>Admin</title>
    </head>


<body>


<div class="w3-bar w3-light-grey">
    <a href="adminManageEmployee.php" class="w3-bar-item w3-button">Admin Manage Employees</a>     <!-- Admin Department home button -->

    <div class="w3-dropdown-hover">
        <!-- user name -->
        <button class="w3-button"><?php echo $_SESSION['userName'] ?></button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="../controller/user/Logoutcontroller.php" class="w3-bar-item w3-button"> logout</a>   <!-- logout button -->
        </div>
    </div>


</div>




    <form action="" method="post">
        رقم السجل المدنى<input type="number" name="NID"><br>
        اسم الموظف<input type="text" name="userName"><br>
        كلمه السر<input type="password" name="password" ><br>
       الوظيفه <select required name="job">
                    <option value="Receptionist">Receptionist</option>
                    <option value="lab_Technician">lab_Technician</option>
                    <option value="Physician">Physician</option>
                    <option value="Nurse">Nurse</option>
                    <option value="Bacterial">Bacterial</option>
                    <option value="Immuno">Immuno</option>
                     <option value="malaria">malaria</option>
                     <option value="NAT">NAT</option>
                     <option value="serology">serology</option>
                    <option value="medical_supervisor">medical_supervisor</option>
                    <option value="medical_director">medical_director</option>
             </select><br><br>
        <input type="submit" value="save" name="save">
    </form>




<?php


}
else {

    header('location:Login.php');

}