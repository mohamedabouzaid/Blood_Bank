<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/28/2018
 * Time: 12:29 AM
 */

class supervisor
{

    //insert approval
    public function update($approval,$unit)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update component set approval=? where unitNo=?");
            $stmt->execute(array($approval, $unit));

           return "Insert record  successfully";

        } catch (PDOException $e) {
            return "sorry,try again ";
            //echo  $e->getMessage();

        }


    }


    public function search($unit){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT approval  from component where  unitNo=? ");
            $stmt->execute(array($unit));
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


    //get all accept or reject
    public function All($approval){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT *  from component where  approval=? ");
            $stmt->execute(array($approval));
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






}