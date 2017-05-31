<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";

class Answer implements EntityInterface {
    private $idanswer;
    private $nickname;
    private $idquestion;
    private $input;
    private $date;

    //----------Data base Values---------------------------------------
    private static $tableName = "answers";
    private static $colNameIdanswer = "idanswer";
    private static $colNameNickname = "nickname";
    private static $colNameIdquestion = "idquestion";
    private static $colNameInput = "input";
    private static $colNameDate = "date";

    public function __construct() {

    }

    public function getIdanswer() {
        return $this->idanswer;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getIdquestion() {
        return $this->idquestion;
    }

    public function getInput() {
        return $this->input;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdanswer($idanswer) {
        $this->idanswer = $idanswer;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function setIdquestion($idquestion) {
        $this->idquestion = $idquestion;
    }

    public function setInput($input) {
        $this->input = $input;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getAll() {
        $data = array();
        $data["idanswer"] = $this->idanswer;
        $data["nickname"] = $this->nickname;
        $data["idquestion"] = $this->idquestion;
        $data["input"] = $this->input;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($idanswer, $nickname, $idquestion, $input, $date) {
        $this->setIdanswer($idanswer);
        $this->setNickname($nickname);
        $this->setIdquestion($idquestion);
        $this->setInput($input);
        $this->setDate($date);
    }

    /* public function toString() {
      $toString = "Review[idanswer=" . $this->idanswer . "][nickname=" . $this->nickname . "][desciption=" . $this->nick . "]";
      return $toString;
      } */
}

?>
