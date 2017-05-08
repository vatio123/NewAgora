<?php

/**
 * QuestionController class
 * it controls question's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Question.class.php";
require_once "../model/persist/QuestionADO.php";

class QuestionControllerClass implements ControllerInterface {

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
            case 10000:
                $outPutData = $this->llistAll();
                break;
            case 10000:
                $outPutData = $this->create();
                break;
            case 10000:
                $outPutData = $this->delete();
                break;
            case 10000:
                $outPutData = $this->update();
                break;
            case 10000:
                $outPutData = $this->findByPK();
                break;
            default:
                $errors = array();
                $outPutData[0] = false;
                $errors[] = "Sorry, there has been an error. Try later";
                $outPutData[] = $errors;
                error_log("Action not correct in FilmControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function llistAll() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listQuestions = QuestionADO::findAll();
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
        $questionObj = json_decode(stripslashes($this->getJsonData()));
        $question = new Question();
        $question->setAll(0, $questionObj->nickname, $questionObj->topicname, $questionObj->input, $questionObj->date);
        $outPutData = array();
        $outPutData[] = true;
        $question->setQuestionId(QuestionADO::create($question));
        //the senetnce returns de nickname of the question inserted
        $outPutData[] = array($question->getAll());
        return $outPutData;
    }



    private function update() {
        //Films modification
        $questionsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($questionsArray as $questionObj) {
            $question = new Question();
            $question->setAll($questionObj->nickname, $questionObj->topicname, $questionObj->input, $questionObj->date);
            QuestionADO::update($question);
        }
        return $outPutData;
    }

    private function delete() {
        //Films modification
        $questionsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($questionsArray as $questionObj) {
            $question = new Question();
            $question->setAll($questionObj->nickname, $questionObj->topicname, $questionObj->input, $questionObj->date);
            QuestionADO::delete($question);
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $questionsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($questionsArray as $questionObj) {
            $question = new Question();
            $question->setAll($questionObj->nickname, $questionObj->topicname, $questionObj->input, $questionObj->date);
            QuestionADO::findByPK($question);
        }
        return $outPutData;
    }


}

?>
