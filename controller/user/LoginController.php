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


    $username = filter_var($_POST['userName'],FILTER_SANITIZE_STRING);
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

    }
    else{
        $error='Invalid username or password';
        $_SESSION['error']=$error;
        header('location:../../view/Login.php');
    }


}
else{
    header('location:../../view/Login.php');
}