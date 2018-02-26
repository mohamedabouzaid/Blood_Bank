<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/13/2018
 * Time: 1:45 AM
 */

class NATmodel
{


    //insert NAT RESULT
    public function insert($unitNO,$HBV,$HCV,$HIV){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO  natlab(component_unitNo, HBV, HCV, HIV)
                               VALUES (?,?,?,?)");
            $stmt->execute(array($unitNO,$HBV,$HCV,$HIV));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            return "sorry,try again ";
            //return $e->getMessage();

        }


    }
    //update


    public function update($unitNO,$HBV,$HCV,$HIV){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare(" update natlab set HBV=?, HCV=?, HIV=? 
                               WHERE  component_unitNo=?");
            $stmt->execute(array($HBV,$HCV,$HIV,$unitNO));
            return "update record  successfully";

        } catch (PDOException $e) {
            return "sorry,try again ";
            //return $e->getMessage();

        }


    }



    //search in nat
    public function search($unit){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from natlab where  component_unitNo=? ");
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