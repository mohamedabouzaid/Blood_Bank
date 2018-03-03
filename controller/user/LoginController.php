<?php
//login
session_start();                        //start session
include'../../model/User.php';         //model User


if ($_SERVER['REQUEST_METHOD']=='POST') {


    $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

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
        elseif($_SESSION['job']=='NAT'){

            header('location:../../view/NAT.php');

        }


        elseif($_SESSION['job']=='Bacterial'){

            header('location:../../view/bacterial.php');

        }

        elseif($_SESSION['job']=='malaria'){

            header('location:../../view/malaria.php');

        }
        elseif($_SESSION['job']=='serology'){

            header('location:../../view/serology.php');

        }
        elseif($_SESSION['job']=='Immuno') {

            header('location:../../view/immuno.php');

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