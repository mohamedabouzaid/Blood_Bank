<?php
/*
 * check the job of user
 * */


 if(isset($_SESSION['userName']))
 {

     if ($_SESSION['job']=='Receptionist'){

         header('location:Receptionist.php');
    }
     elseif($_SESSION['job']=='lab_Technician'){

         header('location:labTechnician.php');

     }

     elseif($_SESSION['job']=='Empolyee of hospital'){

         header('location:Hospital.php');

     }
     elseif($_SESSION['job']=='Physician'){

         header('location:physician.php');

     }
     elseif($_SESSION['job']=='Nurse'){

         header('location:nurse.php');

     }
     elseif($_SESSION['job']=='Nurse_2'){

         header('location:bloodComponent.php');

     }




     elseif($_SESSION['job']=='medical_supervisor'){

         header('location:medicalSupervisor.php');

     }
     elseif($_SESSION['job']=='medical_director'){

         header('location:director.php');

     }
     elseif($_SESSION['job']=='lab'){

         header('location:lab.php');

     }

     elseif($_SESSION['job']=='admin'){

         header('location:admin.php');

     }


 }