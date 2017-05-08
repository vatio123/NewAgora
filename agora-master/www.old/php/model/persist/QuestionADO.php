<?php

/** QuestionADOClass.php
 * Entity QuestionADOClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDagora.php";
require_once "../model/Question.class.php";

class QuestionADO implements EntityInterface {

    //----------Data base Values---------------------------------------
    private static $tableQuestions = "questions";
    private static $colQuestionsIdQuestion = "idquestion";
    private static $colQuestionsNickname = "nickname";
    private static $colQuestionsTopicname = "topicname";
    private static $colQuestionsInput = "input";
    private static $colQuestionsDate = "date";

    //idquestion-nickname-topicname-input-date
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
            $entity = QuestionADO::fromResultSet($row);
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
        $id = $res[QuestionADO::$colQuestionsIdQuestion];
        $nick = $res[QuestionADO::$colQuestionsNickname];
        $topicName = $res[QuestionADO::$colQuestionsTopicname];
        $input = $res[QuestionADO::$colQuestionsInput];
        $date = $res[QuestionADO::$colQuestionsDate];

        //Object construction
        $entity = new Question();
        $entity->setIdquestion($id);
        $entity->setNickname($nick);
        $entity->setTopicname($topicName);
        $entity->setInput($input);
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
            error_log("Error executing query in QuestionADO: " . $e->getMessage() . " ");
        }
        //Run the query
        $res = $conn->execution($cons, $vector);
        return QuestionADO::fromResultSetList($res);
    }

    /**
     * findByIdQuestion()
     * It runs a query and returns an object array
     * @param id
     * @return object with the query results
     */
    public static function findByPK($object) {
        $cons = "select * from `" . QuestionADO::$tableQuestions . "` where " . QuestionADO::$colQuestionsIdQuestion . " = ?";
        $arrayValues = [$object->getIdQuestion()];
        return QuestionADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdQuestion()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdQuestion($object) {
        $cons = "select * from `" . QuestionADO::$tableQuestions . "` where " . QuestionADO::$colQuestionsIdQuestion . " = ?";
        $arrayValues = [$object->getIdQuestion()];
        return QuestionADO::findByQuery($cons, $arrayValues);
    }
    
    /**
     * findByNickname()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByNickname($object) {
        $cons = "select * from `" . AnswerADO::$tableQuestions . "` where " . AnswerADO::$colQuestionsNickname . " = ?";
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
        $cons = "select * from `" . QuestionADO::$tableQuestions . "`";
        $arrayValues = [];
        return QuestionADO::findByQuery($cons, $arrayValues);
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
        $cons = "insert into " . QuestionADO::$tableQuestions . " (`nickname`,`topicname`,`input`,`date`) values (?, ?, ?, ?)";
        $arrayValues = [ $object->getNickname(), $object->getInput(), new Date()];
        $id = $conn->executionInsert($cons, $arrayValues);
        $object->setIdquestion($id);
        return $object->getIdQuestion();
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
        $cons = "delete from `" . QuestionADO::$tableQuestions . "` where " . QuestionADO::$colQuestionsIdQuestion . " = ?";
        $arrayValues = [$object->getIdQuestion()];
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
        $cons = "update `" . QuestionADO::$tableQuestions . "` set " . QuestionADO::$colQuestionsNickname . " = ?," .
                QuestionADO::$colQuestionsTopicname . " = ?, " . QuestionADO::$colQuestionsInput . " = ?". QuestionADO::$colQuestionsDate . " =? where " . QuestionADO::$colQuestionsIdQuestion . " = ?";
        $arrayValues = [$object->getIdQuestion(), $object->getNickname(), $object->getTopicname(), $object->getInput(), $object->getDate(), $object->getIdQuestion()];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "QuestionADO[id=" . $this->id . "][id=" . $this->id . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
