<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 3/1/2018
 * Time: 4:41 PM
 */

class director
{





    //insert final approval
    public function update($final,$unit)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update component set final=? where unitNo=?");
            $stmt->execute(array($final, $unit));

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
            $stmt = $con->prepare("SELECT *  from component where  unitNo=? AND approval=?");
            $stmt->execute(array($unit,0));
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
    public function All($final){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT *  from component where  final=? ");
            $stmt->execute(array($final));
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