<?php

/** ReportqADOClass.php
 * Entity ReportqADOClass
 * author  Vath
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDagora.php";
require_once "../model/Reportq.class.php";

class ReportqADO implements EntityInterface {
/*private $idreport;
    private $nickname;
    private $idquestion;
    private $reporttext;
    private $date;*/
    //----------Data base Values---------------------------------------
    private static $tableReportqs = "reportq";
    private static $colReportqsIdreport = "idreportq";
    private static $colReportqsNickname = "nickname";
    private static $colReportqsIdquestion = "idquestion";
    private static $reporttextcolReportqsReporttext = "reporttext";
    private static $colReportqsDate = "date";

    //idreport-nickname-idquestion-report-date
    //---Databese management section-----------------------
    /**
     * fromResultSetList()
     * this function runs a query and returns an array with all the result transformed into an object
     * @param res query to execute
     * @return objects collection
     */
    private static function fromResultSetList($res) {
        $entityList = array();
        $i = 0;
        foreach ($res as $row) {
            //We get all the values an add into the array
            $entity = ReportqADO::fromResultSet($row);
            $entityList[$i] = $entity;
            $i++;
        }
        return $entityList;
    }

    /**
     * fromResultSet()
     * the query result is transformed into an object
     * @param res ResultSet del qual obtenir dades
     * @return object
     */
    private static function fromResultSet($res) {
        //We get all the values form the query
        $id = $res[ReportqADO::$colReportqsIdreport];
        $nickname = $res[ReportqADO::$colReportqsNickname];
        $idquestion = $res[ReportqADO::$colReportqsIdquestion];
        $reporttext = $res[ReportqADO::$reporttextcolReportqsReporttext];
        $date = $res[ReportqADO::$colReportqsDate];

        //Object construction
        $entity = new Reportq();
        $entity->setIdreport($id);
        $entity->setNickname($nickname);
        $entity->setIdquestion($idquestion);
        $entity->setReporttext($reporttext);
        $entity->setDate($date);
        return $entity;
    }

    /**
     * findByQuery()
     * It runs a particular query and returns the result
     * @param cons query to run
     * @return objects collection
     */
    public static function findByQuery($cons, $vector) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            echo "Error executing query.";
            error_log("Error executing query in ReportqADO: " . $e->getMessage() . " ");
        }
        //Run the query
        $res = $conn->execution($cons, $vector);
        return ReportqADO::fromResultSetList($res);
    }

    /**
     * findByIdreport()
     * It runs a query and returns an object array
     * @param id
     * @return object with the query results
     */
    public static function findByPK($object) {
        $cons = "select * from `" . ReportqADO::$tableReportqs . "` where " . ReportqADO::$colReportqsIdreport . " = ?";
        $arrayValues = [$object->getIdquestion()];
        return ReportqADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdreport()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByQuestionId($object) {
        $cons = "select * from `" . ReportqADO::$tableReportqs . "` where " . ReportqADO::$colReportqsIdquestion . " = ?";
        $arrayValues = [$object->getIdquestion()];
        return ReportqADO::findByQuery($cons, $arrayValues);
    }
    
    /**
     * findByIdreport()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdquestion($object) {
        $cons = "select * from `" . ReportqADO::$tableReportqs . "` where " . ReportqADO::$colReportqsIdquestion. " = ?";
        $arrayValues = [$object->getIdquestion()];
        return ReportqADO::findByQuery($cons, $arrayValues);
    }
    
    /**
     * findByNickname()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByNickname($object) {
        $cons = "select * from `" . AnswerADO::$tableReportqs . "` where " . AnswerADO::$colReportqsNickname . " = ?";
        $arrayValues = [$object->getNickname()];
        return AnswerADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findAll()
     * It runs a query and returns an object array
     * @param none
     * @return object with the query results
     */
    public static function findAll() {
        $cons = "select * from `" . ReportqADO::$tableReportqs . "`";
        $arrayValues = [];
        return ReportqADO::findByQuery($cons, $arrayValues);
    }

    /**
     * create()
     * insert a new row into the database
     */
    public function create($object) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "insert into " . ReportqADO::$tableReportqs . " (`nickname`,`idquestion`,`reporttext`,`date`) values (?, ?, ?, ?)";
        $arrayValues = [ $object->getNickname(), $object->getIdquestion(), $object->getReporttext(), new Date()];
        $id = $conn->executionInsert($cons, $arrayValues);
        $object->setIdreport($id);
        return $object->getIdreport();
    }

    /**
     * delete()
     * it deletes a row from the database
     */
    public function delete($object) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "delete from `" . ReportqADO::$tableReportqs . "` where " . ReportqADO::$colReportqsIdreport . " = ?";
        $arrayValues = [$object->getIdreport()];
        $conn->execution($cons, $arrayValues);
    }

    /**
     * update()
     * it updates a row of the database
     */
    public function update($object) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "update `" . ReportqADO::$tableReportqs . "` set " . ReportqADO::$colReportqsNickname . " = ?," .
                ReportqADO::$colReportqsIdquestion . " = ?, " . ReportqADO::$reporttextcolReportqsReporttext . " = ?". ReportqADO::$colReportqsDate . " =? where " . ReportqADO::$colReportqsIdreport . " = ?";
        $arrayValues = [$object->getIdreport(), $object->getNickname(), $object->getIdquestion(), $object->getReporttext(), $object->getDate(), $object->getIdreport()];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "ReportqADO[id=" . $this->id . "][id=" . $this->id . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
