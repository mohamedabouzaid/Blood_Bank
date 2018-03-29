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
    public function insert($unitNo,$HBsAg,$neut,$HCVab,
                $lia,$HIVag,$lia2,$HTLV,$lia3,$syphilis,$tb,
                $HBs,$HBc,$s,$HBsText)
    {
        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO  serology (component_unitNo,HBsAg,neut,HCVab,
                lia,HIVag,lia2,HTLV,lia3,syphilis,tb,
                HBs,HBc,s,HBsText)
                               VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute(array($unitNo,$HBsAg,$neut,$HCVab,
                $lia,$HIVag,$lia2,$HTLV,$lia3,$syphilis,$tb,
                $HBs,$HBc,$s,$HBsText));

            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }

    }


    //update

    //insert Bacterial RESULT
    public function update($unitNo,$HBsAg,$neut,$HCVab,
                           $lia,$HIVag,$lia2,$HTLV,$lia3,$syphilis,$tb,
                           $HBs,$HBc,$s,$HBsText){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update serology set HBsAg=?,neut=?,HCVab=?,
                lia=?,HIVag=?,lia2=?,HTLV=?,lia3=?,syphilis=?,tb=?,
                HBs=?,HBc=?,s=?,HBsText=?
                                          WHERE component_unitNo=?      ");
            $stmt->execute(array($HBsAg,$neut,$HCVab,
                $lia,$HIVag,$lia2,$HTLV,$lia3,$syphilis,$tb,
                $HBs,$HBc,$s,$HBsText,$unitNo));
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