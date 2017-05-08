<?php

/**
 * TopicController class
 * it controls topic's model server part of the application
 */
require_once "ControllerInterface.php";
require_once "../model/Topic.class.php";
require_once "../model/persist/TopicADO.php";

class TopicControllerClass implements ControllerInterface {

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
                error_log("Action not correct in TopicControllerClass, value: " . $this->getAction());
                break;
        }
        return $outPutData;
    }

    private function llistAll() {
        $outPutData = array();
        $outPutData[] = true;
        $errors = array();
        $listTopics = TopicADO::findAll();
        if (count($listTopics) == 0) {
            $outPutData[0] = false;
            $errors[] = "No topics found in database";
        } else {
            $topicsArray = array();

            foreach ($listTopics as $topic) {
                $topicsArray[] = $topic->getAll();
            }
        }
        if ($outPutData[0]) {
            $outPutData[] = $topicsArray;
        } else {
            $outPutData[] = $errors;
        }
        return $outPutData;
    }

    private function create() {
        $topicObj = json_decode(stripslashes($this->getJsonData()));
        $topic = new Topic();
        $topic->setAll( $topicObj->topicname, $topicObj->maintopic);
        $outPutData = array();
        $outPutData[] = true;
        $topic->setTopicId(TopicADO::create($topic));
        //the senetnce returns de topicname of the topic inserted
        $outPutData[] = array($topic->getAll());
        return $outPutData;
    }



    private function update() {
        //Films modification
        $topicsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($topicsArray as $topicObj) {
            $topic = new Topic();
            $topic->setAll($topicObj->topicname, $topicObj->maintopic);
            TopicADO::update($topic);
        }
        return $outPutData;
    }

    private function delete() {
        //Films modification
        $topicsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($topicsArray as $topicObj) {
            $topic = new Topic();
            $topic->setAll($topicObj->topicname, $topicObj->maintopic);
            TopicADO::delete($topic);
        }
        return $outPutData;
    }

    private function findByPK() {
        //Films modification
        $topicsArray = json_decode(stripslashes($this->getJsonData()));
        $outPutData = array();
        $outPutData[] = true;
        foreach ($topicsArray as $topicObj) {
            $topic = new Topic();
            $topic->setAll($topicObj->topicname, $topicObj->maintopic);
            TopicADO::findByPK($topic);
        }
        return $outPutData;
    }


}

?>
