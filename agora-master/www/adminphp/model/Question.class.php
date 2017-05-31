<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  Vath
 * version 2017/04
 */
require_once "EntityInterface.php";

class Question implements EntityInterface {
    private $idquestion;
    private $nickname;
    private $topicname;
    private $input;
    private $date;

    //----------Data base Values---------------------------------------
    private static $tableName = "questions";
    private static $colNameIdquestion = "idquestion";
    private static $colNameNickname = "nickname";
    private static $colNameTopicname = "topicname";
    private static $colNameInput = "input";
    private static $colNameDate = "date";

    public function __construct() {

    }

    public function getIdquestion() {
        return $this->idquestion;
    }

    public function getNickname() {
        return $this->nickname;
    }

    public function getTopicname() {
        return $this->topicname;
    }

    public function getInput() {
        return $this->input;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdquestion($idquestion) {
        $this->idquestion = $idquestion;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }

    public function setTopicname($topicname) {
        $this->topicname = $topicname;
    }

    public function setInput($input) {
        $this->input = $input;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getAll() {
        $data = array();
        $data["idquestion"] = $this->idquestion;
        $data["nickname"] = $this->nickname;
        $data["topicname"] = $this->topicname;
        $data["input"] = $this->input;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($idquestion, $nickname, $topicname, $input, $date) {
        $this->setIdquestion($idquestion);
        $this->setNickname($nickname);
        $this->setTopicname($topicname);
        $this->setInput($input);
        $this->setDate($date);
    }

    /* public function toString() {
      $toString = "Review[idquestion=" . $this->idquestion . "][nickname=" . $this->nickname . "][desciption=" . $this->nick . "]";
      return $toString;
      } */
}

?>
