<?php
/**
 * Connection of DB
 */
     $dsn='mysql:host=localhost;dbname=blood';           //server name & DB name
     $user = "root";                                        //user
     $pass = "";                                           //password
     $option=array(
              PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',      //to Arabic Letter

      );

    // connection to database
    try{
         $con=new PDO($dsn,$user,$pass,$option);
         $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo'you are connect';

     }
     catch (PDOException $e){
         //echo 'faild to connect'.$e->getMessage();
         die();
     }