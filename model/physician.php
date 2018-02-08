<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 7:04 PM
 */

class physician
{

  public function userAll(){

      include 'vars.php';

          include 'vars.php';
          try {
              //sql statment
              $stmt = $con->prepare("SELECT donar_NID from clinic");
              $stmt->execute();
              $rows = $stmt->fetchall();
              $count = $stmt->rowCount();
              // user in table
              if ($count > 0) {
                  return $rows;


              }
              //no user in table
              else{
                  return null;
              }
          }
              //exception in sql statment
          catch(PDOException $e)
          {
              return null;
          }


      }



    public function search($NID){


        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from clinic where donar_NID=?  LIMIT 1");
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

  //search in questionnaire
    public function searchQ($NID){


        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT questions from questionnaire where donar_NID=?  LIMIT 1");
            $stmt->execute(array($NID));
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
            return null;

        }
    }

//insert status
 public  function status($state,$nid){



     include 'vars.php';
     try {
         //sql statment
         $stmt = $con->prepare("INSERT INTO state (status,donar_NID)
                               VALUES (?,?)");
         $stmt->execute(array($state,$nid));
         return "Insert checked successfully";

     } catch (PDOException $e) {
         return "sorry,try again ";

     }




 }

 public function getAllAccept($state){


     include 'vars.php';
     try {

         //SQL
         $stmt = $con->prepare("SELECT donar_NID from state where status=? ");
         $stmt->execute(array($state));
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
 public  function check($NID,$state){


     include 'vars.php';
     try {

         //SQL
         $stmt = $con->prepare("SELECT donar_NID from state where status=? and donar_NID=? ");
         $stmt->execute(array($state,$NID));
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