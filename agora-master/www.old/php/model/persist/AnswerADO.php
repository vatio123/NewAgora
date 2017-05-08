<?php

/** AnswerADOClass.php
 * Entity AnswerADOClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterfaceADO.php";
require_once "BDagora.php";
require_once "../model/Answer.class.php";

class AnswerADO implements EntityInterface {
/* private $idanswer;
    private $nickname;
    private $idquestion;
    private $input;
    private $date;*/
    //----------Data base Values---------------------------------------
    private static $tableAnswers = "answers";
    private static $colAnswersIdanswer = "idanswer";
    private static $colAnswersNickname = "nickname";
    private static $colAnswersIdquestion = "idquestion";
    private static $colAnswersInput = "input";
    private static $colAnswersDate = "date";

    //idanswer-nickname-idquestion-input-date
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
            $entity = AnswerADO::fromResultSet($row);
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
        $id = $res[AnswerADO::$colAnswersIdanswer];
        $nickname = $res[AnswerADO::$colAnswersNickname];
        $idquestion = $res[AnswerADO::$colAnswersIdquestion];
        $input = $res[AnswerADO::$colAnswersInput];
        $date = $res[AnswerADO::$colAnswersDate];

        //Object construction
        $entity = new Answer();
        $entity->setIdanswer($id);
        $entity->setNickname($nickname);
        $entity->setIdquestion($idquestion);
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
            error_log("Error executing query in AnswerADO: " . $e->getMessage() . " ");
        }
        //Run the query
        $res = $conn->execution($cons, $vector);
        return AnswerADO::fromResultSetList($res);
    }

    /**
     * findByIdanswer()
     * It runs a query and returns an object array
     * @param id
     * @return object with the query results
     */
    public static function findByPK($review) {
        $cons = "select * from `" . AnswerADO::$tableAnswers . "` where " . AnswerADO::$colAnswersIdanswer . " = ?";
        $arrayValues = [$review->getIdanswer()];
        return AnswerADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByIdanswer()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByIdanswer($review) {
        $cons = "select * from `" . AnswerADO::$tableAnswers . "` where " . AnswerADO::$colAnswersIdanswer . " = ?";
        $arrayValues = [$review->getIdanswer()];
        return AnswerADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findByNickname()
     * It runs a query and returns an object array
     * @param name
     * @return object with the query results
     */
    public static function findByNickname($review) {
        $cons = "select * from `" . AnswerADO::$tableAnswers . "` where " . AnswerADO::$colAnswersNickname . " = ?";
        $arrayValues = [$review->getNickname()];
        return AnswerADO::findByQuery($cons, $arrayValues);
    }

    /**
     * findAll()
     * It runs a query and returns an object array
     * @param none
     * @return object with the query results
     */
    public static function findAll() {
        $cons = "select * from `" . AnswerADO::$tableAnswers . "`";
        $arrayValues = [];
        return AnswerADO::findByQuery($cons, $arrayValues);
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
        
        $cons = "insert into " . AnswerADO::$tableAnswers . " (`nickname`,`idquestion`,`input`,`date`) values (?, ?, ?, ?)";
        $arrayValues = [ $review->getNickname(), $review->getIdquestion(), $review->getInput(), new Date()];
        $id = $conn->executionInsert($cons, $arrayValues);
        $review->setIdanswer($id);
        return $review->getIdanswer();
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
        $cons = "delete from `" . AnswerADO::$tableAnswers . "` where " . AnswerADO::$colAnswersIdanswer . " = ?";
        $arrayValues = [$review->getIdanswer()];
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
        $cons = "update `" . AnswerADO::$tableAnswers . "` set " . AnswerADO::$colAnswersNickname . " = ?," .
                AnswerADO::$colAnswersIdquestion . " = ?, " . AnswerADO::$colAnswersInput . " =? where " . AnswerADO::$colAnswersDate . " = ?";
        $arrayValues = [ $review->getNickname(), $review->getIdquestion(), $review->getInput(), $review->getDate()];
        $conn->execution($cons, $arrayValues);
    }

    /*public function toString() {
        $toString .= "AnswerADO[id=" . $this->id . "][id=" . $this->id . "][name=" . $this->name . "][desciption=" . $this->desciption . "]";
        return $toString;
    }*/

}

?>
