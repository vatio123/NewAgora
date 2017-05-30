<?php

/**
 * AnswerController class
 * it controls answer's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Answer.class.php";
require_once "../model/persist/AnswerADO.php";

class AnswerControllerClass implements ControllerInterface {

    private $action;
    private $jsonData;

    function __construct($action, $jsonData) {
        $this->setAction($action);
        $this->setJsonData($jsonData);
    }

    public function getAction() {
        return $this->action;
    }

    public function getJsonData() {
        return $this->jsonData;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setJsonData($jsonData) {
        $this->jsonData = $jsonData;
    }

    public function doAction() {
        $outPutData = array();

        switch ($this->getAction()) {
            case 10010:
                $outPutData = $this->llistAll();
                break;
            case 10020:
                $outPutData = $this->create();
                break;
            case 10030:
                $outPutData = $this->delete();
                break;
            case 10040:
                $outPutData = $this->update();
                break;
            case 10050:
                $outPutData = $this->findByQuestionId();
                break;
            case 10060:
                $outPutData = $this->llistAllReportedAnswers();
                break;
            default:
                $errors = array();
                $outPutData[0] = false;
                $errors[] = "Sorry, there has been an error. Try later";
                $outPutData[] = $errors;
                error_log("Action not correct in AnswerControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function llistAll() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listAnswers = AnswerADO::findAll();
        if (count($listAnswers) == 0) {
            $outPutData[0] = false;
            $errors[] = "No answers found in database";
        } else {
            $answersArray = array();

            foreach ($listAnswers as $answer) {
                $answersArray[] = $answer->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $answersArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }
    private function llistAllReportedAnswers() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listQuestions = AnswerADO::llistAllReportedAnswers();
        if (count($listQuestions) == 0) {
            $outPutData[0] = false;
            $errors[] = "No questions found in database";
        } else {
            $questionsArray = array();

            foreach ($listQuestions as $question) {
                $questionsArray[] = $question->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $questionsArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }

    private function create() {
        $answerObj = json_decode(stripslashes($this->getJsonData()));
        $answer = new Answer();
        $answer->setAll(0, $answerObj->nickname, $answerObj->idquestion, $answerObj->input, date("Y-m-d"));
        $outPutData = array();
        $outPutData[] = true;
        $answer->setIdanswer(AnswerADO::create($answer));
        //the senetnce returns de nickname of the answer inserted
        $outPutData[] = array($answer->getAll());
        return $outPutData;
    }

    private function update() {
        //Films modification
        $answersArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($answersArray as $answerObj) {
            $answer = new Answer();
            $answer->setAll($answerObj->nickname, $answerObj->idquestion, $answerObj->input, $answerObj->date);
            AnswerADO::update($answer);
        }
        return $outPutData;
    }

    private function delete() {
        $answerObj = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        $answer = new Answer();
        $answer->setAll($answerObj->idanswer, null, 0, null, null);
        AnswerADO::delete($answer);
        return $outPutData;
    }
    




    private function findByQuestionId() {
        //Films modification
        $questionObj = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        $answer = new Answer();
        $answer->setAll(0,"nickname", $questionObj->idquestion, "input", "date");
        $listAnswers = AnswerADO::findByQuestionId($answer);
        if (count($listAnswers) == 0) {
            $outPutData[0] = false;
            $errors[] = "No answers found in database";
        } else {
            $answersArray = array();

            foreach ($listAnswers as $answer) {
                $answersArray[] = $answer->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $answersArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $answersArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($answersArray as $answerObj) {
            $answer = new Answer();
            $answer->setAll(0,$answerObj->nickname, $answerObj->idquestion, $answerObj->input, $answerObj->date);
            AnswerADO::findByPK($answer);
        }
        return $outPutData;
    }

}

?>
