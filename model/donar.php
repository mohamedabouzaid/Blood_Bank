<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 1:54 AM
 */

class donar
{

    //insert questions
     public function insert($question,$donar_id){

         include 'vars.php';
         try {
             //sql statment
             $stmt = $con->prepare("INSERT INTO questionnaire (donar_nid,questions)
                               VALUES (?,?)");
             $stmt->execute(array($donar_id,$question));
             return "Insert record  successfully";

         } catch (PDOException $e) {
             return "sorry,try again ";

         }



     }
     //update question
    //insert questions
    public function update($question,$donar_id){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update questionnaire set questions=? WHERE  donar_nid=? ");
            $stmt->execute(array($question,$donar_id));
            return "update record  successfully";

        } catch (PDOException $e) {
            return "sorry,try again ";

        }



    }



    public function search($donar_id){

         include'vars.php';
         //check the username and password from database
         $stmt=$con->prepare("SELECT id from questionnaire  WHERE donar_nid=?  LIMIT 1");
         $stmt->execute(array($donar_id));
         $row=$stmt->fetch();
         $count=$stmt->rowCount();

         if($count > 0)
         {
             return $row['id'];
         }
         else
         {
             return null;

         }



     }






}