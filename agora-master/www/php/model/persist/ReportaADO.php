<?php

/** ReportaADOClass.php
 * Entity ReportaADOClass
 * author  Vath
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDagora.php";
require_once "../model/Reporta.class.php";
require_once "../model/Answer.class.php";

class ReportaADO implements EntityInterface {
/*private $idreport;
    private $nickname;
    private $idanswer;
    private $reporttext;
    private $date;*/
    //----------Data base Values---------------------------------------
    private static $tableReportas = "reporta";
    private static $colReportasIdreporta = "idreporta";
    private static $colReportasNickname = "nickname";
    private static $colReportasIdanswer = "idanswer";
    private static $reporttextcolReportasReporttext = "reporttext";
    private static $colReportasDate = "date";

    //idreport-nickname-idanswer-report-date
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
            $entity = ReportaADO::fromResultSet($row);
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
        $id = $res[ReportaADO::$colReportasIdreporta];
        $nickname = $res[ReportaADO::$colReportasNickname];
        $idanswer = $res[ReportaADO::$colReportasIdanswer];
        $reporttext = $res[ReportaADO::$reporttextcolReportasReporttext];
        $date = $res[ReportaADO::$colReportasDate];

        //Object construction
        $entity = new Reporta();
        $entity->setIdreporta($id);
        $entity->setNickname($nickname);
        $entity->setIdanswer($idanswer);
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
            error_log("Error executing query in ReportaADO: " . $e->getMessage() . " ");
        }
        //Run the query
        $res = $conn->execution($cons, $vector);
        return ReportaADO::fromResultSetList($res);
    }

    /**
     * findByIdreporta()
     * It runs a query and returns an object array
     * @param id
     * @return object with the query results
     */
    public static function findByPK($object) {
        $cons = "select * from `" . ReportaADO::$tableReportas . "` where " . ReportaADO::$colReportasIdreporta . " = ?";
        $arrayValues = [$object->getIdreporta()];
        return ReportaADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdreporta()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdreporta($object) {
        $cons = "select * from `" . ReportaADO::$tableReportas . "` where " . ReportaADO::$colReportasIdreporta . " = ?";
        $arrayValues = [$object->getIdreporta()];
        return ReportaADO::findByQuery($cons, $arrayValues);
    }
    
    /**
     * findByNickname()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByNickname($object) {
        $cons = "select * from `" . AnswerADO::$tableReportas . "` where " . AnswerADO::$colReportasNickname . " = ?";
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
        $cons = "select * from `" . ReportaADO::$tableReportas . "`";
        $arrayValues = [];
        return ReportaADO::findByQuery($cons, $arrayValues);
    }
    
    /**
     * findByIdreporta()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByAnswerId($object) {
        $cons = "select * from `" . ReportaADO::$tableReportas . "` where " . ReportaADO::$colReportasIdanswer . " = ?";
        $arrayValues = [$object->getIdanswer()];
        return ReportaADO::findByQuery($cons, $arrayValues);
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
        $cons = "insert into " . ReportaADO::$tableReportas . " (`nickname`,`idanswer`,`reporttext`,`date`) values (?, ?, ?, ?)";
        $arrayValues = [ $object->getNickname(), $object->getIdanswer(), $object->getReporttext(), new Date()];
        $id = $conn->executionInsert($cons, $arrayValues);
        $object->setIdreporta($id);
        return $object->getIdreporta();
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
        $cons = "delete from `" . ReportaADO::$tableReportas . "` where " . ReportaADO::$colReportasIdreporta . " = ?";
        $arrayValues = [$object->getIdreporta()];
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
        $cons = "update `" . ReportaADO::$tableReportas . "` set " . ReportaADO::$colReportasNickname . " = ?," .
                ReportaADO::$colReportasIdanswer . " = ?, " . ReportaADO::$reporttextcolReportasReporttext . " = ?". ReportaADO::$colReportasDate . " =? where " . ReportaADO::$colReportasIdreporta . " = ?";
        $arrayValues = [$object->getIdreporta(), $object->getNickname(), $object->getIdanswer(), $object->getReporttext(), $object->getDate(), $object->getIdreporta()];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "ReportaADO[id=" . $this->id . "][id=" . $this->id . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
