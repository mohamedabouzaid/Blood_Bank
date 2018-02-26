<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/26/2018
 * Time: 10:06 PM
 */

class serology
{
//insert serology RESULT
    public function insert($unitNO,$HIV,$HIBsAg,$antiHCV,$syphilis,$antiHBc,$HTLV)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO  serology (component_unitNo,HIV,HBsAg,antiHCV,
                                   syphilis,antiHBc,HTLV)
                               VALUES (?,?,?,?,?,?,?)");
            $stmt->execute(array($unitNO,$HIV,$HIBsAg,$antiHCV,$syphilis,$antiHBc,$HTLV));

            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }

    }


    //update

    //insert Bacterial RESULT
    public function update($unitNO,$HIV,$HIBsAg,$antiHCV,$syphilis,$antiHBc,$HTLV){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update serology set HIV=?,HBsAg=?,antiHCV=?,
                                     syphilis=?,antiHBc=?,HTLV=?
                                          WHERE component_unitNo=?      ");
            $stmt->execute(array($HIV,$HIBsAg,$antiHCV,$syphilis,$antiHBc,$HTLV,$unitNO));
            return "update record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }


    }



    public function search($unit){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from serology where  component_unitNo=? ");
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