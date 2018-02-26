<?php
/**
 * Created by PhpStorm.
 * User: abouzaid
 * Date: 2/13/2018
 * Time: 3:15 AM
 */

class bacterial
{
//insert Bacterial RESULT
    public function insert($unitNO,$test)
    {

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO  bacteriallab(component_unitNo, test)
                               VALUES (?,?)");
            $stmt->execute(array($unitNO, $test));

            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }

    }


        //update

        //insert Bacterial RESULT
        public function update($unitNO,$test){

            include 'vars.php';
            try {
                //sql statment
                $stmt = $con->prepare("update bacteriallab set  test=?
                                          WHERE component_unitNo=?      ");
                $stmt->execute(array($test,$unitNO));
                return "update record  successfully";

            } catch (PDOException $e) {
                //return "sorry,try again ";
                return $e->getMessage();

            }


        }




//search in bactrial
    public function search($unit){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from bacteriallab where  component_unitNo=? ");
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