<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 3/29/2018
 * Time: 10:13 PM
 */

class hospital
{

    public function insert($employee_id, $order)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO  hospitall(empployee_id, bloodOrder)
                               VALUES (?,?)");
            $stmt->execute(array($employee_id, $order));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }
    }




    ///search id of impolyee
    public function searchID($name){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from  empolyees  where  userName=? ");
            $stmt->execute(array($name));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();
            if ($count > 0) {
                return $row[0];
            }
            else
            {
                return null;
            }
        }

        catch(PDOException $e)
        {
            return $e->getMessage();

        }



    }


    public function search(){



//search order
        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from   hospitall");
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
            return $e->getMessage();

        }



    }





}