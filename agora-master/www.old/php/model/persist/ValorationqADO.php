<?php

/** ValorationqADOClass.php
 * Entity ValorationqADOClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDagora.php";
require_once "../model/Valorationq.class.php";

class ValorationqADO implements EntityInterface {

    //----------Data base Values---------------------------------------
    private static $tableValorationqs = "valorationq";
    private static $colValorationqsIdValorationq = "idvalorationq";
    private static $colValorationqsNickname = "nickname";
    private static $colValorationqsIdquestion = "idquestion";
    private static $colValorationqsValoration = "valoration";
    private static $colValorationqsDate = "date";

    //idvalorationq-nickname-idquestion-valoration-date
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
            $entity = ValorationqADO::fromResultSet($row);
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
        $id = $res[ValorationqADO::$colValorationqsIdValorationq];
        $nick = $res[ValorationqADO::$colValorationqsNickname];
        $idquestion = $res[ValorationqADO::$colValorationqsIdquestion];
        $valoration = $res[ValorationqADO::$colValorationqsValoration];
        $date = $res[ValorationqADO::$colValorationqsDate];

        //Object construction
        $entity = new Valorationq();
        $entity->setIdvalorationq($id);
        $entity->setNickname($nick);
        $entity->setIdquestion($idquestion);
        $entity->setValoration($valoration);
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
            error_log("Error executing query in ValorationqADO: " . $e->getMessage() . " ");
        }
        //Run the query
        $res = $conn->execution($cons, $vector);
        return ValorationqADO::fromResultSetList($res);
    }

    /**
     * findByIdValorationq()
     * It runs a query and returns an object array
     * @param id
     * @return object with the query results
     */
    public static function findByPK($object) {
        $cons = "select * from `" . ValorationqADO::$tableValorationqs . "` where " . ValorationqADO::$colValorationqsIdValorationq . " = ?";
        $arrayValues = [$object->getIdValorationq()];
        return ValorationqADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdValorationq()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdValorationq($object) {
        $cons = "select * from `" . ValorationqADO::$tableValorationqs . "` where " . ValorationqADO::$colValorationqsIdValorationq . " = ?";
        $arrayValues = [$object->getIdValorationq()];
        return ValorationqADO::findByQuery($cons, $arrayValues);
    }
    
    /**
     * findByNickname()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByNickname($object) {
        $cons = "select * from `" . AnswerADO::$tableValorationqs . "` where " . AnswerADO::$colValorationqsNickname . " = ?";
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
        $cons = "select * from `" . ValorationqADO::$tableValorationqs . "`";
        $arrayValues = [];
        return ValorationqADO::findByQuery($cons, $arrayValues);
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
        $cons = "insert into " . ValorationqADO::$tableValorationqs . " (`nickname`,`idquestion`,`valoration`,`date`) values (?, ?, ?, ?)";
        $arrayValues = [ $object->getNickname(), $object->getValoration(), new Date()];
        $id = $conn->executionInsert($cons, $arrayValues);
        $object->setIdvalorationq($id);
        return $object->getIdValorationq();
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
        $cons = "delete from `" . ValorationqADO::$tableValorationqs . "` where " . ValorationqADO::$colValorationqsIdValorationq . " = ?";
        $arrayValues = [$object->getIdValorationq()];
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
        $cons = "update `" . ValorationqADO::$tableValorationqs . "` set " . ValorationqADO::$colValorationqsNickname . " = ?," .
                ValorationqADO::$colValorationqsIdquestion . " = ?, " . ValorationqADO::$colValorationqsValoration . " = ?". ValorationqADO::$colValorationqsDate . " =? where " . ValorationqADO::$colValorationqsIdValorationq . " = ?";
        $arrayValues = [$object->getIdValorationq(), $object->getNickname(), $object->getIdquestion(), $object->getValoration(), $object->getDate(), $object->getIdValorationq()];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "ValorationqADO[id=" . $this->id . "][id=" . $this->id . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
