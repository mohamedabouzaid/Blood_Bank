<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 1/25/2018
 * Time: 1:43 AM
 */
session_start();
session_unset();
session_destroy();
header('location:../../view/Login.php');
exit();