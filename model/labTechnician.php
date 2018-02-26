<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/5/2018
 * Time: 3:30 PM
 */

class labTechnician
{
    public function getALL(){


        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("SELECT donar_NID from questionnaire");
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
            $stmt = $con->prepare("SELECT donar_NID from questionnaire where donar_NID=?  LIMIT 1");
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


    public function insert($donar_NID,$weight,$height,$temp,$blood,$HB,$pluse,$bp)
    {
        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO clinic (donar_NID,weight,height,temp,bloodGroup,hp,pluse,bp)
                               VALUES (?,?,?,?,?,?,?,?)");
            $stmt->execute(array($donar_NID,$weight,$height,$temp,$blood,$HB,$pluse,$bp));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            return "sorry,try again";


        }
    }

    public function update($donar_NID,$weight,$height,$temp,$blood,$HB,$pluse,$bp)
    {
        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update clinic set weight=?,height=?,temp=?,bloodGroup=?
              ,hp=?,pluse=?,bp=? WHERE  donar_NID=? ");
            $stmt->execute(array($weight,$height,$temp,$blood,$HB,$pluse,$bp,$donar_NID));
            return "Insert record  successfully";


        } catch (PDOException $e) {
            return "sorry,try again";

        }
    }

}