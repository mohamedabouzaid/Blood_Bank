<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/9/2018
 * Time: 1:17 AM
 */

class NurseModel
{

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



}