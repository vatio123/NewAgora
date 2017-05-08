<?php

/** TopicADOClass.php
 * Entity TopicADOClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDagora.php";
require_once "../model/Topic.class.php";

class TopicADO implements EntityInterface {
/*private $topicname;
    private $maintopic;*/
    //----------Data base Values---------------------------------------
    private static $tableTopics = "topics";
    private static $colTopicsTopicname = "topicname";
    private static $colTopicsMaintopic = "maintopic";
   

    //topicname-maintopic-topicname-input-date
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
            $entity = TopicADO::fromResultSet($row);
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
        $topicname = $res[TopicADO::$colTopicsTopicname];
        $maintopic = $res[TopicADO::$colTopicsMaintopic];
    
        //Object construction
        $entity = new Topic();
        $entity->setIdtopic($topicname);
        $entity->setmaintopic($maintopic);
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
            error_log("Error executing query in TopicADO: " . $e->getMessage() . " ");
        }
        //Run the query
        $res = $conn->execution($cons, $vector);
        return TopicADO::fromResultSetList($res);
    }

    /**
     * findByTopicname()
     * It runs a query and returns an object array
     * @param topicname
     * @return object with the query results
     */
    public static function findByPK($object) {
        $cons = "select * from `" . TopicADO::$tableTopics . "` where " . TopicADO::$colTopicsTopicname . " = ?";
        $arrayValues = [$object->getTopicname()];
        return TopicADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByTopicname()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByTopicname($object) {
        $cons = "select * from `" . TopicADO::$tableTopics . "` where " . TopicADO::$colTopicsTopicname . " = ?";
        $arrayValues = [$object->getTopicname()];
        return TopicADO::findByQuery($cons, $arrayValues);
    }
    
    /**
     * findBymaintopic()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findBymaintopic($object) {
        $cons = "select * from `" . AnswerADO::$tableTopics . "` where " . AnswerADO::$colTopicsMaintopic . " = ?";
        $arrayValues = [$object->getMaintopic()];
        return AnswerADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findAll()
     * It runs a query and returns an object array
     * @param none
     * @return object with the query results
     */
    public static function findAll() {
        $cons = "select * from `" . TopicADO::$tableTopics . "`";
        $arrayValues = [];
        return TopicADO::findByQuery($cons, $arrayValues);
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
        $cons = "insert into " . TopicADO::$tableTopics . " (`topicname`, `maintopic`) values (?, ?)";
        $arrayValues = [ $object->getTopicname(), $object->getMaintopic()];
        $topicname = $conn->executionInsert($cons, $arrayValues);
        $object->setTopicname($topicname);
        return $object->getTopicname();
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
        $cons = "delete from `" . TopicADO::$tableTopics . "` where " . TopicADO::$colTopicsTopicname . " = ?";
        $arrayValues = [$object->getTopicname()];
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
        $cons = "update `" . TopicADO::$tableTopics . "` set " .TopicADO::$colTopicsMaintopic . 
                " =? where " . TopicADO::$colTopicsTopicname . " = ?";
        $arrayValues = [$object->getMaintopic(), $object->getTopicname() ];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "TopicADO[topicname=" . $this->topicname . "][topicname=" . $this->topicname . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
