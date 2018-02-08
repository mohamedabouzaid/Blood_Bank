<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/1/2018
 * Time: 1:00 AM
 */

class User
{

   public function Login($userName,$Password){
        include'vars.php';
       //check the username and password from database
       $stmt=$con->prepare("SELECT  
                                       username,password,job
                                        from employees WHERE username=? AND password=?
                                        LIMIT 1");
       $stmt->execute(array($userName,$Password));
       $row=$stmt->fetch();
       $count=$stmt->rowCount();

       if($count > 0)
       {
          return $row['job'];
       }
       else
       {
           return null;

       }





   }
}