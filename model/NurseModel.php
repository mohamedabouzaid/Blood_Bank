<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/9/2018
 * Time: 1:17 AM
 */

class NurseModel
{
//insert
    public function insert($id,$donar_id,$wieght,$bloodGroup,$time,$comment){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO bloodsample (ID,donar_nid,timeCollection,bagWeight,bloodGroup,comment)
                               VALUES (?,?,?,?,?,?)");
            $stmt->execute(array($id,$donar_id,$time,$wieght,$bloodGroup,$comment));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }


    }

//search
    public function search($NID){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT donar_NID from bloodsample where  donar_NID=? ");
            $stmt->execute(array($NID));
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