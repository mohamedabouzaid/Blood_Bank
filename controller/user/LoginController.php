<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/1/2018
 * Time: 12:45 AM
 */
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

        if ($_SESSION['job']=='receptionist'){       //receptionist

            header('location:../../view/Receptionist.php');
        }
        elseif($_SESSION['job']=='labTechnician'){

            header('location:../../view/labTechnician.php');

        }
        elseif($_SESSION['job']=='physician'){

            header('location:../../view/physician.php');

        }
        elseif($_SESSION['job']=='nurse'){

            header('location:../../view/nurse.php');

        }
        elseif($_SESSION['job']=='NAT'){

            header('location:../../view/NAT.php');

        }


        elseif($_SESSION['job']=='bacterial'){

            header('location:../../view/bacterial.php');

        }

        elseif($_SESSION['job']=='malaria'){

            header('location:../../view/malaria.php');

        }
        elseif($_SESSION['job']=='serology'){

            header('location:../../view/serology.php');

        }
        elseif($_SESSION['job']=='immuno') {

            header('location:../../view/immuno.php');

        }
        elseif($_SESSION['job']=='medical_supervisor'){

            header('location:../../view/medicalSupervisor.php');

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