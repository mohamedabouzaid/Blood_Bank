<?php
//login
session_start();                        //start session
include'../../model/User.php';         //model User


if ($_SERVER['REQUEST_METHOD']=='POST') {

    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $password = $_POST['password'];


    //validation
    if(strlen($username)<3){

        $_SESSION['error']="User name at least 3 characters";
        header('location:../../view/Login.php');
        exit();
     }

    if(strlen($password)<6){

    $_SESSION['error']="Password at least 6 characters and numbers";
    header('location:../../view/Login.php');
     exit();
   }





    new User();                                              //object of user
    $job=User::Login($username,$password);

   if($job!=null)
    {
        $_SESSION['userName']=$username;//session of username
        $_SESSION['job']=$job;//session of job

        if ($_SESSION['job']=='Receptionist'){       //receptionist

            header('location:../../view/Receptionist.php');
        }
        elseif($_SESSION['job']=='lab_Technician'){

            header('location:../../view/labTechnician.php');

        }
        elseif($_SESSION['job']=='Physician'){

            header('location:../../view/physician.php');

        }
        elseif($_SESSION['job']=='Nurse'){

            header('location:../../view/nurse.php');

        }
        elseif($_SESSION['job']=='Nurse_2'){

            header('location:../../view/bloodComponent.php');

        }

        elseif($_SESSION['job']=='lab'){

            header('location:../../view/lab.php');

        }



        elseif($_SESSION['job']=='medical_supervisor'){

            header('location:../../view/medicalSupervisor.php');

        }
        elseif($_SESSION['job']=='medical_director'){

            header('location:../../view/director.php');

        }

        elseif($_SESSION['job']=='admin'){

            header('location:../../view/admin.php');

        }
        elseif($_SESSION['job']=='Empolyee of hospital'){

            header('location:../../view/hospital.php');

        }


    }
    //invalid username and password
    else{
        $error='Invalid username or password';
        $_SESSION['error']=$error;
        header('location:../../view/Login.php');
    }


}

else{
    header('location:../../view/Login.php');
}