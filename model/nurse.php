<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/7/2018
 * Time: 11:21 PM
 */

class nurse
{



    public function insert($id,$donar_id,$wieght,$bloodGroup,$time){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO bloodsample (ID,donar_nid,timeCollection,bagWeight,bloodGroup)
                               VALUES (?,?,?,?,?)");
            $stmt->execute(array($id,$donar_id,$time,$wieght,$bloodGroup));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            return "sorry,try again ";

        }



    }
}