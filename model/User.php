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





//insert Bacterial RESULT
    public function insert($unitNO,$test)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO  bacteriallab(component_unitNo, test)
                               VALUES (?,?)");
            $stmt->execute(array($unitNO, $test));

            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }

    }

////////
/// //search in employee
    public function allEmployee(){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from empolyees");
            $stmt->execute();
            $row = $stmt->fetchall();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return $row;
            }
            else
            {
                return null;
            }
        }

        catch(PDOException $e)
        {
            //return null;
            return $e->getMessage();

        }



    }






    //search in bactrial
    public function search($nid){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from empolyees where  NID=? ");
            $stmt->execute(array($nid));
            $row = $stmt->fetchall();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return $row;
            }
            else
            {
                return null;
            }
        }

        catch(PDOException $e)
        {
            return null;

        }




     }



    public function delete($nid){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("delete from empolyees where  NID=? ");
            $stmt->execute(array($nid));

            return "Record deleted successfully";
        }

        catch(PDOException $e)
        {
            return "try again";

        }




    }




}