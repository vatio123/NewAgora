<?php

/** QuestionClass.php
 * Entity QuestionClass
 * author  norosa@programmer.net
 * version 2017/04
 */
require_once "EntityInterface.php";
/*
  this.idQuestion;
  this.nick;
  this.topicName;
  this.input;
  this.date;
 */

class Question implements EntityInterface {

    private $questionId;
    private $input;
    private $nick;
    private $topicName;
    private $date;

    function __construct() {
        
    }

    public function getQuestionId() {
        return $this->questionId;
    }

    public function getTopicName() {
        return $this->topicName;
    }

    public function getDate() {
        return $this->date;
    }

    public function getInput() {
        return $this->input;
    }

    public function getNick() {
        return $this->nick;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setTopicName($topicName) {
        $this->topicName = $topicName;
    }

    public function setQuestionId($questionId) {
        $this->questionId = $questionId;
    }

    public function setInput($input) {
        $this->input = $input;
    }

    public function setNick($nick) {
        $this->nick = $nick;
    }

    public function getAll() {
        $data = array();
        $data["idquestion"] = $this->questionId;
        $data["input"] = $this->input;
        $data["nick"] = $this->nick;
        $data["topicname"] = $this->topicName;
        $data["date"] = $this->date;
        return $data;
    }

    public function setAll($questionId, $input, $nick, $topicName, $date) {
        $this->setQuestionId($questionId);
        $this->setInput($input);
        $this->setNick($nick);
        $this->setDate($date);
        $this->setTopicName($topicName);
    }

    public function toString() {
        $toString = "Review[questionId=" . $this->questionId . "][input=" . $this->input . "][desciption=" . $this->nick . "]";
        return $toString;
    }

}

?>
