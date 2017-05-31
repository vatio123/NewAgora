<?php

/** ValorationaADOClass.php
 * Entity ValorationaADOClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDagora.php";
require_once "../model/Valorationa.class.php";

class ValorationaADO implements EntityInterface {

    //----------Data base Values---------------------------------------
    private static $tableValorationas = "valorationa";
    private static $colValorationasIdValorationa = "idvalorationa";
    private static $colValorationasNickname = "nickname";
    private static $colValorationasIdanswer = "idanswer";
    private static $colValorationasValoration = "valoration";
    private static $colValorationasDate = "date";

    //idvalorationa-nickname-idanswer-valoration-date
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
            $entity = ValorationaADO::fromResultSet($row);
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
        $id = $res[ValorationaADO::$colValorationasIdValorationa];
        $nick = $res[ValorationaADO::$colValorationasNickname];
        $idanswer = $res[ValorationaADO::$colValorationasIdanswer];
        $valoration = $res[ValorationaADO::$colValorationasValoration];
        $date = $res[ValorationaADO::$colValorationasDate];

        //Object construction
        $entity = new Valorationa();
        $entity->setIdvalorationa($id);
        $entity->setNickname($nick);
        $entity->setIdanswer($idanswer);
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
            error_log("Error executing query in ValorationaADO: " . $e->getMessage() . " ");
        }
        //Run the query
        $res = $conn->execution($cons, $vector);
        return ValorationaADO::fromResultSetList($res);
    }

    /**
     * findByIdValorationa()
     * It runs a query and returns an object array
     * @param id
     * @return object with the query results
     */
    public static function findByPK($object) {
        $cons = "select * from `" . ValorationaADO::$tableValorationas . "` where " . ValorationaADO::$colValorationasIdValorationa . " = ?";
        $arrayValues = [$object->getIdValorationa()];
        return ValorationaADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdValorationa()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdValorationa($object) {
        $cons = "select * from `" . ValorationaADO::$tableValorationas . "` where " . ValorationaADO::$colValorationasIdValorationa . " = ?";
        $arrayValues = [$object->getIdValorationa()];
        return ValorationaADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByNickname()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByNickname($object) {
        $cons = "select * from `" . AnswerADO::$tableValorationas . "` where " . AnswerADO::$colValorationasNickname . " = ?";
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
        $cons = "select * from `" . ValorationaADO::$tableValorationas . "`";
        $arrayValues = [];
        return ValorationaADO::findByQuery($cons, $arrayValues);
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
        $cons = "insert into " . ValorationaADO::$tableValorationas . " (`nickname`,`idanswer`,`valoration`,`date`) values (?, ?, ?, ?)";
        $arrayValues = [ $object->getNickname(), $object->getIdanswer(), (int)$object->getValoration(), date("Y-m-d")];
        $id = $conn->executionInsert($cons, $arrayValues);
        $object->setIdvalorationa($id);
        return $object->getIdValorationa();
        /*
        $cons = "insert into " . ValorationqADO::$tableValorationqs . " (`nickname`,`idquestion`,`valoration`,`date`) values (?, ?, ?, ?)";
        $arrayValues = [ $object->getNickname(), $object->getIdquestion(), (int)$object->getValoration(),  date("Y-m-d")];
        $id = $conn->executionInsert($cons, $arrayValues);
        $object->setIdvalorationq($id);
        return $object->getIdValorationq();
        */
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
        $cons = "delete from `" . ValorationaADO::$tableValorationas . "` where " . ValorationaADO::$colValorationasIdValorationa . " = ?";
        $arrayValues = [$object->getIdValorationa()];
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
        $cons = "update `" . ValorationaADO::$tableValorationas . "` set " . ValorationaADO::$colValorationasNickname . " = ?," .
                ValorationaADO::$colValorationasIdanswer . " = ?, " . ValorationaADO::$colValorationasValoration . " = ?". ValorationaADO::$colValorationasDate . " =? where " . ValorationaADO::$colValorationasIdValorationa . " = ?";
        $arrayValues = [$object->getIdValorationa(), $object->getNickname(), $object->getIdanswer(), $object->getValoration(), $object->getDate(), $object->getIdValorationa()];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "ValorationaADO[id=" . $this->id . "][id=" . $this->id . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
