<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/2/2018
 * Time: 4:09 AM
 */

class Receptionist
{



    public function insert($NID,$firstName,$secondName,$thirdName,$familyName,$phone,$age,$birthday,$city,$sex
                                 ,$profession,$nationality,$type,$patient,$sponsor,$district,$street,$healthCenter)
    {
        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO donars (NID,firstName,secondName,thirdName,familyName,phone,age,birthday,city,sex
                                 ,profession,nationality,typeDonar,patient,sponsor,district,street,healthCenter)
                               VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute(array($NID, $firstName, $secondName, $thirdName, $familyName, $phone, $age, $birthday, $city, $sex
            , $profession, $nationality, $type, $patient, $sponsor, $district, $street, $healthCenter));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            return$e->getMessage();

        }
    }

        public function search($NID){


        include 'vars.php';
            try {

                //SQL
                $stmt = $con->prepare("SELECT * from donars where NID=?  LIMIT 1");
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

    public function getALLUsers(){


        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("SELECT * from donars");
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




    public function update ($NID,$firstName,$secondName,$thirdName,$familyName,$phone,$age,$birthday,$city,$sex
        ,$profession,$nationality,$type,$patient,$sponsor,$district,$street,$healthCenter,$oldNID)
    {
        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update donars set 
                                  NID=?,firstName=?,secondName=?,thirdName=?,familyName=?,phone=?,age=?,birthday=?,city=?,sex=?
                                 ,profession=?,nationality=?,typeDonar=?,patient=?,sponsor=?,district=?,street=?,healthCenter=?
                                 where NID=?");
            $stmt->execute(array($NID, $firstName, $secondName, $thirdName, $familyName, $phone, $age, $birthday, $city, $sex
            , $profession, $nationality, $type, $patient, $sponsor, $district, $street, $healthCenter, $oldNID));
            //record updated
            return "New record update successfully";

        } catch (PDOException $e) {
            //record not updated
            return "sorry record not update try again";


        }


    }




















}