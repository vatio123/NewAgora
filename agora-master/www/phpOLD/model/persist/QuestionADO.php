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
    private static $colQuestionsNickName = "nickname";
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
        $nick = $res[QuestionADO::$colQuestionsNickName];
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
    public static function findByPK($review) {
        $cons = "select * from `" . QuestionADO::$tableQuestions . "` where " . QuestionADO::$colQuestionsIdQuestion . " = ?";
        $arrayValues = [$review->getIdQuestion()];
        return QuestionADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdQuestionClient()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdQuestionClient($review) {
        $cons = "select * from `" . QuestionADO::$tableQuestions . "` where " . QuestionADO::$colQuestionsIdQuestionClient . " = ?";
        $arrayValues = [$review->getIdQuestionClient()];
        return QuestionADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdQuestionUser()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdQuestionUser($review) {
        $cons = "select * from `" . QuestionADO::$tableQuestions . "` where " . QuestionADO::$colQuestionsIdQuestionUser . " = ?";
        $arrayValues = [$review->getIdQuestionUser()];
        return QuestionADO::findByQuery($cons, $arrayValues);
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
    public function create($review) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "insert into " . QuestionADO::$tableQuestions . " (`name`,`description`) values (?, ?)";
        $arrayValues = [$review->getIdQuestionUser(), $review->getNickName(), $review->getRate(), $review->getTopicname()];
        $id = $conn->executionInsert($cons, $arrayValues);
        $review->setIdQuestion($id);
        return $review->getIdQuestion();
    }

    /**
     * delete()
     * it deletes a row from the database
     */
    public function delete($review) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "delete from `" . QuestionADO::$tableQuestions . "` where " . QuestionADO::$colQuestionsIdQuestion . " = ?";
        $arrayValues = [$review->getIdQuestion()];
        $conn->execution($cons, $arrayValues);
    }

    /**
     * update()
     * it updates a row of the database
     */
    public function update($review) {
        //Connection with the database
        try {
            $conn = DBConnect::getInstance();
        } catch (PDOException $e) {
            print "Error connecting database: " . $e->getMessage() . " ";
            die();
        }
        $cons = "update `" . QuestionADO::$tableQuestions . "` set " . QuestionADO::$colQuestionsIdQuestionUser . " = ?," . QuestionADO::$colQuestionsNickName . " = ?," .
                QuestionADO::$colQuestionsRate . " = ?, " . QuestionADO::$colQuestionsTopicname . " =? where " . QuestionADO::$colQuestionsIdQuestion . " = ?";
        $arrayValues = [$review->getIdQuestionUser(), $review->getNickName(), $review->getRate(), $review->getTopicname(), $review->getIdQuestion()];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "QuestionADO[id=" . $this->id . "][idUser=" . $this->idUser . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
