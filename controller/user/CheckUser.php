<?php
/*
 * check the job of user
 * */


 if(isset($_SESSION['userName']))
 {

     if ($_SESSION['job']=='receptionist'){

         header('location:Receptionist.php');
    }
     elseif($_SESSION['job']=='labTechnician'){

         header('location:labTechnician.php');

     }
     elseif($_SESSION['job']=='physician'){

         header('location:physician.php');

     }
     elseif($_SESSION['job']=='nurse'){

         header('location:nurse.php');

     }
     elseif($_SESSION['job']=='NAT'){

         header('location:NAT.php');

     }
     elseif($_SESSION['job']=='bacterial'){

         header('location:bacterial.php');

     }
     elseif($_SESSION['job']=='malaria'){

         header('location:malaria.php');

     }
     elseif($_SESSION['job']=='serology'){

         header('location:serology.php');

     }



 }