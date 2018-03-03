<?php
//logout
session_start();
session_unset();
session_destroy();
header('location:../../view/Login.php');
exit();