<?php


class NurseModel
{
//insert blood
    public function insert($id,$donar_id,$wieght,$bloodGroup,$time,$comment
        ,$performed,$approved,$signature){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO bloodsample (ID,donar_nid,timeCollection,
                                    bagWeight,bloodGroup,comment,performed,approved,signature)
                               VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->execute(array($id,$donar_id,$time,$wieght,
                $bloodGroup,$comment,$performed,$approved,$signature));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }


    }
    //update
    public function update ($id,$donar_id,$wieght,$bloodGroup,$time,$comment
        ,$performed,$approved,$signature)
    {
        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("update bloodsample set 
                                 ID=?,timeCollection=?,
                                    bagWeight=?,bloodGroup=?,comment=?,performed=?,approved=?,signature=?
                                 where donar_nid=?");
            $stmt->execute(array($id,$time,$wieght,
                $bloodGroup,$comment,$performed,$approved,$signature,$donar_id));
            //record updated
            return "New record update successfully";

        } catch (PDOException $e) {
            //record not updated
            return $e->getMessage();


        }


    }



//search blood
    public function search($NID){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from bloodsample where  donar_NID=? ");
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


    //get ll in blood
    public function getALLBlood(){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from bloodsample ");
            $stmt->execute();
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




    public function insertComponent($donar_id,$centerNo,$unitNo,$timeCollected,$timeSeparated,$prbc,$pc,$ffp,
    $cryo,$Fwb,$Fprbc,$Fpc,$bag){

        include 'vars.php';
        try {
            //sql statment
            $stmt = $con->prepare("INSERT INTO component (donar_nid,centerNo,unitNo,timeCollected,timeSeparated,
                                      prbc,pc,ffp,cryo,Fwb,Fprbc,Fpc,bagType)
                               VALUES (?,?,? ,?,?,?,?,? ,?,?,?,?,?)");
            $stmt->execute(array($donar_id,$centerNo,$unitNo,$timeCollected,$timeSeparated,$prbc,$pc,$ffp,
                $cryo,$Fwb,$Fprbc,$Fpc,$bag));
            return "Insert record  successfully";

        } catch (PDOException $e) {
            //return "sorry,try again ";
            return $e->getMessage();

        }


    }

//in component
    public function searchComponent($NID){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT donar_NID from component where  donar_NID=? ");
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

//get all user for lab
    public function getALLUnit(){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from component ");
            $stmt->execute();
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


// search for lab
    public function searchUnit($unidNo){




        include 'vars.php';
        try {

            //SQL
            $stmt = $con->prepare("SELECT * from component where  unitNo=?");
            $stmt->execute(array($unidNo));
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