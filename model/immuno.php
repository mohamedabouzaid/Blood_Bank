<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/26/2018
 * Time: 11:28 PM
 */

class immuno
{
//insert serology RESULT
    public function insert($unitNO,$RH,$ABO,$anti,$phenotype)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO  immuno (component_unitNo,RH,ABO,anti,phenotype)
                               VALUES (?,?,?,?,?)");
            $stmt->execute(array($unitNO,$RH,$ABO,$anti,$phenotype));

            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }

    }

    //update
    public function update($unitNO,$RH,$ABO,$anti,$phenotype)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update immuno set RH=?,ABO=?,anti=?,
                                  phenotype=? WHERE component_unitNo=?");
            $stmt->execute(array($RH,$ABO,$anti,$phenotype,$unitNO));

            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }

    }


    public function search($unit){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from immuno where  component_unitNo=? ");
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



}